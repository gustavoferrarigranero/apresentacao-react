<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Professional;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AppointmentController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->validate([
            'date' => ['nullable', 'date'],
            'professional' => ['nullable', 'integer', 'exists:professionals,id'],
            'status' => ['nullable', 'in:confirmed,pending,cancelled'],
        ]);

        $activeFilters = [
            'date' => $filters['date'] ?? now()->toDateString(),
            'professional' => $filters['professional'] ?? '',
            'status' => $filters['status'] ?? '',
        ];

        return Inertia::render('Appointments/Index', [
            'appointments' => AppointmentResource::collection(
                Appointment::query()
                    ->with('professional')
                    ->forDate($activeFilters['date'])
                    ->when($activeFilters['professional'], fn ($query, $professional) => $query->where('professional_id', $professional))
                    ->when($activeFilters['status'], fn ($query, $status) => $query->where('status', $status))
                    ->orderBy('scheduled_at')
                    ->get()
            )->resolve(),
            'professionals' => Professional::query()->orderBy('name')->get(['id', 'name', 'specialty']),
            'filters' => $activeFilters,
        ]);
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        Appointment::create($request->validated());

        return to_route('appointments.index')->with('success', 'Consulta agendada com sucesso.');
    }
}
