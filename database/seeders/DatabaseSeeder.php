<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call([
        //     AgendaKeteranganSeeder::class,
        //     AgendaJenisSeeder::class,
        // ]);

        $this->call([
            LevelVerificationSeeder::class,
            RoleSeeder::class,
            ShieldSeeder::class,
            UserSeeder::class,
            requestStatusSeeder::class,
            verificationStatusSeeder::class,
            FormSeeder::class,
            ListUploadFormSeeder::class,
            AgendaKeteranganSeeder::class,
            AgendaJenisSeeder::class,
        ]);
        
        // Buat peran admin
        $adminRole = Role::firstOrCreate(['name' => 'super_admin']);

        // Tambahkan permission
        $permissions = [
            'view_role',
            'view_any_role',
            'create_role',
            'update_role',
            'delete_role'
        ];
        $adminRole->givePermissionTo(Permission::all());

        // Assign role admin ke user pertama
        $user = User::first();
        if ($user) {
            $user->assignRole($adminRole);
        }
        
    }
}
