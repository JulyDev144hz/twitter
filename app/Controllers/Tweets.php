<?php
namespace App\Controllers;

use App\Models\TweetModel;
use App\Models\UserModel;

class Tweets extends BaseController
{
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
}