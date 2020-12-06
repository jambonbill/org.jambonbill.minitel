<?php
/**
 * Box users
 * @var LTE
 */

$box=new LTE\Card;
$box->title("Users");
$box->id("boxUsers");

$htm='<input type="text" class="form-control form-control-sm" placeholder="Search" id=search autocomplete=off>';
$box->tools($htm);

$box->body('<pre>please wait</pre>');
$box->p0(1);
//$box->footer('<button id=btnNewUser class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> New user</button>');
echo $box;
