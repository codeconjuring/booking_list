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
            'User',
            'Book Attributes',

            'Book Management',


            'Administration',
            'Setings',

        ];

        $childPermissions =
            [
            'User'            => array(
                0 => 'Add User',
                1 => 'Edit User',
                2 => 'Show User',
                3 => 'Delete User',
            ),
            'Book Attributes' => array(
                0  => 'Add Book Attributes Format',
                1  => 'Edit Book Attributes Format',
                2  => 'Show Book Attributes Format',
                3  => 'Delete Book Attributes Format',

                4  => 'Add Book Attributes Series',
                5  => 'Edit Book Attributes Series',
                6  => 'Show Book Attributes Series',
                7  => 'Delete Book Attributes Series',

                8  => 'Add Book Attributes Status',
                9  => 'Edit Book Attributes Status',
                10 => 'Show Book Attributes Status',
                11 => 'Delete Book Attributes Status',
            ),
            'Book Management' => array(
                0 => 'Add Book Management',

                1 => 'Edit Book Management',
                2 => 'Show Book Management',
                3 => 'Delete Book Management',
                4 => 'Add Another Translation Book Management',
                5 => 'Download Report Book Management',
            ),
            'Administration'  => array(
                0 => 'Add Administration',
                1 => 'Edit Administration',
                2 => 'Show Administration',
                3 => 'Delete Administration',
            ),
            'Setings'         => array(
                0 => 'System Settings',
                1 => 'Email Settings',
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
