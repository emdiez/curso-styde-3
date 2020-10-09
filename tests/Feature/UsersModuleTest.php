<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    /** @test */
    function it_loads_the_users_list_page()
    {
        $this->get('usuarios')
            ->assertStatus(200)
            ->assertSee('Usuarios');
    }

    /** @test */
    function it_loads_the_users_details_page()
    {
        $this->get('usuarios/6')
            ->assertStatus(200)
            ->assertSee('Detalle de usuario 6');
    }

    /** @test */
    function it_loads_the_users_create_page()
    {
        $this->get('usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear nuevo usuario');
    }
}
