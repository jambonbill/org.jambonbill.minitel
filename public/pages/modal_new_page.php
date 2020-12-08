<?php
// Modal NEW page //

$htm='<form id=fnew>';
$htm.='<div class="row">';

/*
$htm.='<div class="col-6">';
$htm.='<div class="form-group">';
$htm.='<label for="ps_name" class="control-label">Lib</label>';
$htm.='<input type=text class="form-control form-control-sm" id="new_lib" placeholder="Library" autocomplete=off>';
$htm.='</div>';
$htm.='</div>';
*/

$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label for="ps_name" class="control-label">Page name</label>';
$htm.='<input type=text class="form-control form-control-sm" id="new_name" placeholder="Script name" autocomplete=off>';
$htm.='</div>';
$htm.='</div>';

$htm.='</div>';
$htm.='</form>';

$modal=new LTE\Modal;
$modal->id('modalNewPage');
$modal->title('New page');
$modal->body($htm);

$btns='';
$btns.='<button class="btn btn-sm btn-primary" id="btnCreate"><i class="fa fa-plus-circle"></i> Create page</button> ';
$btns.='<button class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>';
$modal->footer($btns);
echo $modal;