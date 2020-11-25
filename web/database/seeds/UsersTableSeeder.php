<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->delete();

        // create users
        factory(User::class)->create([
            'name' => 'admin',
            'password' => bcrypt('wirtesten'),
            'email' => 'mobex@example.net',
        ]);
    }
}
