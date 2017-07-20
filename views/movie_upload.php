<h4><small>UPLOAD MOVIES FROM FILE</small></h4><hr>
<?php 
	if (Message::exists('movie_upload_fail')) {
		echo '<p class="bg-danger text-danger">'. Message::get('movie_upload_fail') . '</p><br>';
	}

	if (Message::exists('movie_upload_warning')) {
		echo '<p class="bg-warning text-warning">'. Message::get('movie_upload_warning') . '</p><br>';
	}

	if (Message::exists('movie_upload_success')) {
		echo '<p class="bg-success text-success">'. Message::get('movie_upload_success') . '</p><br>';
	}

?>

<form enctype="multipart/form-data" class="" role="form" method="POST" action="<?php echo ROOT_PATH . 'movie/upload'?>">
  
    <div class="form-group">
      <label for="exampleInputFile">File input</label>
      <input name="upload_file" type="file" id="exampleInputFile">
    </div>

  <button name="submit" type="submit" class="btn btn-success" value="ok">Upload</button>
</form>