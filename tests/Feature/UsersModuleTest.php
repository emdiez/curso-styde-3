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
    public function it_loads_the_users_list_page()
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
    public function it_loads_the_users_list_page_without_data()
    {
        $this->withoutExceptionHandling();
        // dd(User::count());

        $this->get('usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');
    }

    /** @test */
    public function it_loads_the_users_details_page()
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
    public function it_loads_page_404_if_the_users_not_found()
    {
        // $this->withoutExceptionHandling();

        $this->get('usuarios/9999999')
            ->assertStatus(404)
            ->assertSee('Pagina no encontrada.');
    }

    /** @test */
    public function it_loads_the_users_create_page()
    {
        $this->get('usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Registrar nuevo usuario');
    }

    /** @test */
    public function it_loads_the_users_edit_page()
    {
        factory(Profession::class)->create();

        $user = factory(User::class)->create([
            'name' => 'Salo'
        ]);

        $this->get("usuarios/{$user->id}/edit")
            ->assertStatus(200)
            ->assertSee("Editar usuario {$user->id}");
    }

    /** @test */
    public function it_creates_a_new_user()
    {
        $profession = factory(Profession::class)->create();
        $this->withoutExceptionHandling();

        $this->post('/usuarios', [
            'name' => 'Salomon',
            'email' => 'email@email.com',
            'password' => '123456',
            'profession_id' => $profession->id,
        ])->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'name' => 'Salomon',
            'email' => 'email@email.com',
            'profession_id' => $profession->id,
        ]);

        $this->assertCredentials([
            'name' => 'Salomon',
            'email' => 'email@email.com',
            'password' => '123456'
        ]);
    }

    /** @test */
    public function the_name_is_required_to_creates_a_new_user()
    {
        // $this->withoutExceptionHandling();

        $profession = factory(Profession::class)->create();

        $this->from('/usuarios/nuevo')
            ->post('/usuarios', [
                'name' => '',
                'email' => 'email@email.com',
                'password' => '123456',
                'profession_id' => $profession->id,
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'name' => 'El campo nombres es obligatorio'
            ]);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users', [
            'email' => 'email@email.com',
        ]);
    }
}
