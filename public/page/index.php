<?php
// A minitel Videotex page
session_start();
header('Content-Type: text/html; charset=utf-8');

require __DIR__."/../../vendor/autoload.php";

$B=new Djang\Base;


$admin = new LTE\Admin();
$admin->title("Minitel");
echo $admin->head();
?>
  <body>
    <div id="miedit">
      <x-minitel data-speed="1200" data-color="true">
        <canvas class="minitel-screen" id=screen data-minitel="screen"></canvas>
      </x-minitel>
    </div>

    <script src="js/minitel.min.js"></script>
    <script src="js/page.js"></script>

</body>

<style type="text/css">
body {
    margin: 0;
    padding: 0;
    background-color: #202020;
}

canvas {
    image-rendering: crisp-edges;
    image-rendering: pixelated;
    image-rendering: -moz-crisp-edges;
    position: fixed;
    top: 0;
    bottom: 0;
    margin: auto;
    overflow: auto;
}

@media (min-aspect-ratio: 320/250) {
    canvas { width: auto; height: 100%; }
}

@media (max-aspect-ratio: 320/250) {
    canvas { width: 100%; height: auto; }
}
</style>
</html>