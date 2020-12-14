<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

require __DIR__."/../../vendor/autoload.php";

$B=new Djang\Base;

if (!$B->userId()) {
    header('location: /auth/login');
    exit(json_encode(['error'=>'please log in']));
}


$admin = new LTE\Admin();
echo $admin->head();//
echo '<link href="css/minitel-editor.css" rel="stylesheet" type="text/css" />';

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

  <script src="/js/minitel.min.js"></script>

  <!-- ace editor -->
  <script type="text/javascript" src="ace/ace.js" charset="utf-8"></script>
  <script type="text/javascript" src="ace/ext-language_tools.js"></script>
  <script type="text/javascript" src="ace/theme-twilight.js" charset="utf-8"></script>
  <script type="text/javascript" src="ace/mode-javascript.js"  charset="utf-8"></script>


  <script src="js/minitel-editor.js"></script>

