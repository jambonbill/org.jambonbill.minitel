<?php
// Modal Minitel script

$htm ='<div class="row">';

$htm.='<input type=hidden id=script_id>';

$htm.='<div class="col-12">';
$htm.='<x-minitel data-speed="1200" data-color="true">';
  $htm.='<canvas class="minitel-screen" id=screen data-minitel="screen"></canvas>';
$htm.='</x-minitel>';
$htm.='</div>';

$htm.='</div>';

$modal=new LTE\Modal;
$modal->id('modalScript');
$modal->title('Script #');
$modal->body($htm);

$btns='';
$btns.='<button class="btn btn-sm btn-primary" id="btnEdit">Edit</button> ';
$btns.='<button class="btn btn-sm btn-danger" id="btnDelete"><i class="fas fa-trash"></i> Delete</button> ';
$btns.='<button class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>';
$modal->footer($btns);
echo $modal;