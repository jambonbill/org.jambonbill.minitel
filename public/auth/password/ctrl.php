<?php
/**
 * controller : change password
 */

header('Content-Type: application/json');
session_start();

require __DIR__."/../../../vendor/autoload.php";

$B=new Djang\Base();
$UD=new Djang\UserDjango($B->db());
$USR=new CRM\User($B);

$B->ctrl();//check a few things


$dat=[];
$dat['POST']=$_POST;

switch($_POST['do']){

	case "change":
		if($USR->updatePassword($B->userId(), $UD->djangopassword($_POST['p1']))){
		    header('location:/auth/login');
		    exit("done");
		}else{
		    exit("error");
		}
		break;

	default:
	    $dat['error']='do what?';
	    exit(json_encode($dat));

}

