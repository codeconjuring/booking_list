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
            'Build Form',
            'Series',
            'Status',
            'Form Submit',
            'Book List',
            'Administration',
            'Setings',
            'User',
        ];

        $childPermissions =
            [
            'Build Form'     => array(
                0 => 'Add Build Form',
                1 => 'Edit Build Form',
                2 => 'Show Build Form',
                3 => 'Delete Build Form',
            ),
            'Series'         => array(
                0 => 'Add Series',
                1 => 'Edit Series',
                2 => 'Show Series',
                3 => 'Delete Series',
            ),
            'Status'         => array(
                0 => 'Add Status',
                1 => 'Edit Status',
                2 => 'Show Status',
                3 => 'Delete Status',
            ),
            'Form Submit'    => array(
                0 => 'Submit Form',
            ),
            'Book List'      => array(
                0 => 'Download Report',
                1 => 'Edit Book List',
                2 => 'Show Book List',
                3 => 'Delete Book List',
            ),
            'Administration' => array(
                0 => 'Add Administration',
                1 => 'Edit Administration',
                2 => 'Show Administration',
                3 => 'Delete Administration',
            ),
            'Setings'        => array(
                0 => 'System Settings',
                1 => 'Email Settings',
            ),
            'User'           => array(
                0 => 'Add User',
                1 => 'Edit User',
                2 => 'Show User',
                3 => 'Delete User',
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
