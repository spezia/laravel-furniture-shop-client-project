<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create users
        factory(User::class)->create([
            'name' => 'admin',
            'password' => bcrypt('wirtesten'),
            'email' => 'mobex@example.net',
        ]);

        factory(User::class)->create([
            'name' => 'user',
            'password' => bcrypt('wirtesten'),
            'email' => 'user@example.net',
        ]);
    }
}
