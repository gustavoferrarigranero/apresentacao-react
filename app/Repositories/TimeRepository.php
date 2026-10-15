<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

// Repo created for use in tests, to mock the API call and avoid hitting the real API during testing.
class TimeRepository
{
    public function getTimeWithApi()
    {
        $response = Http::get('https://api.example.com/time');
        return $response->json();
    }
}