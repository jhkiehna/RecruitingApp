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
            'name' => 'testAdmin',
            'email' => 'tester@test.com',
            'password' => bcrypt('Tester12'),
        ]);
    }
}
