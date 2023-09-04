<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        $user = User::firstOrCreate([
            'name' => "Admin",
            'email' => 'admin@i4t.com',
            'password' => bcrypt('admin1234'),
            'created_at' => Carbon::now()
        ]);
        if ($user) {
            $user->assignRole(1);
        }

        $user = User::firstOrCreate([
            'name' => "Manager",
            'email' => 'manager@i4t.com',
            'password' => bcrypt('manager1234'),
            'created_at' => Carbon::now()
        ]);
        if ($user) {
            $user->assignRole(2);
        }


    }
}
