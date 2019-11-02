<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Models\User')->create([
            'name' => 'Adolfo',
            'last_name' => 'Meza',
            'type' => 1,
            'email' => 'adolfo77@laratec.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret123'),
            'remember_token' => Str::random(10),
        ]);

        factory('App\Models\User', 10)->create();
    }
}
