<?php
/**
 * Box filter
 * @var string
 */

$htm='<div class="row">';

/*
$htm.='<div class="col-md-12">';
$htm.='<div class="form-group">';
$htm.='<label>Search</label>';
$htm.='<input type="text" class="form-control form-control-sm" placeholder="Search" id=search autocomplete=off>';
$htm.='</div>';
$htm.='</div>';
*/

$htm.='<div class="col-6 col-md-12">';
$htm.='<div class="form-group">';
$htm.='<label>Role</label>';
$htm.='<select class="form-control form-control-sm" id=role>';
$htm.='<option>Every role';
$htm.='<option value=staff>Staff';
$htm.='</select>';
$htm.='</div>';
$htm.='</div>';


// STATUS //
$htm.='<div class="col-6 col-md-12">';
$htm.='<div class="form-group">';
$htm.='<label>Status</label>';
$htm.='<select class="form-control form-control-sm" id=status>';
$htm.='<option>Every status';
$htm.='<option value=active>Active';
$htm.='<option value=inactive>Inactive';
$htm.='</select>';
$htm.='</div>';
$htm.='</div>';

/*
$htm.='<div class="col-md-12">';
$htm.='<div class="form-group">';
$htm.='<label>Group</label>';
$A=new Djang\Auth($B);
$groups=$A->groups();
$htm.='<select class="form-control form-control-sm" id=group>';
$htm.='<option>Every groups';
foreach($groups as $r){
	$htm.='<option value="'.$r['id'].'">'.$r['name'];
}
$htm.='</select>';
$htm.='</div>';
$htm.='</div>';
*/

$htm.='</div>';


$box=new LTE\Card;
$box->id('boxFilter');
//$box->title('Filter');
$box->icon('fa fa-search');
$box->body($htm);
//$box->small('small text');
//$box->footer('<button id=btnNewUser class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> New user</button>');
$box->collapsable(true);
$box->loading(1);
echo $box;