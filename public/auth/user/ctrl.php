<?php
header('Content-Type: application/json');
session_start();

require __DIR__."/../../../vendor/autoload.php";

$B=new Djang\Base;

$dat['post']=$_POST;
switch($_POST['do'])
{

    case 'update':
        $USR=new Djang\User($B);
        $USR->update($_POST['user_id'], $_POST);
        exit(json_encode($dat));


    /*
    case 'updatePassword':
        $USR=new Djang\User($B);
        //print_r($_POST);exit;
        $UD=new Djang\UserDjango($B->db());
        $encrypted=$UD->djangopassword($_POST['pw']);//encrypt
        $dat['updated']=$USR->updatePassword($_POST['user_id'], $encrypted);
        exit(json_encode($dat));
    */

    case 'deactivate'://de-activate user (mark as inactive, delete sessions)
        $USR=new CRM\User($B);
        $dat['updated']=$USR->deactivate($_POST['user_id']);
        exit(json_encode($dat));


    case 'getAgents':
        $A=new Djang\Auth($B);
        $dat['agents']=$A->userAgents($_POST['user_id']);
        exit(json_encode($dat));


    case 'getGroups':
        $A=new Djang\Auth($B);
        $groups=[];
        $groupids=$A->userGroups($_POST['user_id']);
        foreach($groupids as $id){
            $group=$A->group($id);
            if ($group) {
                $groups[]=$group;
            }
        }
        $dat['groups']=$groups;
		exit(json_encode($dat));


    case 'groupUserAdd':
        $A=new Djang\Auth($B);
        $dat['created']=$A->groupUserAdd($_POST['group_id'], $_POST['user_id']);
        exit(json_encode($dat));


    case 'comment'://create comment
        $USR=new CRM\User($B);
        $dat['created']=$USR->commentCreate($_POST['user_id'], $_POST['comment']);
        exit(json_encode($dat));


    case 'getComments':
        $USR=new CRM\User($B);
        $comments=$USR->comments($_POST['user_id']);
        foreach($comments as $k=>$v){
            $comments[$k]['username']=$B->userName($v['auc_creator']);
        }
        $dat['comments']=$comments;
        exit(json_encode($dat));


    case 'getPermissions':
    	$A=new Djang\Auth($B);
    	$dat['perms']=$A->userPermissions($_POST['user_id']);
    	exit(json_encode($dat));


    default:
        $dat['error']='do what?';
        exit(json_encode($dat));

}

die("Error");