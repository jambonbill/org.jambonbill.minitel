<?php
/**
 * Modal new user
 */


$htm ='<form id=fnew>';
$htm.='<div class="row">';

$htm.='<div class="col-6">';
$htm.='<div class="form-group">';
$htm.='<label>Email</label>';
$htm.='<input type="email" id=email class="form-control form-control-sm" placeholder="email" autocomplete="off" maxlength=254 required>';
$htm.='</div>';
$htm.='</div>';

$htm.='<div class="col-6">';
$htm.='<div class="form-group">';
$htm.='<label>Username</label>';
$htm.='<input type="text" id=username class="form-control form-control-sm" placeholder="username" autocomplete="off" maxlength=45>';
$htm.='</div>';
$htm.='</div>';

$htm.='<div class="col-6">';
$htm.='<div class="form-group">';
$htm.='<label>First name</label>';
$htm.='<input type="text" id=first_name class="form-control form-control-sm" placeholder="First" autocomplete="off" maxlength=30>';
$htm.='</div>';
$htm.='</div>';

$htm.='<div class="col-6">';
$htm.='<div class="form-group">';
$htm.='<label>Last name</label>';
$htm.='<input type="text" id=last_name class="form-control form-control-sm" placeholder="Last name" autocomplete="off" maxlength=30>';
$htm.='</div>';
$htm.='</div>';
$htm.='</div>';

$htm.='</form>';


$modal=new LTE\Modal;
$modal->id('modalUserNew');
$modal->icon('fas fa-plus-circle');
$modal->title('New user');
$modal->body($htm);

$btns ='<button id=btnCreate class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Create user</button> ';
$btns.='<button data-dismiss="modal" class="btn btn-default btn-sm"><i class="fas fa-times"></i> Cancel</button>';
$modal->footer($btns);

echo $modal;