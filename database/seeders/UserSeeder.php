<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [ // Lista de permisos
            'panel-control',
            'A',
            'B',
            'C',
            'D',
        ];

        foreach ($permissions as $permission) { // Creamos los permisos
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $adminUser = User::create([ // Creamos el usuario admin
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin0429*'),
            'email_verified_at' => now(),
        ]);
        $defaultUser = User::create([ // Creamos el usuario por defecto
            'name' => 'iram',
            'email' => 'iram@gmail.com',
            'password' => bcrypt('iram0429*'),
            'email_verified_at' => now(),
        ]);

        $rolAdmin = Role::create(['name' => 'super-admin']); // Creamos el rol admin
        $adminUser->assignRole($rolAdmin); // Asignamos el rol al usuario admin
        $permissionsAdmin = Permission::query()->pluck('name'); // Obtenemos todos los permisos de la tabla permissions
        $rolAdmin->syncPermissions(permissions: $permissionsAdmin); // Asignamos todos los permisos al rol admin

        $rolUser = Role::create(['name' => 'user']); // Creamos el rol user
        $defaultUser->assignRole($rolUser); // Asignamos el rol al usuario por defecto
        $rolUser->syncPermissions(['C', 'D']); // Asignamos el permiso A al rol userp


    }
}
