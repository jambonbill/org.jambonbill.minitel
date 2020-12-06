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
echo $admin;//
//print_r($usr);
?>
<div class="content-wrapper">

	<section class="container">
	  <h3>Minitel Pages
		<button class="btn btn-sm btn-primary" title="New script" id="btnNewScript"><i class="fa fa-plus-circle"></i> New (F2)</button>
	  </h3>
	</setion>

	<section class="container">

	<div class="row">
		<div class="col-md-3">
		<?php
		require "box_search.php";
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

<script type="text/javascript" src="js/pages.js"></script>

<?php
//require "modal_script.php";
//require "modal_rename.php";//rename script
//require "modal_new_script.php";
//$P->end();
$admin->end();