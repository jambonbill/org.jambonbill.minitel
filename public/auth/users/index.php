<?php

header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../../vendor/autoload.php";

$B=new Djang\Base;

if (!$B->isStaff()) {
    header('location:/auth/login');
    exit;
}

$admin = new LTE\Admin();
echo $admin;//

?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Auth users
                <button id=btnNewUser class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> New user</button>
            </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="container">

        <div class='row'>
            <div class='col-md-3'>
            <?php
            require "box_filter.php";
            //require "box_users.php";
            ?>
            </div>
            <div class='col-md-9'>
            <?php
            //require "box_filter.php";
            require "box_users.php";
            ?>
            </div>
        </div>

    </section>

</div>

<script type="text/javascript" src='./js/users.js'></script>

<?php
require "modal_usernew.php";
$admin->end();