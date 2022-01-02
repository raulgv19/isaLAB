<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();


        $adminRole = Role::where('role_name', 'Admin')->first();
        $clientRole = Role::where('role_name', 'Socio')->first();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $admin->roles()->attach($adminRole);

        $client = User::create([
            'name' => 'Socio',
            'email' => 'socio@socio.com',
            'password' => Hash::make('password'),
        ]);
        $client->roles()->attach($clientRole);

    }
}
