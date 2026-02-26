<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $staffRole = Role::where('name', 'staff')->first();
        $customerRole = null;

        User::create([
            'name' => 'Alice',
            'email' => 'alice@cafe.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'phone' => '09123456789',
            'address' => 'Yangon, Myanmar',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Bob',
            'email' => 'bob@cafe.com',
            'password' => Hash::make('password'),
            'role_id' => $customerRole,
            'phone' => '09987654321',
            'address' => 'Mandalay, Myanmar',
            'email_verified_at' => now(),
        ]);

        $staffNames = ['Staff One', 'Staff Two', 'Staff Three'];
        $staffEmails = ['staff1@cafe.com', 'staff2@cafe.com', 'staff3@cafe.com'];

        for ($i = 0; $i < 3; $i++) {
            User::create([
                'name' => $staffNames[$i],
                'email' => $staffEmails[$i],
                'password' => Hash::make('password'),
                'role_id' => $staffRole->id,
                'phone' => '09' . rand(100000000, 999999999),
                'address' => 'Cafe Address',
                'email_verified_at' => now(),
            ]);
        }
    }
}
