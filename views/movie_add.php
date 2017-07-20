<h4><small>ADD MOVIE</small></h4><hr>
<?php 
	if (Message::exists('movie_add_success')) {
		echo '<p class="bg-success text-success">'. Message::get('movie_add_success') . '</p><br>';
	}

	if (Message::exists('movie_add_fail')) {
		foreach (Message::get('movie_add_fail') as $error) {
			echo '<p class="bg-danger text-danger">'. $error . '</p><br>';
		}
	}
?>
<form class="" role="form" method="POST" action="<?php echo ROOT_PATH . 'movie/add'?>">
  
  <div class="form-group">
    <label for="movie_name">Movie name:</label>
    <input name="movie_name" type="text" class="form-control" id="movie_name" placeholder="Enter movie name...">
  </div>
  
  <div class="form-group">
    <label for="movie_year">Year:</label>
    <input name="movie_year" type="text" class="form-control" id="movie_year" placeholder="Enter year...">
  </div>

  <div class="form-group">
    <label for="movie_format">Format:</label>
    <select name="movie_format" class="form-control" id="movie_format">
	    <option>VHS</option>
	    <option>DVD</option>
	    <option>Blu-Ray</option>
    </select>
  </div>

  <div class="form-group">
    <label for="movie_actors">Actors:</label>
    <textarea name="movie_actors" type="textarea" class="form-control" id="movie_actors" placeholder="Enter actors separeted by comas..."></textarea>
  </div>

  <button name="submit" type="submit" class="btn btn-success" value="ok">Add movie</button>
</form>