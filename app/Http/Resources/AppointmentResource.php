<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patientName' => $this->patient_name,
            'scheduledAt' => $this->scheduled_at->toIso8601String(),
            'time' => $this->scheduled_at->format('H:i'),
            'status' => $this->status,
            'notes' => $this->notes,
            'professional' => [
                'id' => $this->professional->id,
                'name' => $this->professional->name,
                'specialty' => $this->professional->specialty,
            ],
        ];
    }
}
