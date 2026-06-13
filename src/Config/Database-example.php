<?php

class Database {
    public static function connect(){
        return new PDO(
            'mysql:host=nomeHost;dbname=seuDBname;charset=utf8',
            username:'usuario',
            password: 'senhaDB',
            options:[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}