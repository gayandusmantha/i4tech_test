<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Carbon\PHPStan\AbstractMacro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Schema;
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

        Role::firstOrCreate([
            'name' => "administrator",
            'guard_name' => 'web',
            'created_at' => Carbon::now()
        ]);

        Role::firstOrCreate([
            'name' => "manager",
            'guard_name' => 'web',
            'created_at' => Carbon::now()
        ]);
    }
}
