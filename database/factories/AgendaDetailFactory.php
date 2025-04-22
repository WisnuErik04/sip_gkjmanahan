<?php

namespace Database\Factories;

use App\Models\Agenda;
use App\Models\Request;
use App\Models\AgendaJenis;
use App\Models\AgendaKeterangan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AgendaDetail>
 */
class AgendaDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_surat' => $this->faker->unique()->bothify('###/ABC/####'),
            'perihal' => $this->faker->sentence(3),
            'dari' => $this->faker->name,
            'tanggal_masuk' => $this->faker->date,
            'usulan_keputusan' => $this->faker->sentence(),
            'keterangan' => $this->faker->sentence(),
            'agenda_id' => Agenda::inRandomOrder()->first()?->id ?? 1, // pastikan ID-nya ada
            'jenis_id' => AgendaJenis::inRandomOrder()->first()->id,
            'keterangan_id' => AgendaKeterangan::inRandomOrder()->first()->id,
            'request_id' => Request::inRandomOrder()->first()->id,
            'hasil_keputusan' => $this->faker->sentence(),
            // field lainnya sesuai kebutuhan
        ];
    }
}
