<?php

namespace App\Controllers;

use App\Models\TweetModel;
use App\Models\UserModel;

class Users extends BaseController
{
    public function editUser()
    {

        $file = $this->request->getFile('image');

        $data = [];

        $session = session();

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/', $newName);
            $data['image'] = $newName;

            $session->set("image", $newName);
        }

        $UserModel = new UserModel();

        $user = $UserModel->getUser(['username' => $_POST['oldUsername']])[0];


        if (strlen($_POST['password']) > 0 && strlen($_POST['oldPassword']) > 0 && strlen($_POST['confirmPassword']) > 0) {

            if (
                password_verify($_POST['oldPassword'], $user['password']) &&
                $_POST['password'] == $_POST['confirmPassword']
            ) {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
        }
        $data['id_user'] = $user['id_user'];
        $data['username'] = $_POST['username'];

        $session->set("username", $data["username"]);
        $session->set("id", $data["id_user"]);

        $response = $UserModel->updateUser($data);

        if ($response > 0) {
            return redirect()->to('/');
        } else {
            return redirect()->to("/")->with("toast", "Hubo un error");
        }
    }
    public function logOut()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function logIn()
    {
        $UserModel = new UserModel();
        $data = $_POST;

        $user = $UserModel->getUser(['username' => $data['username']]);

        if (count($user) > 0 && password_verify($data['password'], $user[0]['password'])) {
            $session = session();
            $session->set('username', $data['username']);
            $session->set('id', $user[0]['id_user']);
            $session->set('image', $user[0]['image']);
            $session->set('rol', $user[0]['id_rol']);
            return redirect()->to('/')->with('alert', ['Logeado!', 'Has Logeado con exito', 'success']);
        } else {
            return redirect()->to('/login')->with('alert', ['Error', 'Usuario o password incorrectas', 'error']);
        }
    }
    public function signUp()
    {
        $UserModel = new UserModel();

        $data = $_POST;
        $data['id_rol'] = 3;
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        if(strlen(trim($data["username"])) < 0  || strlen(trim($data["username"])) <4 ){
            return redirect()->to('/login')->with('alert', ['Error', 'Tu cuenta no ha podido ser creada', 'error']);
        }

        $response = $UserModel->createUser($data);

        if ($response > 0) {
            $session = session();
            $session->set('username', $data['username']);
            $session->set('id',  $response );
            $session->set('rol', $data["id_rol"]);

            return redirect()->to('/')->with('alert', ['Registrado con exito', 'Tu cuenta ha sido creada con exito', 'success']);
        } else {
            return redirect()->to('/login')->with('alert', ['Error', 'Tu cuenta no ha podido ser creada', 'error']);
        }
    }
    public function profile($id)
    {
        $usermodel = new UserModel();
        $tweetsmodel = new TweetModel();

        $user = $usermodel->getUser(["id_user"=>$id])[0];
        $tweets = $tweetsmodel->getTweetsByUserId($id);

        $session = session();
        $session->set('username', $user['username']);
        $session->set('id', $id);
        $session->set('tweets', $tweets);
        $session->set('rol', $user["id_rol"]);
        $session->set('image', $user["image"]);

        $data = [
            'username' => session('username'),
            'id' => session('id'),
            'tweets' => session('tweets'),
            'rol' => session('rol'),
            'image' => session('image'),
        ];


        return view("profileView", $data);

    }
}