<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Clear cached permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /**
         * =========================
         * PERMISSIONS
         * =========================
         */
        $permissions = [

            // Members
            'view members',
            'create members',
            'edit members',
            'delete members',

            // Givings
            'view givings',
            'create givings',
            'edit givings',
            'delete givings',

            // Reports
            'view reports',

            // Users
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Churches
            'view churches',
            'create churches',
            'edit churches',
            'delete churches',

            //Pastors
            'view pastors',
            'create pastors',
            'edit pastors',
            'delete pastors',

            //Announcements
            'view announcements',
            'create announcements',
            'edit announcements',
            'delete announcements',

            
            // Roles & Permissions
            'manage roles',
            'manage permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        /**
         * =========================
         * ROLES
         * =========================
         */
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $pastor = Role::firstOrCreate(['name' => 'Pastor']);
        $secretary = Role::firstOrCreate(['name' => 'Secretary']);
        $treasurer = Role::firstOrCreate(['name' => 'Treasurer']);
        $member = Role::firstOrCreate(['name' => 'Member']);
        $fieldOfficer = Role::firstOrCreate(['name' => 'Field Officer']);

        /**
         * =========================
         * ASSIGN PERMISSIONS
         * =========================
         */

        // Admin → ALL
        $admin->syncPermissions(Permission::all());

        // Pastor → view only
        $pastor->syncPermissions([
            'view members',
            'view givings',
            'view reports',
        ]);

        // Secretary → manage members
        $secretary->syncPermissions([
            'view members',
            'create members',
            'edit members',
        ]);

        // Treasurer → manage givings
        $treasurer->syncPermissions([
            'view givings',
            'create givings',
            'edit givings',
            'delete givings',
            'view reports',
        ]);

        // Member → limited
        $member->syncPermissions([
            'view givings',
        ]);

        // Field Officer → reports + members
        $fieldOfficer->syncPermissions([
            'view members',
            'view reports',
        ]);
    }
}