<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Professional;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'date' => ['nullable', 'date'],
            'professional' => ['nullable', 'integer', 'exists:professionals,id'],
            'status' => ['nullable', 'in:confirmed,pending,cancelled'],
        ]);

        return view('appointments.index', [
            'appointments' => Appointment::query()
                ->with('professional')
                ->forDate($filters['date'] ?? now()->toDateString())
                ->when($filters['professional'] ?? null, fn ($query, $professional) => $query->where('professional_id', $professional))
                ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
                ->orderBy('scheduled_at')
                ->get(),
            'professionals' => Professional::query()->orderBy('name')->get(),
            'filters' => [
                'date' => $filters['date'] ?? now()->toDateString(),
                'professional' => $filters['professional'] ?? '',
                'status' => $filters['status'] ?? '',
            ],
        ]);
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        Appointment::create($request->validated());

        return to_route('appointments.index')->with('success', 'Consulta agendada com sucesso.');
    }
}
