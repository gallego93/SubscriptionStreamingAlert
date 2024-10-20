<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        Permission::create([
            'name' => 'config.edit',
            'description' => 'Editar configuración'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'users.index',
            'description' => 'Listar usuarios'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'users.create',
            'description' => 'Crear usuarios'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'users.edit',
            'description' => 'Editar usuarios'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'users.delete',
            'description' => 'Eliminar usuarios'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'users.show',
            'description' => 'Detalle de usuarios'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'roles.index',
            'description' => 'Listar roles'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'roles.create',
            'description' => 'Crear roles'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'roles.edit',
            'description' => 'Editar roles'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'roles.delete',
            'description' => 'Eliminar roles'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'roles.show',
            'description' => 'Detalle de roles'
        ])->assignRole($admin);
        Permission::create([
            'name' => 'clients.index',
            'description' => 'Listar clientes'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'clients.create',
            'description' => 'Crear clientes'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'clients.edit',
            'description' => 'Editar clientes'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'clients.delete',
            'description' => 'Eliminar clientes'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'clients.show',
            'description' => 'Detalle de clientes'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'products.index',
            'description' => 'Listar productos'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'products.create',
            'description' => 'Crear productos'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'products.edit',
            'description' => 'Editar productos'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'products.delete',
            'description' => 'Eliminar productos'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'products.show',
            'description' => 'Detalle de productos'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'subscriptions.index',
            'description' => 'Listar suscripciones'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'subscriptions.create',
            'description' => 'Crear suscripciones'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'subscriptions.edit',
            'description' => 'Editar suscripciones'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'subscriptions.delete',
            'description' => 'Eliminar suscripciones'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'subscriptions.show',
            'description' => 'Detalle de suscripciones'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'messages.index',
            'description' => 'Listar mensaje'
        ])->syncRoles($admin, $user);
        Permission::create([
            'name' => 'messages.edit',
            'description' => 'Editar mensaje'
        ])->assignRole($admin);
    }
}
