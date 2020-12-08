<?php
/**
 * controller
 */

header('Content-Type: application/json');
session_start();

require __DIR__."/../../../vendor/autoload.php";

$B=new Djang\Base();
$B->ctrl();//check a few things


$Page=new Minitel\Page($B);

$dat=[];
$dat['POST']=$_POST;
switch($_POST['do']){

    case 'list':
        $dat['pages']=$Pages->list();
        exit(json_encode($dat));

    default:
        $dat['error']='do what?';
        exit(json_encode($dat));

}