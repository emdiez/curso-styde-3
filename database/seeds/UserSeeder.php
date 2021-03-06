<?php

use App\Profession;
use App\User;
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

        // $professions = DB::select('SELECT id FROM professions WHERE title=:title LIMIT 0,1', ['title' => 'Desarrollador Back-end']);
        // $profession = DB::table('professions')->select('id')->where('title', 'Desarrollador Back-end')->take(1)->get();
        // $profession = DB::table('professions')->select('id')->where('title', 'Desarrollador Back-end')->first();
        // $profession = DB::table('professions')->select('id')->whereTitle('Desarrollador Back-end')->first();

        // $professionId = DB::table('professions')->where('title', 'Desarrollador Back-end')->value('id');

        // DB::table('users')->insert([
        //     'name' => 'Salomon Machuca',
        //     'email' => 'em_di-es@hotmail.com',
        //     'password' => bcrypt('laravel'),
        //     'profession_id' => $professionId,
        //     'created_at' => $now,
        //     'updated_at' => $now
        // ]);

        $professionId = Profession::where('title', 'Desarrollador Back-end')->value('id');
        $professionIdFront = Profession::where('title', 'Desarrollador Front-end')->value('id');

        factory(User::class)->create([
            'name' => 'Salomon Machuca',
            'email' => 'em_di-es@hotmail.com',
            'password' => bcrypt('laravel'),
            'profession_id' => $professionId,
            'is_admin' => true
        ]);

        factory(User::class)->create([
            'name' => 'Otro usuario',
            'email' => 'otro@otro.com',
            'password' => bcrypt('laravel'),
            'profession_id' => $professionId,
        ]);

        factory(User::class, 48)->create();
    }
}
