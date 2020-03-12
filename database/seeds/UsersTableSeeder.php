<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'username'       => 'admin',
                'password'       => '$2y$10$RjohUCudPg4Fyw0vzyDAOOJYBe5J5gfCwpofpTXp.LYcRzENBmS/.',
                'remember_token' => null,
                'middle_name'    => '',
                'last_name'      => '',
            ],
        ];

        User::insert($users);
    }
}
