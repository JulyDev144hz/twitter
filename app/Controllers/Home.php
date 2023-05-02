<?php

namespace App\Controllers;

use App\Models\TweetModel;
use App\Models\UserModel;

class Home extends BaseController
{



    public function index()
    {
        $TweetModel = new TweetModel();
        $UserModel = new UserModel();

        $tweets = $TweetModel->getTweets();
        $index = 0;
        foreach ($tweets as $tweet) {
            $user = $UserModel->getUser(['id_user' => $tweet['id_user']])[0];
            $tweets[$index]['username'] = $user['username'];
            $tweets[$index]['image'] = $user['image'];
            $index++;
        }


        $data = [
            'username' => session('username'),
            'typeUser' => session('typeUser'),
            'image' => session('image'),
            'alert' => session('alert'),
            'toast' => session('toast'),
            'tweets' => $tweets,
        ];
        if (!$data['username']) {
            return redirect()->to('/login');
        } else {
            return view('inicio', $data);
        }
    }

    public function editProfilePage()
    {


        $data = [
            'username' => session('username'),
            'image' => session('image'),
            'type' => session('typeUser'),
            'alert' => session('alert'),
            'toast' => session('toast'),
        ];


        if (!$data['username']) {
            return redirect()->to('/login')->with('alert', ['Error', 'Primero debes logearte', 'error']);
        } else {
            return view('editProfile', $data);
        }
    }

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

        $response = $UserModel->updateUser($data);

        if ($response > 0) {
            return redirect()->to('/');
        } else {
            return redirect()->to("/")->with("toast", "Hubo un error");
        }
    }

    public function createTweet()
    {
        $data = [
            'username' => session('username'),
            'type' => session('typeUser'),
        ];

        if (!$data['username']) {
            return redirect()->to('/login')->with('alert', ['Error', 'No puedes twittear sin logearte', 'error']);
        } else {
            $UserModel = new UserModel();
            $TweetModel = new TweetModel();

            $response = $UserModel->getUser($data)[0];

            $tweet = [
                'id_user' => $response['id_user'],
                'content' => $_POST['content'],
                'likes' => 0
            ];

            if (strlen(trim($tweet['content'], ' ')) > 0) {
                $TweetModel->createTweet($tweet);
                return redirect()->to('/')->with('toast', 'Tweet creado!');
            } else {

                return redirect()->to('/')->with('toast', 'Error al crear tweet!');
            }
        }
    }

    public function deleteTweet($id)
    {
        $TweetModel = new TweetModel();
        if (session('typeUser') == 'admin') {
            $TweetModel->deleteTweet(['id_tweet' => $id]);
            return redirect()->to('/')->with('toast', 'Tweet Eliminado!');
        } else {
            return redirect()->to('/')->with('toast', 'No puedes hacer eso!');
        }
    }



    public function logOut()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function loginPage()
    {
        $alert = session('alert');

        $data = [
            'username' => session('username'),
            'alert' => $alert
        ];

        if (!$data['username']) {

            return view('login', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function logIn()
    {
        $UserModel = new UserModel();
        $data = $_POST;

        $user = $UserModel->getUser(['username' => $data['username']]);

        if (count($user) > 0 && password_verify($data['password'], $user[0]['password'])) {
            $session = session();
            $session->set('username', $data['username']);
            $session->set('image', $user[0]['image']);
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
