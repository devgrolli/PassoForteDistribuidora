<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\User;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // array of specific hotels to populate database
        $users = [
            [
                'name' => 'Lucas Grolli',
                'email' => 'lucas@gmail.com',
                'password' => 'C0nnect123'
            ],
            [
                'name' => 'João Maria de Oliveira',
                'email' => 'joaomaria@gmail.com',
                'password' => 'C0nnect123'
            ],
            [
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => 'C0nnect123'
            ]
        ];

        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('edit articles');
        $role1->givePermissionTo('delete articles');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('publish articles');
        $role2->givePermissionTo('unpublish articles');

        $role3 = Role::create(['name' => 'Super-Admin']);

        foreach ($users as $user) {
            $user_create = User::create(array(
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password'])
            ));
            $user_create->assignRole($role3);
        }

    }
}
