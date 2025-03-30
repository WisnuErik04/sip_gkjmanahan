<?php

namespace Database\Seeders;

// use App\Models\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Buat role
         $adminRole = Role::firstOrCreate(['name' => 'super_admin']);

         // Buat permission
         $permissions = [
             'view_role',
             'create_role',
             'update_role',
             'delete_role',
         ];
 
         foreach ($permissions as $permission) {
             Permission::firstOrCreate(['name' => $permission]);
         }
 
         // Berikan semua permission ke admin
         $adminRole->givePermissionTo($permissions);
     
    }
}
