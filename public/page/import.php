<?php
// A minitel Videotex page
session_start();
header('Content-Type: text/html; charset=utf-8');

require __DIR__."/../../vendor/autoload.php";

$B=new Djang\Base;

$Page=new Minitel\Page($B);

$files=glob("vdt/*.vdt");
foreach($files as $file){
    $Page->import($file);
}

echo "ok;";