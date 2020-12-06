<?php
// Auth_user
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../../vendor/autoload.php";


$B=new Djang\Base;

if (!$B->isStaff()) {
    header('location:/auth/login');
    exit;
}

$USR=new Djang\User($B);//?

//print_r($_GET);

//$user=$USR->profile($_GET['id']);
$user=$USR->auth_user($_GET['id']);

//print_r($user);exit;
if (!isset($user['id'])) {
    //header('location: /auth/users');
    exit('?');
}

$admin = new LTE\Admin;
echo $admin;

?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header container">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Auth user
                <small><a href="/auth/users">Users</a></small>
            </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="container">

        <div class='row'>

            <div class='col-md-6'>
            <?php
            require "box_user.php";
            require "box_groups.php";
            //require "box_permissions.php";
            //require "box_debug.php";
            ?>
            </div>

            <div class='col-md-6'>
            <?php

            //require "box_user_profile.php";
            //require "box_comment.php";
            ?>
            </div>
        </div>

        <div class='row'>

            <div class='col-md-6'>
            <?php

            ?>
            </div>

            <div class='col-md-6'>
            <?php

            ?>
            </div>
        </div>


    </section>

</div>

<script type="text/javascript" src='js/user.js'></script>
<script type="text/javascript" src='js/group.js'></script>

<?php
require "modal_agents.php";
require "modal_groups.php";
$admin->end();