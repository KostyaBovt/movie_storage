<h4><small>FILTER</small></h4>
<form class="form-inline" role="form" method="POST" action="<?php echo ROOT_PATH . 'home/filter'?>">
  <div class="form-group">
    <label for="movie_name">Movie name</label>
    <input name="movie_name" type="text" class="form-control" id="movie_name" placeholder="Enter movie name...">
  </div>
  <div class="form-group">
    <label for="actor_name">Actor name</label>
    <input name="actor_name" type="text" class="form-control" id="actor_name" placeholder="Enter actor name...">
  </div>

  <button type="submit" class="btn btn-default">Filter</button>
</form>

<hr>
<h4><small>MOVIE LIST</small></h4>
<table class="table table-hover table-condensed">

  <thead>	
  	<tr>
		  <th>#</th>
		  <th>Name</th>
		  <th>Year</th>
		  <th>Format</th>
		  <th></th>
		  <th></th>
		</tr>
	</thead>
	<tbody>
	<?php
		$i = 1;
		if (count($view_data)) {
			foreach ($view_data as $movie_data) {
				echo '<tr>';
				echo '<td>' . $i . '</td>';
				echo '<td>' . $movie_data->name . '</td>';
				echo '<td>' . $movie_data->year . '</td>';
				echo '<td>' . $movie_data->format . '</td>';
				echo '<td><a href="';
				echo ROOT_PATH. 'movie/index/' . $movie_data->movie_id;
				echo '"><button type="button" class="btn btn-info">Information</button></a></td>';
				echo '<td><button id="';
				echo $movie_data->movie_id;
				echo '" type="button" class="btn btn-danger del-movie">Delete</button></td>';
				echo '</tr>';
				$i++;
			}
		} else {
				echo '<tr>';
				echo '<td>' . 'No films found' . '</td>';
				echo '</tr>';
		}
	?>	
	</tbody>

</table>