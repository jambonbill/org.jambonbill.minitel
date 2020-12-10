<?php
// Modal Minitel Page //

$htm ='<div class="row">';

$htm.='<input type=hidden id=page_id>';

$htm.='<div class="col-12">';
$htm.='<div class="form-group">';

$htm.='<x-minitel data-speed="1200" data-color="true">';
  $htm.='<canvas class="minitel-screen" id=screen data-minitel="screen" style="width:640px"></canvas>';
$htm.='</x-minitel>';

$htm.='</div>';
$htm.='</div>';



$htm.='</div>';
$htm.='</form>';

$modal=new LTE\Modal;
$modal->id('modalPage');
$modal->title('Minitel page');
$modal->body($htm);

$btns='';
$btns.='<button class="btn btn-sm btn-danger" id="btnDelete"><i class="fas fa-trash"></i> Delete</button> ';
$btns.='<button class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>';
$modal->footer($btns);
echo $modal;