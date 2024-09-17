<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Kevin Iansyah',
            'email' => 'keviniansyah04@gmail.com',
            'password' => Hash::make('yayanpoe'),
            'access' => 'admin',
        ]);

        User::create([
            'name' => 'Alya Izzah Zalfa Rihadah Ramadhani Nirwana Putri',
            'email' => 'zalfanirwana@gmail.com',
            'password' => Hash::make('yayanpoe'),
            'access' => 'admin',
        ]);
    }
}
