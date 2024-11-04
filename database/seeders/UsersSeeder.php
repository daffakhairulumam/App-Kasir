<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'username' => 'super admin',
                'role_id' => 1,
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('admin'),
                'name_users' => 'Super Admin'
            ],
            [
                'username' => 'executive',
                'role_id' => 2,
                'email' => 'executive@gmail.com',
                'password' => Hash::make('executive'),
                'name_users' => 'executive'
            ],
        ];
        foreach ($data as $value) {
            User::create([
                'username' => $value['username'],
                'role_id' => $value['role_id'],
                'email' => $value['email'],
                'password' => $value['password'],
                'name_users' => $value['name_users'],
            ]);
        }
    }
}
