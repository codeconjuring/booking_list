<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parentPermissions = [
            'Series',
        ];

        $childPermissions =
            [
            'Series' => array(
                0 => 'Add Series',
                1 => 'Edit Series',
                2 => 'Show Series',
                3 => 'Delete Series',
            ),
        ];

        Permission::query()->delete();

        Role::updateOrCreate(['name' => 'Admin'], [
            'name'       => 'Admin',
            'guard_name' => 'web',
        ]);

        foreach ($parentPermissions as $parentPermission) {
            $parentInsert = Permission::create([
                'name'       => $parentPermission,
                'parent_id'  => '',
                'guard_name' => 'web',
            ]);
            if (array_key_exists($parentPermission, $childPermissions)) {
                foreach ($childPermissions[$parentPermission] as $childPermission) {
                    $perm = Permission::create([
                        'name'       => $childPermission,
                        'parent_id'  => $parentInsert->id,
                        'guard_name' => 'web',
                    ]);

                    $perm->assignRole('Admin');
                }
            }
        }
    }
}
