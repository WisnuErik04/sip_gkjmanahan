<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    protected string $token;

    public function __construct()
    {
        $this->token = config('services.fonnte.token'); // Lebih aman pakai config
    }

    public function sendMessage(string $target, string $message): array
    {
        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->post('https://api.fonnte.com/send', [
            'target' => $target,
            'message' => $message,
        ]);

        return $response->json();
    }
}
