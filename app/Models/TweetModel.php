<?php 

namespace App\Models;

use CodeIgniter\Model;

class TweetModel extends Model{
    public function createTweet($data){
        $table = $this->db->table('t_tweets');
        $table->insert($data);
        return $this->db->insertID();
    }

    public function getTweets(){
        $table = $this->db->table('t_tweets');
        return $table->get()->getResultArray();
    }

    public function getTweetsByUserId($id){
        $table = $this->db->table('t_tweets');
        $table->where(['id_user' => $id]);
        return $table->get()->getResultArray();
    }

    public function deleteTweet($data){
        $table = $this->db->table('t_tweets');
        $table->where($data);
        return $table->delete();
    }
    
}