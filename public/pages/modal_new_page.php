<?php
// Modal NEW page //

$htm='<form id=fnew>';
$htm.='<div class="row">';



$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
//$htm.='<label for="new_name" class="control-label">Page name</label>';
$htm.='<input type=text class="form-control form-control-sm" id="new_name" placeholder="Page name" autocomplete=off>';
$htm.='</div>';
$htm.='</div>';


$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label for="new_data" class="control-label">Data</label>';
$htm.='<textarea class="form-control form-control-sm" id="new_data" placeholder="b64" autocomplete=off rows=8></textarea>';
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