<?php

    require 'config/db.php';
    require 'funciones.php';
    require __DIR__ . '/../vendor/autoload.php';

    $db = conectarDB();

    use Model\ActiveRecord;

    ActiveRecord::setDB($db);