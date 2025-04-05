<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'first_name' => 'Jane',
            'middle_name' => 'D.',
            'last_name' => 'Doe',
            'name' => 'member',
            'email' => 'member@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('member');
    }
}
