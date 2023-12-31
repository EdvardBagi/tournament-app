<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'    => 'Jon Snow',
            'email'    => 'jonsnow@gmail.com',
            'password'   =>  Hash::make('jonsnow'),
            //'remember_token' =>  str_random(10),
        ]);
        User::create([
            'name'    => 'Thanos',
            'email'    => 'thanos@gmail.com',
            'password'   =>  Hash::make('thanos'),
            //'remember_token' =>  str_random(10),
        ]);
        User::create([
            'name'    => 'John Smith',
            'email'    => 'johnsmith@gmail.com',
            'password'   =>  Hash::make('johnsmith'),
            //'remember_token' =>  str_random(10),
        ]);
    }
}
