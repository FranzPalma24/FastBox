<?php
    require_once __DIR__.'/../vendor/autoload.php';
    $mongoClient = new MongoDB\Client('mongodb+srv://franzpalmadsi:S05k35z2nCtw2UT6@cluster0.8p2xd.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0');
    $database = $mongoClient->selectDataBase('escuela');
    $tasksCollection = $database->tareas;