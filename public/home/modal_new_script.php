<?php
// Modal NEW script //

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
$htm.='<label for="new_name" class="control-label">Script</label>';
$htm.='<input type=text class="form-control form-control-sm" id="new_name" placeholder="Script name" autocomplete=off>';
$htm.='</div>';
$htm.='</div>';

$htm.='</div>';
$htm.='</form>';

$modal=new LTE\Modal;
$modal->id('modalNewScript');
$modal->title('New script');
$modal->body($htm);

$btns='';
$btns.='<button class="btn btn-sm btn-primary" id="btnCreateNewScript"><i class="fa fa-plus-circle"></i> Create script</button> ';
$btns.='<button class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>';
$modal->footer($btns);
echo $modal;