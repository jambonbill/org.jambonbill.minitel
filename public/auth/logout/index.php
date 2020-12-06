<?php

header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__ . "/../../../vendor/autoload.php";


$B=new Djang\Base();
$B->logout();

header('location:/auth/login');