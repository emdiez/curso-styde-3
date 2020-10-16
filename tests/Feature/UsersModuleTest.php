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
            ->assertSee("Editar usuario {$user->id}")
            ->assertViewIs('users.edit')
            ->assertViewHas('user', function ($viewUser) use ($user) {
                return $viewUser->id === $user->id;
            });
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

    /** @test */
    public function the_email_is_required_to_creates_a_new_user()
    {
        $profession = factory(Profession::class)->create();

        $this->from('/usuarios/nuevo')
            ->post('/usuarios', [
                'name' => 'Salo',
                'email' => '',
                'password' => '123456',
                'profession_id' => $profession->id,
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'email' => 'El campo email es obligatorio'
            ]);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users', [
            'name' => 'Salo',
        ]);
    }

    /** @test */
    public function the_password_is_required_to_creates_a_new_user()
    {
        // $this->withoutExceptionHandling();
        $profession = factory(Profession::class)->create();

        $this->from('/usuarios/nuevo')
            ->post('/usuarios', [
                'name' => 'Salo',
                'email' => 'email@email.com',
                'password' => '',
                'profession_id' => $profession->id,
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'password' => 'El campo password es obligatorio'
            ]);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users', [
            'email' => 'email@email.com',
        ]);
    }

    public function the_profession_id_is_required_to_creates_a_new_user()
    {
        // $this->withoutExceptionHandling();
        $profession = factory(Profession::class)->create();

        $this->from('/usuarios/nuevo')
            ->post('/usuarios', [
                'name' => 'Salo',
                'email' => 'email@email.com',
                'password' => '',
                'profession_id' => '',
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'profession_id' => 'El campo profession es obligatorio'
            ]);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users', [
            'email' => 'email@email.com',
        ]);
    }

    /** @test */
    public function the_password_should_be_min_6_chars_to_creates_a_new_user()
    {
        // $this->withoutExceptionHandling();
        $profession = factory(Profession::class)->create();

        $this->from('/usuarios/nuevo')
            ->post('/usuarios', [
                'name' => 'Salo',
                'email' => 'email@email.com',
                'password' => '123',
                'profession_id' => $profession->id,
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'password' => 'El campo password debe contener minimo 6 caracteres'
            ]);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users', [
            'email' => 'email@email.com',
        ]);
    }

    /** @test */
    public function the_email_must_be_valide_to_creates_a_new_user()
    {
        $profession = factory(Profession::class)->create();

        $this->from('/usuarios/nuevo')
            ->post('/usuarios', [
                'name' => 'Salo',
                'email' => 'email',
                'password' => '123456',
                'profession_id' => $profession->id,
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'email' => 'El campo email debe ser valido'
            ]);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users', [
            'email' => 'email@email.com',
        ]);
    }

    /** @test */
    public function the_email_must_be_unique_to_creates_a_new_user()
    {
        $profession = factory(Profession::class)->create();

        factory(User::class)->create([
            'email' => 'email@email.com',
            'profession_id' => $profession->id,
        ]);

        $this->from('/usuarios/nuevo')
            ->post('/usuarios', [
                'name' => 'Salo',
                'email' => 'email@email.com',
                'password' => '123456',
                'profession_id' => $profession->id,
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'email' => 'El campo email debe ser unico'
            ]);

        $this->assertEquals(1, User::count());
    }


    /** @test */
    public function the_profession_should_be_exists_to_creates_a_new_user()
    {
        $profession = factory(Profession::class)->create();

        $this->from('/usuarios/nuevo')
            ->post('/usuarios', [
                'name' => 'Salo',
                'email' => 'email@email.com',
                'password' => '123456',
                'profession_id' => 1000,
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'profession_id' => 'Debe seleccionar una profesion existente'
            ]);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users', [
            'name' => 'Salo',
            'email' => 'email@email.com',
        ]);

    }


    /** @test */
    public function it_update_the_user()
    {
        $this->withoutExceptionHandling();

        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create();

        $this->put("/usuarios/{$user->id}", [
            'name' => 'Salomon',
            'email' => 'email@email.com',
            'password' => '123456',
            'profession_id' => $profession->id,
        ])->assertRedirect(route('users.show', ['user' => $user]));

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
    public function the_name_is_required_to_update_the_user()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create(['name' => 'Salo']);

        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/{$user->id}", [
                'name' => '',
                'email' => 'email@email.com',
                'password' => '123456',
                'profession_id' => $profession->id,
            ])
            ->assertRedirect(route('users.edit', ['user' => $user]))
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseHas('users', [
            'name' => 'Salo',
        ]);
    }

    /** @test */
    public function the_email_is_required_to_update_the_user()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create(['email' => 'email@email.com']);

        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Salo',
                'email' => '',
                'password' => '123456',
                'profession_id' => $profession->id,
            ])
            ->assertRedirect(route('users.edit', ['user' => $user]))
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseHas('users', [
            'email' => 'email@email.com',
        ]);
    }

    /** @test */
    public function the_email_must_be_unique_to_update_the_user()
    {
        static::markTestIncomplete();
        return;

        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create(['email' => 'email@email.com']);

        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Salo',
                'email' => 'email@email.com',
                'password' => '123456',
                'profession_id' => $profession->id,
            ])
            ->assertRedirect(route('users.edit', ['user' => $user]))
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseHas('users', [
            'email' => 'email@email.com',
        ]);
    }

    /** @test */
    public function the_email_must_be_valid_to_update_the_user()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create(['email' => 'email@email.com']);

        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Salo',
                'email' => 'email',
                'password' => '123456',
                'profession_id' => $profession->id,
            ])
            ->assertRedirect(route('users.edit', ['user' => $user]))
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseHas('users', [
            'email' => 'email@email.com',
        ]);
    }

    /** @test */
    public function the_password_is_optional_to_update_the_user()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create([
            'email' => 'email@email.com',
            'password' => bcrypt('CLAVE_ANTERIOR')
        ]);

        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Salo',
                'email' => 'emailmodificado@email.com',
                'password' => '',
                'profession_id' => $profession->id,
            ])
            ->assertRedirect(route('users.show', ['user' => $user]));

        $this->assertCredentials([
            'email' => 'emailmodificado@email.com',
            'password' => 'CLAVE_ANTERIOR'
        ]);
    }

    /** @test */
    public function the_password_should_be_min_6_chars_to_update_the_user()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create(['email' => 'email@email.com']);

        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Salo',
                'email' => 'emailmodificado@email.com',
                'password' => '123',
                'profession_id' => $profession->id,
            ])
            ->assertRedirect(route('users.edit', ['user' => $user]))
            ->assertSessionHasErrors(['password']);

        $this->assertDatabaseHas('users', [
            'email' => 'email@email.com',
        ]);
    }

    public function the_profession_id_is_required_to_update_the_user()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create(['email' => 'email@email.com']);

        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Salo',
                'email' => 'emailmodificado@email.com',
                'password' => '',
                'profession_id' => '',
            ])
            ->assertRedirect(route('users.edit', ['user' => $user]))
            ->assertSessionHasErrors(['profession_id']);

        $this->assertDatabaseHas('users', [
            'email' => 'email@email.com',
        ]);
    }

    /** @test */
    public function the_profession_id_must_be_exists_to_update_the_user()
    {
        $profession = factory(Profession::class)->create();
        $user = factory(User::class)->create(['email' => 'email@email.com']);

        $this->from("/usuarios/{$user->id}/edit")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Salo',
                'email' => 'emailmodificado@email.com',
                'password' => '123',
                'profession_id' => 1000,
            ])
            ->assertRedirect(route('users.edit', ['user' => $user]))
            ->assertSessionHasErrors(['password']);

        $this->assertDatabaseHas('users', [
            'email' => 'email@email.com',
        ]);
    }
}
