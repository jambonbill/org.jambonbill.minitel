<?php
/**
 * Users controller
 */

header('Content-Type: application/json');
session_start();

require __DIR__."/../../../vendor/autoload.php";

$B=new Djang\Base;
$B->ctrl();//check a few things


$dat=[];
$dat['POST']=$_POST;

switch($_POST['do']){

    case 'get':

        $WHERE=[];
        $WHERE[]='1=1';

        if ($_POST['role']) {
            switch($_POST['role']){

                case "staff":
                    $WHERE[]='is_staff=1';
                    break;

                case "inactive":
                    $WHERE[]='is_active=0';
                    break;

            }
        }

        if (isset($_POST['group_id'])&&$_POST['group_id']>0) {
            $group_id=+$_POST['group_id'];
            $WHERE[]="id IN (SELECT user_id FROM auth_user_groups WHERE group_id=$group_id)";
        }

        $sql="SELECT * FROM auth_user WHERE ".implode(" AND ", $WHERE)." LIMIT 100;";
        $q=$B->db()->query($sql) or die("Error:$sql");

        $users=[];
        while($r=$q->fetch(PDO::FETCH_ASSOC)){
            $users[]=$r;
        }

        foreach($users as $k=>$r){
            //filter roles
            $users[$k]['is_active']*=1;
            $users[$k]['is_staff']*=1;
        }

        $dat['users']=$users;

        exit(json_encode($dat));


    case 'create':
        $USER=new Djang\User($B);
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $dat['user_id']=$USER->create($_POST['email'], $_POST['first_name'] ,$_POST['last_name']);
        } else {
            $dat['error']="not a valid email address";
        }
        exit(json_encode($dat));


    default:
        $dat['error']='do what?';
        exit(json_encode($dat));
}