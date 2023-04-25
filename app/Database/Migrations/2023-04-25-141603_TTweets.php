<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TTweets extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tweet' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'content' => [
                'type' => 'text',
            ],
            'likes' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
        ]);
        $this->forge->addKey('id_tweet', true);
        $this->forge->addForeignKey('id_user', 't_usuarios', 'id_user', "CASCADE", "CASCADE");
        $this->forge->createTable('t_tweets');
    }

    public function down()
    {
        $this->forge->dropTable('t_tweets');
    }
}