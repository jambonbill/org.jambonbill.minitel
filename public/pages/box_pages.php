<?php
$box=new LTE\Card;
$box->id('boxPages');
$box->icon('far fa-folder-open');
$box->tools('<input type="text" class="form-control form-control-sm" placeholder="Search..." id="search" autocomplete="off">');


$box->body('<pre>no data</pre>');

$btns='';
$btns.='<a href=# class="btn btn-sm btn-primary" title="New script" id="btnNewScript"><i class="fas fa-plus-circle"></i> New script (F2)</a> ';
$btns.='<a href=# class="btn btn-sm btn-default pull-right" title="Reload"><i class="fas fa-refresh"></i></a> ';
//$box->footer($btns);
$box->p0(1);
$box->loading(1);
echo $box;