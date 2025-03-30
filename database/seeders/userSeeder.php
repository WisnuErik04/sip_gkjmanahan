<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            "name" => 'Erik - Super Admin',
            'email' => 'erik@supadmin.com',
            'password' => Hash::make('password'),
            // 'role_id' => Role::where('name', 'Super Admin')->first()->id,
            'role_id' => Role::where('name', 'super_admin')->first()->id,
        ]);
    }
}
