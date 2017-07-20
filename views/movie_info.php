<?php
?>
<h3>Movie info</h3>
<?php 
	if ($view_data) {
		echo '<table class="table">';
		echo '<tr>';
		echo '<th>ID</th>';
		echo '<td>' . $view_data['movie_info']->movie_id . '</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th>Name</th>';
		echo '<td>' . $view_data['movie_info']->name . '</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th>Year</th>';
		echo '<td>' . $view_data['movie_info']->year . '</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th>Format</th>';
		echo '<td>' . $view_data['movie_info']->format . '</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th>Actors</th>';
		echo '<td>';
		foreach ($view_data['movie_actors'] as $actor) {
			echo $actor->name . '<br/>';
		}
		echo '</td>';
		echo '</tr>';
		echo '</table>';
	}
?>