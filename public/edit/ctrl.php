<?php
/**
 * controller
 */

header('Content-Type: application/json');
session_start();

require __DIR__."/../../vendor/autoload.php";

$B=new Djang\Base();
$B->ctrl();//check a few things


$Script=new Minitel\Script($B);

$dat=[];
$dat['POST']=$_POST;
switch($_POST['do']){

    case 'load':
        $dat['r']=$Script->get($_POST['id']);
        exit(json_encode($dat));

    case 'update':
        $dat['updated']=$Script->update($_POST['id'], $_POST);
        exit(json_encode($dat));


    case 'create':
	    $dat['created']=$Script->create($_POST['name'], '');
		exit(json_encode($dat));

    case 'delete':
        $dat['deleted']=$Script->delete($_POST['id']);
        exit(json_encode($dat));

    default:
        $dat['error']='do what?';
        exit(json_encode($dat));

}