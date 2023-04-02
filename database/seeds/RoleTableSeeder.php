<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        // DB::table('model_has_roles')->truncate();
        Role::truncate();
        Permission::truncate();
        $permissions = [
            ['name' => 'View Data'],
            ['name' => 'View Tools'],
            ['name' => 'View Catalogs'],
            ['name' => 'Manage Rss'],
            ['name' => 'Manage Users'],
            ['name' => 'Manage News'],
            ['name' => 'Manage My News'],
            ['name' => 'Manage News Tags'],
            ['name' => 'Manage Charts Tags'],
            ['name' => 'Manage Papers Tags'],
            ['name' => 'Search Paper'],
            ['name' => 'Search Open Data'],
            ['name' => 'Write Paper'],
            ['name' => 'Confirm Paper'],
            ['name' => 'Review Paper'],
            ['name' => 'Manage followers'],
            ['name' => 'Manage following'],
            ['name' => 'Search Researchers'],
            ['name' => 'Manage Countries'],
            ['name' => 'Manage Topics']
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
        $items = [
            [
                'name' => 'Admin',
                'permissions' => [
                    'View Data',
                    'View Tools',
                    'View Catalogs',
                    'Manage Rss',
                    'Manage Users',
                    'Manage News',
                    'Manage My News',
                    'Manage News Tags',
                    'Manage Charts Tags',
                    'Manage Papers Tags',
                    'Search Paper',
                    'Search Open Data',
                    'Search Researchers',
                    'Manage Countries',
                    'Manage Topics'
                ]
            ],
            [
                'name' => 'User',
                'permissions' => [
                    'Search Paper',
                    'Search Open Data',
                    'Manage followers',
                    'Manage My News',
                    'Manage following',
                    'Search Researchers',
                    'Write Paper',
                ]
            ],
            [
                'name' => 'Author',
                'permissions' => [
                    'Search Paper',
                    'Search Open Data',
                    'Manage My News',
                    'Write Paper',
                    'Confirm Paper',
                    'Review Paper',
                    'Manage followers',
                    'Manage following',
                    'Search Researchers'
                ]
            ],
        ];

        foreach ($items as $item) {
            $role = Role::create(['name' => $item['name']]);
            foreach ($item['permissions'] as $perm) {
                $permission = Permission::where('name', $perm)->first();
                $role->givePermissionTo($permission);
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
