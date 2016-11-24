<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $this->insert('user', [
            'username' => 'admin',
            'email' => Yii::$app->params['adminEmail'],
            'password_hash' => Yii::$app->security->generatePasswordHash('adminadmin'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'confirmed_at' => time(),
            'registration_ip' => '127.0.0.1',
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    public function down()
    {
        $this->delete('user', ['username' => 'admin']);
    }
}
