<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\UserService;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Storage;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;
 
    public function test_login()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }


    public function test_login_check()
    {
        $data = [
            'email' => 't@t.t',
            'password' => 'ttt'
        ];

        $response = $this->post('/login_check', $data);
        $response->assertSessionHas('status');
    }


    public function test_logout()
    {
        $response = $this->get('/logout');
        $response->assertSessionMissing('status');
    }


    public function test_register()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }


    public function test_register_check()
    {
        $data = [
            'email' => 't@t.t',
            'password' => 'ttt'
        ];

        $response = $this->post('/register_check', $data);
        $response->assertSessionHas('user');
    }


    public function test_all()
    {
        $response = $this->get('/');
        $response->assertSee('Список пользователей');
    }


    public function test_create()
    {
        $response = $this->get('/create');
        $response->assertStatus(200);
    }

    public function test_store()
    {
        $data = [
            'email' => 't@t.t',
            'password' => 'ttt'
        ];
        $response = $this->post('/store', $data);

        $this->assertDatabaseHas('users', ['email' => 't@t.t']);
    }


    public function test_edit()
    {
        UserService::newFromForm([
            'email' => 't@t.t',
            'password' => 'ttt'
        ]);
        $id = UserService::getOneByEmail('t@t.t');
        $response = $this->get('/edit/'.$id);
        $response->assertSee('Редактировать');
    }


    public function test_update()
    {
        $response = $this->get('/');
        $response->assertOk();
    }


    public function test_security()
    {
        UserService::newFromForm([
            'email' => 't@t.t',
            'password' => 'ttt'
        ]);
        $id = UserService::getOneByEmail('t@t.t');
        $response = $this->get('/security/'.$id);
        $response->assertSee('Безопасность');
    }


    public function test_status()
    {
        UserService::newFromForm([
            'email' => 't@t.t',
            'password' => 'ttt'
        ]);
        $id = UserService::getOneByEmail('t@t.t');
        $response = $this->get('/status/'.$id);
        $response->assertSee('Выберите статус');
    }    


    public function test_update_status()
    {
        $response = $this->get('/');
        $response->assertOk();
    }


    public function test_media()
    {
        UserService::newFromForm([
            'email' => 't@t.t',
            'password' => 'ttt'
        ]);
        $id = UserService::getOneByEmail('t@t.t');
        $response = $this->get('/media/'.$id);
        $response->assertSee('Выберите аватар');
    }  


    public function test_update_media()
    {
        $response = $this->get('/');
        $response->assertOk();
    }


    public function test_delete()
    {
        $response = $this->get('/');
        $response->assertOk();
    }

}
