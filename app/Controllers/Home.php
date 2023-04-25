<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        $alert = session('alert');

        $data = [
            'username' => session('username'),
            'typeUser' => session('typeUser'),
            'alert' => $alert
        ];
        if (!$data['username']) {
            return redirect()->to('/login');
        } else {
            return view('inicio', $data);
        }
    }
    public function logOut(){
        session()->destroy();
        return redirect()->to('/login');
    }

    public function loginPage()
    {
        $alert = session('alert');

        $data = [
            'alert' => $alert
        ];
        return view('login', $data);
    }

    public function logIn()
    {
        $UserModel = new UserModel();
        $data = $_POST;

        $user = $UserModel->getUser(['username' => $data['username']]);
        if (count($user) > 0 && password_verify($data['password'], $user[0]['password'])) {
            $session = session();
            $session->set('username', $data['username']);
            $session->set('typeUser', $user[0]['type']);
            return redirect()->to('/')->with('alert', ['Logeado!', 'Has Logeado con exito', 'success']);
        } else {
            return redirect()->to('/login')->with('alert', ['Error', 'Usuario o password incorrectas', 'error']);
        }
    }

    public function signUp()
    {
        $UserModel = new UserModel();

        $data = $_POST;
        $data['type'] = 'normal';
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $response = $UserModel->createUser($data);

        if ($response > 0) {
            $session = session();
            $session->set('username', $data['username']);
            $session->set('typeUser', 'normal');

            return redirect()->to('/')->with('alert', ['Registrado con exito', 'Tu cuenta ha sido creada con exito', 'success']);
        } else {
            return redirect()->to('/login')->with('alert', ['Error', 'Tu cuenta no ha podido ser creada', 'error']);
        }
    }
}
