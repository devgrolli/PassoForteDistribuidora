<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {
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
            ]
        ];

        foreach ($users as $user) {
            User::create(array(
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password'])
            ));
        }
    }
}
