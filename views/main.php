<?php 
	$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
	$action = isset($_GET['action'])? $_GET['action'] : 'index';
	$active_pages = array(
		'find' => ($controller == 'home') ? TRUE : FALSE, 
		'add' => ($controller == 'movie' && $action == 'add') ? TRUE : FALSE, 
		'upload' => ($controller == 'movie' && $action == 'upload') ? TRUE : FALSE 
	);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie Storage</title>

    <!-- Bootstrap -->
    <link href="<?php echo ROOT_PATH; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ROOT_PATH; ?>assets/css/index.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo ROOT_PATH; ?>assets/js/jquery-3.2.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo ROOT_PATH; ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo ROOT_PATH; ?>assets/js/config.js"></script>
    <script src="<?php echo ROOT_PATH; ?>assets/js/index.js"></script>


  </head>
  <body>
	<div class="container-fluid">
	  <div class="row content">
	    
	    <div class="col-sm-3 sidenav">
	      <h4>MOVIE STORAGE</h4>
	      <ul class="nav nav-pills nav-stacked">
	        <li <?php if ($active_pages['find']) {echo 'class="active"';}?>>
	        	<a href="<?php echo ROOT_PATH; ?>home/index">Find</a>
	        </li>
	        <li <?php if ($active_pages['add']) {echo 'class="active"';}?>>
	        	<a href="<?php echo ROOT_PATH; ?>movie/add">Add</a>
	        </li>
	        <li <?php if ($active_pages['upload']) {echo 'class="active"';}?>>
	        	<a href="<?php echo ROOT_PATH; ?>movie/upload">Upload</a>
	        </li>
	      </ul>
	      <br>
	     
	    </div>

	    <div class="col-sm-9">
	      <?php require_once $view_file;?>


	    </div>

	  </div>
	</div>

  </body>
</html>