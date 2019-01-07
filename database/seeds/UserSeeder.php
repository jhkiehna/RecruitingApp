<?php

use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
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
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
    }
}
