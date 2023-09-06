<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Laratrust\Models\LaratrustRole;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrCreate(
            [
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt(1234),
            'email_verified_at' => now()
            ]
        );
        
        $user = User::firstOrCreate(
            [
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => bcrypt(1234),
            'email_verified_at' => now()
            ]
        );

        $admin->syncRoles([LaratrustRole::where('name', 'admin')->first()]);
        $user->syncRoles([LaratrustRole::where('name', 'user')->first()]);
    }
}
