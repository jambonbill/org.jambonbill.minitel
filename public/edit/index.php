<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

require __DIR__."/../../vendor/autoload.php";

$B=new Djang\Base;

if (!$B->userId()) {
    header('location: /auth/login');
    exit(json_encode(['error'=>'please log in']));
}


$admin = new LTE\Admin;
$admin->title("Edit");
$admin->addJs("js/minitel-editor.js");
$admin->addJs("/dist/miniscript/miniscript.js");

//<!-- ace editor -->
$admin->addJs("ace/ace.js");
$admin->addJs("ace/ext-language_tools.js");
$admin->addJs("ace/theme-twilight.js");
$admin->addJs("ace/mode-javascript.js");
$admin->addJs("ace/mode-javascript.js");


$admin->addCss("css/minitel-editor.css");
echo $admin->head();//

if (isset($_GET['id'])) {
  echo '<input type=hidden id=script_id value="'.$_GET['id'].'">';
}
require "navbar.html";
?>

  <div id="editor"></div>

  <div id="miedit">
    <x-minitel data-speed="1200" data-color="true">
      <canvas class="minitel-screen" id=screen data-minitel="screen"></canvas>
      <audio class="minitel-beep" data-minitel="beep">
        <source src="sound/minitel-bip.mp3" type="audio/mpeg"/>
        Too bad, your browser does not support HTML5 audio or mp3 format.
      </audio>
    </x-minitel>
  </div>

<?php
$admin->end();