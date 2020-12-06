<?php
/**
 * Login script
 */
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__ . "/../../../vendor/autoload.php";

if(empty($_POST['email'])||empty($_POST['password'])){
	header('location:/auth/login');
}

// Login logic //
$B=new Djang\Base();

if($B->login($_POST['email'], $_POST['password'])){
    header('location:/home');
}else{
    header('location:./?error=1');
}