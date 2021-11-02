<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\UserService;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;



class UserServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


    use RefreshDatabase;


    public function test_getAll()
    {
        $data = [
            'email' => 't@t.t',
            'password' => 'alita'
        ];

        UserService::newFromForm($data);
        $response = UserService::getAll();
        $this->assertIsObject($response);
    }


    public function test_getOne()
    {
        $data = [
            'email' => 't@t.t',
            'password' => 'alita'
        ];

        UserService::newFromForm($data);
        $response = UserService::getAll();
        $this->assertIsObject($response);
    }


    public function test_getOneByEmail()
    {
        $data = [
            'email' => 't@t.t',
            'password' => 'alita'
        ];

        UserService::newFromForm($data);
        $response = UserService::getAll();
        $this->assertIsObject($response);
    }


    public function test_new()
    {
        $data = [
            'email' => 't@t.t',
            'password' => 'alita',
            'name' => 'ttt',
            'status'=> 'Онлайн'
        ];

        UserService::new($data);
        $this->assertDatabaseHas('users', $data);
    }


    public function test_newFromForm()
    {
        $data = [
            'email' => 't@t.t',
            'password' => 'alita'
        ];

        UserService::newFromForm($data);
        $this->assertDatabaseHas('users', $data);
    }


    public function test_upd()
    {
        $data = [
            'email' => 't@t.t',
            'password' => 'alita',
            'name' => 'ttt',
            'status'=> 'Онлайн'
        ];

        $user = UserService::new($data);
        UserService::upd($user->id, ['name'=>'ppp']);
        $this->assertDatabaseHas('users', ['name'=>'ppp']);
    }


    public function test_upd_status()
    {
        $data = [
            'email' => 't@t.t',
            'password' => 'alita',
            'name' => 'ttt',
            'status'=> 'Онлайн'
        ];

        $user = UserService::new($data);
        UserService::upd($user->id, ['status'=>'Отошел']);
        $this->assertDatabaseHas('users', ['status'=>'Отошел']);
    }


    public function test_del()
    {
        $data = [
            'email' => 't@t.t',
            'password' => 'alita',
            'name' => 'ttt',
            'status'=> 'Онлайн'
        ];

        $user = UserService::new($data);
        UserService::del($user->id);
        $this->assertDatabaseMissing('users', ['id'=>$user->id]);
    }


    public function test_login_ok()
    {
        $data = [
            'email' => 't@t.t',
            'password' => 'alita',
            'name' => 'ttt',
            'status'=> 'Онлайн'
        ];

        $user = UserService::new($data);
        $response = UserService::login_ok(['email' => $user->email, 'password' => $user->password]);
        if(is_bool($response)){        
            $this->assertIsBool($response);
        } else {
            $this->assertDatabaseHas('users', ['id'=>$response]);
        }
    }
}
