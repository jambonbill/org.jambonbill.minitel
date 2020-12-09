<?php
// Modal Minitel script //

$htm ='<div class="row">';


$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label for="ps_name" class="control-label">Script</label>';
$htm.='<input type=text class="form-control form-control-sm" id="new_name" placeholder="Script name" autocomplete=off>';
$htm.='</div>';
$htm.='</div>';

$htm.='</div>';

$modal=new LTE\Modal;
$modal->id('modalScript');
$modal->title('Script #');
$modal->body($htm);

$btns='';
$btns.='<button class="btn btn-sm btn-primary" id="btnEdit"><i class="fa fa-plus-circle"></i> Edit</button> ';
$btns.='<button class="btn btn-sm btn-primary" id="btnDelete"><i class="fas fa-trash"></i> Delete</button> ';
$btns.='<button class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>';
$modal->footer($btns);
echo $modal;