<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_name' => ['required', 'string', 'max:120'],
            'professional_id' => ['required', 'exists:professionals,id'],
            'scheduled_at' => ['required', 'date', 'after:now'],
            'status' => ['required', Rule::in(['confirmed', 'pending', 'cancelled'])],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }
}
