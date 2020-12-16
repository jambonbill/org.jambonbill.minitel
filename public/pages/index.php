<?php
// MINITEL :: HOME
session_start();
header('Content-Type: text/html; charset=utf-8');

require __DIR__."/../../vendor/autoload.php";

$B=new Djang\Base;
//$P=new PET\Pen($B);

if (!$B->userId()) {
    header('location: /auth/login');
    exit(json_encode(['error'=>'please log in']));
}

//$USR=$B->user();

$admin = new LTE\Admin();
$admin->addJs("js/pages.js");
echo $admin;//
//print_r($usr);
?>
<div class="content-wrapper">

	<section class="container">
	  <h3>Minitel Pages
		<button class="btn btn-sm btn-primary" title="New" id="btnNew"><i class="fa fa-plus-circle"></i> New (F2)</button>
	  </h3>
	</setion>

	<section class="container">

	<div class="row">
		<div class="col-md-3">
		<?php
		//require "box_search.php";
		?>
		</div>

		<div class="col-md-9">
		<?php
		require "box_pages.php";
		?>
		</div>
	</div>

	</section>
</div>

<?php
require "modal_page.php";
require "modal_new_page.php";
$admin->end();