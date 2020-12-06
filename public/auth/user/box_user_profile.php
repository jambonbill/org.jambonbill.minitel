<?php
//user profile

$htm='<pre>'.print_r($AUP,1).'</pre>';

$box=new LTE\Card;
$box->title("User profile");
//$box->icon("fa fa-edit");
$box->body($htm);

$btns="<a href=# id=btnSave class='btn btn-sm btn-primary'><i class='fa fa-save'></i> Save</a> ";
$btns.="<a href=# id=btnPassword class='btn btn-sm btn-default'>Change password</a> ";
$btns.="<a href=# id=btnDelete class='btn btn-sm btn-default float-right'><i class='fa fa-trash'></i></a>";
//$box->footer($btns);
echo $box;
