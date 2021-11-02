<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserService;


class UserController extends Controller
{
    private $users;

    function __construct(UserService $UserService){
        $this->users = $UserService;
    }

    function login() {
        return view('login_page');
    }

    function login_check(Request $request)
    {
        $logined_user = $this->users->login_ok($request->all());

        if($logined_user)
        {
            session(['user'=>$logined_user]);
            return redirect('/')->with('status', 'Successful login!');
        }
        return back()->with('status', 'The provided credentials do not match our records.');
    }

    function logout(Request $request) {
        $request->session()->invalidate();
        return redirect('/');
    }

    function register() {
        return view('page_register');
    }

    function register_check(Request $request){
        $email = $request->email;
        $password = $request->password;

        $user_to_register = $this->users->getOneByEmail($email);
        if($user_to_register){
            return back()->with('status', 'Уведомление! Этот эл. адрес уже занят другим пользователем.');
        } else {
            $this->users->newFromForm(['email'=>$email, 'password'=>$password]);
            $registered_user = $this->users->getOneByEmail($email);
            session(['user'=>$registered_user]);
            return redirect('/')->with('status', 'Successful registration!');
        }
    }

    function all() {
        $users = $this->users->getAll();
        return view('users', ['users' => $users]);
    }

    function create() {
        return view('create_user');
    }

    function store(Request $request) {
        $this->users->new($request->all());
        return redirect('/');
    }

    function edit($id) {
        $user = $this->users->getOne($id);
        return view('edit', ['user' => $user]);
    }

    function update($id, Request $request) {
        $this->users->upd($id, $request->all());
        return redirect('/');
    }

    function security($id) {
        $user = $this->users->getOne($id);
        return view('security', ['user' => $user]);
    }

    function status($id) {
        $user = $this->users->getOne($id);
        return view('status', ['user' => $user]);
    }

    function update_status($id, Request $request) {
        $this->users->upd_status($id, $request->status);
        return redirect('/');
    }

    function media($id) {
        $user = $this->users->getOne($id);
        return view('media', ['user' => $user]);
    }

    function update_media($id, Request $request) {
        $this->users->upd_media($id, $request->image);
        return redirect('/');
    }

    function delete($id) {
        $this->users->del($id);
        return redirect('/');
    }
}

