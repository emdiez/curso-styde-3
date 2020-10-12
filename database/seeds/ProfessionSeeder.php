<?php

use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::insert('INSERT INTO professions(title) VALUES(?)', ['Desarrollador Front-end']);
        // DB::insert('INSERT INTO professions(title) VALUES(:title)', ['title' => 'Desarrollador Back-end']);
        // DB::insert('INSERT INTO professions(title) VALUES(:title)', ['title' => 'Diseñador web']);

        // DB::table('professions')->insert([
        //     'title' => 'Desarrollador Back-end'
        // ]);

        // DB::table('professions')->insert([
        //     'title' => 'Desarrollador Front-end'
        // ]);

        // DB::table('professions')->insert([
        //     'title' => 'Diseñador web'
        // ]);

        factory(Profession::class)->create([
            'title' => 'Desarrollador Back-end'
        ]);

        factory(Profession::class)->create([
            'title' => 'Desarrollador Front-end'
        ]);

        factory(Profession::class)->create([
            'title' => 'Diseñador web'
        ]);

        factory(Profession::class)->times(17)->create();
    }
}
