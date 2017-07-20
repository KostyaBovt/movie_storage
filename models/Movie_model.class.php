<?php
	class Movie_model extends Model {

		public function getMovieInfo($movie_id) {
			$this->query(	'SELECT *, movies.id AS movie_id 
							FROM movies 
							INNER JOIN formats 
							ON movies.format_id = formats.id
							WHERE movies.id = ?', array($movie_id));
			
			if ($this->error() || !$this->count()) {
				return FALSE;
			}

			$return['movie_info'] = $this->results()[0];

			$this->query(	'SELECT * 
							FROM movies_actors 
							INNER JOIN actors 
							ON movies_actors.actor_id = actors.id
							WHERE movies_actors.movie_id = ?', array($movie_id));

			$return['movie_actors'] = $this->results();
			return $return;
		}

		public function deleteMovie($movie_id) {
			$this->query(	'DELETE 
							FROM movies 
							WHERE id = ?', array($movie_id));
		}

		public function addMovie($post) {

			$this->query('SELECT * FROM movies WHERE name = ?', array($post['movie_name']));
			if ($this->error() || $this->count()) {
				return FALSE;
			}

			$this->query(	'SELECT * 
							FROM formats 
							WHERE formats.format = ?', array($post['movie_format']));
			
			if ($this->error() || !$this->count()) {
				return FALSE;
			}
			$format_id = $this->results()[0]->id;

			$this->insert('movies', array(
				'id' => NULL, 
				'name' => $post['movie_name'],
				'year' => $post['movie_year'],
				'format_id' => $format_id
			));

			if ($this->error() || !$this->count()) {
				return FALSE;
			}

			$movie_id = $this->lastInsertId2();

			$actors = array_map('trim', explode(',', $post['movie_actors']));
			foreach ($actors as $actor) {
				if (!$this->addActor($actor)) {
					return FALSE;
				}
			}

			if (!$actors_id = $this->getActorsId($actors)) {
				return FALSE;
			}

			if (!$this->addMovieActors($movie_id, $actors_id)) {
				return FALSE;
			}

			return TRUE;


		}

		protected function addMovieActors($movie_id, $actors_id) {
			foreach ($actors_id as $actor_id) {
				$actor_id = $actor_id->id;
				$this->insert('movies_actors', array(
					'id' => NULL,
					'movie_id' => $movie_id,
					'actor_id' => $actor_id
				));

				if ($this->error() || !$this->count()) {
					return FALSE;
				}
			}
			return TRUE;
		}

		protected function getActorsId($actors) {
			$where = '(';
			$i = 0;
			foreach ($actors as $actor) {
				if ($i) {
					$where .= ' OR '; 
				}
				$where .= 'name = ?';
				$i++;
			}
			$where .= ')';

			$this->query('SELECT * FROM actors WHERE ' . $where, $actors);
			if ($this->error()) {
				return FALSE;
			}

			return $this->results();

		}

		protected function addActor($actor) {
			$this->query('SELECT * from actors WHERE name = ?', array($actor));
			if ($this->error()) {
				return FALSE;
			}

			if ($this->count()) {
				return TRUE;
			}

			$this->insert('actors', array(
				'id' => NULL,
				'name' => $actor
			));

			if ($this->error() || !$this->count()) {
				return FALSE;
			}

			return TRUE;
		}
	}
?>