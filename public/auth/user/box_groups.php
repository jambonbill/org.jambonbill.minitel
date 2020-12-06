<?php
//user group

$box=new LTE\Card;
$box->id("boxGroups");
$box->title("Auth group(s)");
$box->icon("fas fa-users-cog");
$box->small('<a href="/auth/groups"><i class="fas fa-angle-double-right"></i></a>');

$btn='<button id=btnAddGroup class="btn btn-sm btn-default" title="Add group"><i class="fa fa-plus-circle"></i></button>';
$box->tools($btn);

$box->body("<pre>please wait</pre>");
$box->p0(1);

echo $box;