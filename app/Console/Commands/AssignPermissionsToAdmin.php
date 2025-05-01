<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissionsToAdmin extends Command
{
    protected $signature = 'permissions:assign-admin';

    protected $description = 'Assign type.menu and state.menu permissions to admin role';

    public function handle()
    {
        $role = Role::where('name', 'admin')->first();
        if (!$role) {
            $this->error('Admin role not found.');
            return 1;
        }

        $permissions = ['type.menu', 'state.menu'];

        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            if (!$role->hasPermissionTo($permission)) {
                $role->givePermissionTo($permission);
                $this->info("Permission '{$permissionName}' assigned to admin role.");
            } else {
                $this->info("Permission '{$permissionName}' already assigned to admin role.");
            }
        }

        $this->info('Permissions assignment completed.');
        return 0;
    }
}
