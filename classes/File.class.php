<?php
	class File {

		static function parse($content) {
			$get_key = array(
				'Title' => 'movie_name',
				'Release Year' => 'movie_year',
				'Format' => 'movie_format',
				'Stars' => 'movie_actors'

			);
			$content = explode("\n", $content);
			$movies = array();
			$i = 0;

			foreach ($content as $line) {
				if ($line == '') {
					$i++;
				} else {
					$line_array = array_map('trim', explode(':', $line, 2));
					$movies[$i][$get_key[$line_array[0]]] = $line_array[1];
				}
			}

			return $movies;
		}

		static function validate($content) {
			$content = explode("\n", $content);
			$films = array();
			$i = 0;
			foreach ($content as $line) {
			
				if (!File::validateLine($line)) {
					return FALSE;
				}

				if ($line != '') {
					$line_key = array_map('trim', explode(':', $line, 2))[0];
					$films[$i][] = $line_key;
				} else {
					$i++;
				}
			}

			if (!File::validateKeys($films)) {
				return FALSE;
			}

			return TRUE;
		}

		static function validateKeys($films) {
			$keys = array('Title', 'Release Year', 'Format', 'Stars');
			sort($keys);		
			foreach ($films as $film) {
				sort($film);
				if ($film != $keys) {
					return FALSE;
				}
			}
			return TRUE;
		}

		static function validateLine($line) {
			if ($line == '') {
				return TRUE;
			}
			
			$line = array_map('trim', explode(':', $line, 2));
			
			if (count($line) != 2) {
				return FALSE;
			}

			$keys = array('Title', 'Release Year', 'Format', 'Stars');
			if (!in_array($line[0], $keys)) {
				return FALSE;
			}

			if ($line[0] == 'Title') {
				if (strlen($line[1]) > 100 || strlen($line[1]) < 1) {
					return FALSE;
				}
			}

			if ($line[0] == 'Release Year') {
				if (strlen($line[1]) > 4 || strlen($line[1]) < 1) {
					return FALSE;
				}

				if (!ctype_digit($line[1])) {
					return FALSE;
				}
			}

			if ($line[0] == 'Format') {
				$formats = array('VHS', 'DVD', 'Blu-Ray');
				if (!in_array($line[1], $formats)) {
					return FALSE;
				}
			}

			if ($line[0] == 'Stars') {
				if (strlen($line[1]) > 1500 || strlen($line[1]) < 1) {
					return FALSE;
				}
			}

			return TRUE;
		}
	}
?>