<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUserTest extends TestCase
{
    /** @test */
    function it_loads_the_users_with_nickname_page()
    {
        $this->get('usuario/salo/emdiez')
            ->assertStatus(200)
            ->assertSee('Hola Salo, tu apodo es emdiez');
    }

    /** @test */
    function it_loads_the_users_without_nickname_page()
    {
        $this->get('usuario/salo')
            ->assertStatus(200)
            ->assertSee('Hola Salo');
    }
}
