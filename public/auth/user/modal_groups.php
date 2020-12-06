<?php
/**
 * Modal groups
 * @var LTE
 */
$A=new Djang\Auth($B);
$groups=$A->groups();//`auth_group`
//print_r($groups);


$htm='<table class="table table-sm table-hover" style="cursor:pointer">';
$htm.='<thead>';
$htm.='<th width=30>#</th>';
$htm.='<th>Name</th>';
$htm.='</thead>';
$htm.='<tbody>';
foreach($groups as $r){
	$htm.='<tr data-id="'.$r['id'].'">';
	$htm.='<td><i class="text-muted">'.$r['id'].'</i>';
	$htm.='<td>'.$r['name'];
}
$htm.='</tbody>';
$htm.='</table>';


$modal=new LTE\Modal;
$modal->id('modalGroups');
$modal->icon('fas fa-plus-circle');
$modal->title('Add group');
$modal->body($htm);

$btns ='';
$btns.='<button class="btn btn-default btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>';
$modal->footer($btns);
echo $modal;