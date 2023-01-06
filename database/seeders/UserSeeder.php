<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models as Database;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Database\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0123456789',
            'password' => bcrypt(123456),
            'status' => Database\User::STATUS_ACTIVE,
            'type' => Database\User::ROLE_ADMIN,
        ]);
    }
}
