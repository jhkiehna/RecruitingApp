<?php

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
        DB::table('users')->insert([
            'email' => 'tester@test.com',
            'password' => bcrypt('Tester12'),
        ]);

        DB::table('users')->insert([
            'email' => 'justinw@kimmel.com',
            'password' => bcrypt('Tempor@ry12'),
        ]);
    }
}
