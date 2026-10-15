<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Professional;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_agenda_displays_filtered_appointments(): void
    {
        $professional = Professional::create(['name' => 'Dra. Ana', 'specialty' => 'Clínica']);
        Appointment::create(['professional_id' => $professional->id, 'patient_name' => 'Maria', 'scheduled_at' => '2026-10-15 09:00:00', 'status' => 'confirmed']);
        Appointment::create(['professional_id' => $professional->id, 'patient_name' => 'João', 'scheduled_at' => '2026-10-16 09:00:00', 'status' => 'pending']);

        $this->get('/agenda?date=2026-10-15&status=confirmed')
            ->assertOk()
            ->assertSee('Maria')
            ->assertDontSee('João');
    }

    public function test_appointment_is_created_with_backend_validation(): void
    {
        $professional = Professional::create(['name' => 'Dr. Bruno', 'specialty' => 'Cardiologia']);

        $this->post('/agenda', [
            'patient_name' => 'Carla Souza',
            'professional_id' => $professional->id,
            'scheduled_at' => now()->addDay()->format('Y-m-d H:i:s'),
            'status' => 'pending',
        ])->assertRedirect('/agenda');

        $this->assertDatabaseHas('appointments', ['patient_name' => 'Carla Souza']);
    }

    public function test_invalid_appointment_returns_validation_errors(): void
    {
        $this->post('/agenda', [])->assertSessionHasErrors(['patient_name', 'professional_id', 'scheduled_at', 'status']);
    }
}
