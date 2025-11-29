<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Super Administrator';
        $user->email = 'super@admin.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('super@admin');
        $user->role = User::SUPER_ADMINISTRATOR;
        $user->status = User::ACTIVE;
        $user->save();
    }
}
