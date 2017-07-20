<?php
	class Movie_list_model extends Model {

		public function getMovieList() {
			$this->query(	'SELECT *, movies.id AS movie_id 
							FROM movies 
							INNER JOIN formats 
							ON movies.format_id = formats.id
							ORDER BY movies.name ASC');
			if ($this->_error) {
				return FALSE;
			} else {
				return $this->_results;
			}
		}

		public function getMovieListFiltered($filter_array) {
			$params = array("%" . strtoupper(trim($filter_array['movie_name'])) . "%");

			if ($filter_array['actor_name']) {

				$params[] = "%" . strtoupper($filter_array['actor_name']) . "%";
				$this->query(	'SELECT movies.*, movies.id as movie_id, formats.format
								FROM movies 
								INNER JOIN formats 
								ON movies.format_id = formats.id 
								INNER JOIN movies_actors
								ON movies_actors.movie_id = movies.id
								INNER JOIN actors
								ON movies_actors.actor_id = actors.id
								WHERE (UPPER(movies.name) LIKE ? 
								AND UPPER(actors.name) like ?) 
								GROUP BY movie_id', $params);
			} else {
				$this->query(	'SELECT movies.*, movies.id as movie_id, formats.format
								FROM movies 
								INNER JOIN formats 
								ON movies.format_id = formats.id 
								WHERE UPPER(movies.name) LIKE ? 
								GROUP BY movie_id', $params);
			}
			return $this->results();
		}

	}
?>