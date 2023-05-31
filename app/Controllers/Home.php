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




}