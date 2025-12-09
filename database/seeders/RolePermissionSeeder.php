<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'manage users',
            'manage companies',
            'manage customers',
            'manage contacts',
            'manage discussions',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $admin = Role::create(['name' => UserRole::Admin->value]);
        $admin->givePermissionTo(Permission::all());

        $manager = Role::create(['name' => UserRole::Manager->value]);
        $manager->givePermissionTo([
            'manage companies',
            'manage customers',
            'manage contacts',
            'manage discussions',
        ]);

        $salesRep = Role::create(['name' => UserRole::SalesRep->value]);;
        $salesRep->givePermissionTo([
            'manage customers',
        ]);
    }
}
