<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\LevelVerification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
                "name" => 'super_admin',
                "guard_name" => 'web',
                "level_verification_id" => LevelVerification::where('name', 'None')->first()->id
        ]);
    }
}
