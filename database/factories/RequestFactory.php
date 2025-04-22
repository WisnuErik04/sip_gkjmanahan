<?php

namespace Database\Factories;

use App\Models\Form;
use App\Models\RequestStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr; // ← Tambahkan ini
use Illuminate\Support\Str; // Optional kalau perlu string helper

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pemohon_nama' => $this->faker->name,
            'pemohon_hp_telepon' => $this->faker->phoneNumber,
            'pemohon_email' => $this->faker->email,
            'pemohon_warga_blok' => $this->faker->word,
            'pemohon_alamat' => $this->faker->address,
            'form_id' => Form::inRandomOrder()->first()?->id ?? 1,
            'request_status_id' => RequestStatus::inRandomOrder()->first()?->id ?? 1,
            'telah_dijadwalkan_sidang' => Arr::random([0, 1]),
            'form_answers' => json_encode([
                "2" => "Senin, 7 April 2025",
                "3" => "08:00 WIB",
                "4" => "GKJ Manahan",
                "5" => null,
                "6" => "Budi Santoso",
                "7" => "Surakarta, 12 Desember 1990",
                "8" => "Karyawan Swasta",
                "9" => "Jl. Kenanga No. 5",
                "10" => "Blok B",
                "11" => "08123456789",
                "12" => "budi@example.com",
                "13" => null,
                "14" => null,
                "15" => "Surakarta, 1 Jan 1991",
                "16" => "Guru",
                "17" => "Jl. Mawar No. 7",
                "18" => null,
                "19" => "Mira Andini",
                "20" => "Yogyakarta, 5 Mei 1992",
                "21" => "Perempuan"
            ]),
            'form_file_path' => "uploads/form_permohonan/form_permohonan_29.pdf",
        ];
    }
}
