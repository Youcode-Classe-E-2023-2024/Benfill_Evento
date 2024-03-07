<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    private $roles = [
        'Admin',
        'user',
        'Organizer'
    ];

    private $permissions = [
        'view-dashboard',
        'role-list', 'role-create',
        'role-edit',
        'role-delete',
        'event-create',
        'event-update',
        'event-delete',
        'update-user-role',
        'delete-user',
        'category-list',
        'category-create',
        'category-delete',
        'reservation-list',
        'reservation-delete',
        'favorite-list',
        'favorite-liking',
        'accept-event'
    ];

    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach ($this->roles as $role) {
            Role::create(['name' => $role]);
        }

        Role::findByName('Admin')->givePermissionTo($this->permissions);
        Role::findByName('Organizer')->givePermissionTo([
            'favorite-list', 'favorite-liking', 'event-create', 'event-update',
            'event-delete',
        ]);
    }
}
