<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgendaKeterangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgendaKeteranganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ["name" => 'Kew'],
            ["name" => 'Um'],
            ["name" => 'Ibd'],
            ["name" => 'Keu'],
        ];
        
        foreach ($datas as $data) {
            AgendaKeterangan::firstOrCreate($data);
        }
    }
}
