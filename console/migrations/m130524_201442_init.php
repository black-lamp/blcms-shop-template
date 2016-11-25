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

        $this->insert('language', [
            'name' => 'Russian',
            'lang_id' => 'ru',
            'show' => true,
            'active' => true,
            'default' => true
        ]);

        $this->insert('language', [
            'name' => 'Ukrainian',
            'lang_id' => 'uk',
            'show' => true,
            'active' => true,
            'default' => false
        ]);

        $this->update('language', [
            'default' => false
        ], ['lang_id' => 'en-US']);
    }

    public function down()
    {
        $this->delete('user', ['username' => 'admin']);

        $this->delete('language', ['lang_id' => 'ru']);
        $this->delete('language', ['lang_id' => 'uk']);

        $this->update('language', [
            'default' => true
        ], ['lang_id' => 'en-US']);
    }
}
