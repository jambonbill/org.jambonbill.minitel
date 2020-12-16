<?php
/**
 * controller
 */

header('Content-Type: application/json');
session_start();
//sleep(2);

require __DIR__."/../../vendor/autoload.php";
$B=new Djang\Base();
$B->ctrl();//check a few things


$Page=new Minitel\Page($B);

$dat=[];
$dat['POST']=$_POST;
switch($_POST['do']){

    case 'list':
        $dat['pages']=$Page->list();
        exit(json_encode($dat));

    case 'create':
        $dat['created']=$Page->create($_POST['name'],$_POST['b64']);
        exit(json_encode($dat));

    case 'delete':
	    $dat['deleted']=$Page->delete($_POST['id']);
        exit(json_encode($dat));

    case 'get':
        $r=$Page->get($_POST['id']);
        $r['b64']=base64_encode($r['data']);
        unset($r['data']);
        $dat['data']=$r;
        exit(json_encode($dat));

    default:
        $dat['error']='do what?';
        exit(json_encode($dat));

}