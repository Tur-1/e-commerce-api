<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;

use App\Modules\Admins\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreatePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create permissions for specified models and optionally generate policies';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->createPermissions();
        $this->info('Permissions created successfully.');


        $admin = Admin::query()->firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'admin',
                'phone' => '0000000000',
                'password' => Hash::make('123456'),
            ]
        );
        $role = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'admin']);

        $permissions = Permission::where('guard_name', 'admin')->get();
        $role->syncPermissions($permissions);

        $admin->syncRoles($role);

        $admin->syncPermissions($role->permissions);


        $this->info("\nAdmin has been created and assigned all permissions successfully.");
        $this->info("\n");
        $this->info("Email: admin@admin.com");
        $this->info("Password: 123456");
    }


    public function createPermissions()
    {

        $models = $this->getModels();
        $actions = $this->actions();

        foreach ($models as $model) {
            foreach ($actions as $action) {
                $permissionName = "{$model}.{$action}";
                $permission = Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'admin']);
                $this->info("Permission checked/created: {$permissionName}");
            }
        }

        foreach ($this->otherActions() as $model => $actions) {
            foreach ($actions as $action) {
                $permissionName = "{$model}.{$action}";
                $permission = Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'admin']);
                $this->info("Permission checked/created: {$permissionName}");
            }
        }
    }
    /**
     * List of models to generate permissions and policies for.
     */
    public function getModels()
    {
        return [
            'user',
            'admin',
            'brand',
            'role'
        ];
    }

    /**
     * Default CRUD actions.
     */
    public function actions()
    {
        return [
            'create',
            'update',
            'view',
            'view_any',
            'delete',
            'force_delete',
            'restore',
            'replicate',
        ];
    }

    /**
     * Additional custom actions.
     */
    public function otherActions()
    {
        return [
            'user' => [
                'download_as_pdf',
                'download_as_excel'
            ],
            'brand' => [
                'publish'
            ],
        ];
    }
}
