<?php
header('Content-Type: application/json');

require __DIR__."/../../vendor/autoload.php";

$dat=[];//payload
//sleep(1);
switch($_POST['do'])
{
	case "get":
		$dat['vdt']=base64_encode(file_get_contents('vdt/france.vdt'));
		exit(json_encode($dat));
		break;

	default:
		echo json_encode($dat);
}