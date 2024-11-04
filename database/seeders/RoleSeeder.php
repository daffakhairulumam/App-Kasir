<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        $roles = [
            [
                'name_role' => 'Admin',
                'keterangan' => 'Administrator',
            ],
            [
                'name_role' => 'Petugas',
                'keterangan' => 'Petugas',
            ],
        ];
        foreach ($roles as $value) {
            Role::create([
                'name_role' => $value['name_role'],
                'keterangan' => $value['keterangan'],
            ]);
        }
    }
}
