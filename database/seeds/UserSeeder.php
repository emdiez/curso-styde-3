<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        DB::table('users')->insert([
            'name' => 'Salomon Machuca',
            'email' => 'em_di-es@hotmail.com',
            'password' => bcrypt('laravel'),
            'profession_id' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
