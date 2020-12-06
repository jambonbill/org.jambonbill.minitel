<?php
/**
 * Box user
 */

$htm='<div class="row">';

$htm.='<input type="hidden" id=user_id value="'.$user['id'].'">';

if(!$user['is_active']){
	$htm.='<div class="col-12">';
	$htm.=new LTE\Callout("danger",'<i class="fas fa-exclamation-triangle"></i>',"This account is inactive");
	$htm.='</div>';
}


// name
$htm.='<div class="col-sm-6">';
$htm.='<div class=form-group><label>Username</label>';

$htm.='<div class="input-group">';
$htm.='<div class="input-group-prepend">';
	$htm.='<span class="input-group-text"><i class="far fa-user"></i></span>';
$htm.='</div>';

$htm.='<input type="text" class="form-control form-control-sm" id="username" placeholder="Username" value="'.$user['username'].'" autocomplete=off readonly>';
$htm.='</div>';//end group
$htm.='</div></div>';

//email
$htm.='<div class="col-sm-6">';
$htm.='<div class=form-group><label>Email</label>';

$htm.='<div class="input-group">';
$htm.='<div class="input-group-prepend">';
	$htm.='<span class="input-group-text"><i class="far fa-envelope"></i></span>';
$htm.='</div>';

$htm.='<input type="email" class="form-control form-control-sm" id="email" placeholder="Email" value="'.$user['email'].'" autocomplete=off>';
$htm.='</div></div>';

$htm.='</div>';//end group
$htm.='</div>';

// First name / Last name
$htm.='<div class="row">';

$htm.='<div class="col-6">';// First name
$htm.='<div class=form-group><label>First name</label>';
$htm.='<input type="text" class="form-control form-control-sm" id="first_name" placeholder="First name" value="'.$user['first_name'].'" autocomplete=off>';
$htm.='</div></div>';

$htm.='<div class="col-6">';// Last name
$htm.='<div class=form-group><label>Last name</label>';
$htm.='<input type="text" class="form-control form-control-sm" id="last_name" placeholder="Last name" value="'.$user['last_name'].'" autocomplete=off>';
$htm.='</div></div>';
$htm.='</div>';



// Last login / Date joined
$htm.='<div class="row">';

$htm.='<div class="col-sm-6">';// Date joined
$htm.='<div class=form-group><label>Date joined: </label> ';
$htm.=substr($user['date_joined'],0,10);
//$htm.='<input type="text" class="form-control form-control-sm" id="date_joined" placeholder="Date joined" value="'.$user['date_joined'].'" readonly>';
$htm.='</div></div>';

$htm.='<div class="col-sm-6">';// Last login
$htm.='<div class=form-group><label>Last login: </label> ';
$htm.=substr($user['last_login'],0,10);
//$htm.='<input type="text" class="form-control form-control-sm" id="last_login" placeholder="last login" value="'.$user['last_login'].'" readonly>';
$htm.='</div></div>';


$htm.='<div class="col-sm-12">';

//Is active
$htm.='<label for="is_active">';
if($user['is_active']){
	$htm.='<input type="checkbox" checked id="is_active">';
}else{
	$htm.='<input type="checkbox" id="is_active">';
}
$htm.=' is active </label><br />';

//Is staff
/*
$htm.='<label for="is_staff">';
if ($user['is_staff']) {
	$htm.='<input type="checkbox" checked id="is_staff" disabled>';
} else {
	$htm.='<input type="checkbox" id="is_staff" disabled>';
}

$htm.=' is staff</label><br />';
*/

//Is superuser
//$htm.='<label><input type="checkbox" class="" id="is_active"> superuser</label><br />';

$htm.='</div>';
$htm.='</div>';

/*
<div class="input-group">
    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
    <input type="text" class="form-control" placeholder="Email">
</div>
*/


$box=new LTE\Card;
$box->id("boxUser");
$box->icon("far fa-address-card");
$box->small("#".$user['id']);

if($user['is_active']==0){
	$box->type("danger");
	$box->small("inactive");
	$box->title($user['first_name'].' '.$user['last_name']);
}else if($user['is_staff']){
	$box->title($user['username']." [STAFF]");
}else{
	$box->title($user['first_name'].' '.$user['last_name']);
}

$box->body($htm);

$btns ="<button id=btnSave class='btn btn-sm btn-default' disabled><i class='fas fa-save'></i> Update</button> ";
$btns.="<button id=btnPassword class='btn btn-sm btn-default' disabled title='Superuser only'><i class='fas fa-key'></i> Change password</button> ";
$btns.="<button id=btnAgent class='btn btn-sm btn-default'><i class='fas fa-desktop'></i> UA</button> ";

if ($user['is_active']) {
	$btns.="<button id=btnDelete class='btn btn-sm btn-default float-right'><i class='fas fa-trash'></i></button>";
}


$box->footer($btns);
echo $box;
