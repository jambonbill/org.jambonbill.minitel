<?php
/**
 * Box search
 */

$htm='';

/*
$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>Search</label>';
$htm.='<input type="text" class="form-control form-control-sm mr-sm-2" placeholder="Search script" id="search" autocomplete="off">';
$htm.='</div>';
$htm.='</div>';
*/

$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
//$htm.='<label>Lib</label>';
$htm.='<select class="form-control form-control-sm fmr-sm-2" id="libs" size=20>';
$htm.='<option value="">All libraries</option>';
$htm.='</select>';
$htm.='</div>';
$htm.='</div>';


/*
$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>Owner</label>';
$htm.='<select class="form-control form-control-sm mr-sm-2" id="owners">';
$htm.='<option value="">Every owners</option>';
foreach($P->usernames() as $k=>$username){
	//print_r($r);
	$htm.='<option value="'.$k.'">'.$username.'</option>';
}
$htm.='</select>';
$htm.='</div>';
$htm.='</div>';
*/


$box=new LTE\Card;
$box->id('boxSearch');
$box->icon('fas fa-search');
//$box->title($htm);
$box->body($htm);

$btns='';
//$btns.='<a href=# class="btn btn-sm btn-primary" title="New script" id="btnNewScript"><i class="fa fa-plus-circle"></i> New script (F2)</a> ';
//$btns.='<a href=# class="btn btn-sm btn-default pull-right" title="Reload"><i class="fa fa-refresh"></i></a> ';
//$box->footer($btns);
$box->loading(1);
echo $box;

// Only my stuff //
$htm='<div class="form-check">';
$htm.='<input class="form-check-input" type="checkbox" id="justme" value="'.$B->userid().'">';
$htm.='<label class="form-check-label" for="justme">';
$htm.='Only my stuff';
$htm.='</label>';
$htm.='</div>';
echo $htm;