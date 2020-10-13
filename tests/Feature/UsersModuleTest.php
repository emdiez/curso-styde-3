<?php

namespace Tests\Feature;

use App\Profession;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_loads_the_users_list_page()
    {
        // $this->withoutExceptionHandling();

        factory(Profession::class)->create();

        factory(User::class)->create([
            'name' => 'Salo'
        ]);

        factory(User::class)->create([
            'name' => 'Viry'
        ]);

        $this->get('usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Salo')
            ->assertSee('Viry');
    }

    /** @test */
    function it_loads_the_users_list_page_without_data()
    {
        $this->withoutExceptionHandling();
        // dd(User::count());

        $this->get('usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');
    }


    /** @test */
    function it_loads_the_users_details_page()
    {
        factory(Profession::class)->create();

        $user = factory(User::class)->create([
            'name' => 'Salo'
        ]);

        $this->get('usuarios/' . $user->id)
            ->assertStatus(200)
            ->assertSee('Salo');
    }

    /** @test */
    function it_loads_the_users_create_page()
    {
        $this->get('usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear nuevo usuario');
    }

     /** @test */
    function it_loads_the_users_edit_page()
    {
        $this->withoutExceptionHandling();

        $this->get('usuarios/4/edit')
            ->assertStatus(200)
            ->assertSee('Editar usuario 4');
    }
}
