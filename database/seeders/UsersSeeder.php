<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'daniel',
            'email' => 'daniel@example.com',
            'username' => 'DANIEL485',
            'email_verified_at' => now(),
            'password' => bcrypt(12345678)
        ]); 

        User::create(
        [
            'id' => 2,
            'name' => 'maria',
            'email' => 'maria@example.com',
            'username' => 'MARIA_1234',
            'email_verified_at' => now(),
            'password' => bcrypt(12345678)
        ]); 
    }
}
