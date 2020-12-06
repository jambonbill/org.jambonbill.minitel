<?php
/**
 * Modal user-agents
 * @var LTE
 */

$modal=new LTE\Modal;
$modal->size('lg');
$modal->id('modalAgents');
$modal->icon('fas fa-desktop');
$modal->title('User agents');
$modal->body('please wait');

$btns ='';
$btns.='<button class="btn btn-default btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>';
$modal->footer($btns);
echo $modal;