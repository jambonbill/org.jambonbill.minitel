<?php
//auth_user permissions

$box=new LTE\Card;
$box->id("boxPermissions");
$box->title("Permission(s)");
$box->body("<pre>please wait</pre>");
//$box->removable(1);

$btns='<div class="row">';
$btns.='<div class="col-6">';
$btns.='<select class="form-control form-control-sm">';
$btns.='<option value="xxx">Select permission';
$btns.='</select>';
$btns.='</div>';
$btns.='<div class="col-6">';
$btns.="<button id=btnAddPermission class='btn btn-sm btn-default'><i class='fa fa-plus-circle'></i> Add permission</button> ";
$btns.='</div>';
$btns.='</div>';

$box->footer($btns);
echo $box;