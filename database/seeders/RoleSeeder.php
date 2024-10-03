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

        Permission::create(['name' => 'dashboard.index'])->syncRoles($admin, $user);
        Permission::create(['name' => 'profile.edit'])->syncRoles($admin, $user);
        Permission::create(['name' => 'users.index'])->assignRole($admin);
        Permission::create(['name' => 'users.create'])->assignRole($admin);
        Permission::create(['name' => 'users.edit'])->assignRole($admin);
        Permission::create(['name' => 'users.delete'])->assignRole($admin);
        Permission::create(['name' => 'users.show'])->assignRole($admin);
        Permission::create(['name' => 'roles.index'])->assignRole($admin);
        Permission::create(['name' => 'roles.create'])->assignRole($admin);
        Permission::create(['name' => 'roles.edit'])->assignRole($admin);
        Permission::create(['name' => 'roles.delete'])->assignRole($admin);
        Permission::create(['name' => 'roles.show'])->assignRole($admin);
        Permission::create(['name' => 'permissions.index'])->assignRole($admin);
        Permission::create(['name' => 'permissions.create'])->assignRole($admin);
        Permission::create(['name' => 'permissions.edit'])->assignRole($admin);
        Permission::create(['name' => 'permissions.delete'])->assignRole($admin);
        Permission::create(['name' => 'permissions.show'])->assignRole($admin);
        Permission::create(['name' => 'clients.index'])->syncRoles($admin, $user);
        Permission::create(['name' => 'clients.create'])->syncRoles($admin, $user);
        Permission::create(['name' => 'clients.edit'])->syncRoles($admin, $user);
        Permission::create(['name' => 'clients.delete'])->syncRoles($admin, $user);
        Permission::create(['name' => 'clients.show'])->syncRoles($admin, $user);
        Permission::create(['name' => 'products.index'])->syncRoles($admin, $user);
        Permission::create(['name' => 'products.create'])->syncRoles($admin, $user);
        Permission::create(['name' => 'products.edit'])->syncRoles($admin, $user);
        Permission::create(['name' => 'products.delete'])->syncRoles($admin, $user);
        Permission::create(['name' => 'products.show'])->syncRoles($admin, $user);
        Permission::create(['name' => 'subscriptions.index'])->syncRoles($admin, $user);
        Permission::create(['name' => 'subscriptions.create'])->syncRoles($admin, $user);
        Permission::create(['name' => 'subscriptions.edit'])->syncRoles($admin, $user);
        Permission::create(['name' => 'subscriptions.delete'])->syncRoles($admin, $user);
        Permission::create(['name' => 'subscriptions.show'])->syncRoles($admin, $user);
        Permission::create(['name' => 'messages.index'])->syncRoles($admin, $user);
        Permission::create(['name' => 'messages.create'])->syncRoles($admin, $user);
        Permission::create(['name' => 'messages.edit'])->syncRoles($admin, $user);
        Permission::create(['name' => 'messages.delete'])->syncRoles($admin, $user);
        Permission::create(['name' => 'messages.show'])->syncRoles($admin, $user);
    }
}
