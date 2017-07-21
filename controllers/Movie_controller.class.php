<?php
	class Movie_controller extends Controller {
		
		public function Index() {
			$movie_model = new Movie_model();
			if (!empty($this->_params[0])) {
				$view_data = $movie_model->getMovieInfo($this->_params[0]);
				$this->displayView(NULL, $view_data, 'views/movie_info.php');
			}
		}

		public function Delete() {
			if (!$_POST['id']) {
				echo '0';
				return;
			}
			
			$movie_model = new Movie_model();
			$movie_model->deleteMovie($_POST['id']);
			if ($movie_model->error()) {
				echo '0';
				return;
			}
			echo '1';
		}

		public function Add() {
			$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			if (isset($post['submit'])) {
				$validator = new Validator();
				$validator->check($post, array(
					'movie_name' => array(
						'required' => TRUE,
						'max' => 100, 
						'unique' => 'movies.name'
					),
					'movie_year' => array(
						'required' => TRUE,
						'min' => 1,
						'max' => 4,
						'filter' => 'FILTER_VALIDATE_INT'
					),				
					'movie_format' => array(
						'required' => TRUE
					),
					'movie_actors' => array(
						'required' => TRUE,
						'max' => 1500
					)
				));

				if (!$validator->passed()) {
					Message::put($validator->errors(), 'movie_add_fail');
					header('Location: ' . ROOT_PATH .'movie/add');
					die();
				}


				$movie_model = new Movie_model();
				if ($movie_model->addMovie($post)) {
					Message::put('Movie was added!', 'movie_add_success');
				} else {
					Message::put(array('Error adding movie'), 'movie_add_fail');
				}
				
				header('Location: ' . ROOT_PATH .'movie/add');
			} else {
				$this->displayView(NULL, NULL, 'views/movie_add.php');
			}
		}

		public function Upload() {

			if (isset($_POST['submit']) && $_FILES['upload_file']['name']) {
				$file_content = file_get_contents($_FILES['upload_file']['tmp_name']);
				if (!File::validate($file_content)) {
					Message::put('File is not valid', 'movie_upload_fail');
					header('Location: ' . ROOT_PATH .'movie/upload');
					die();
				}

				$movies = File::parse($file_content);

				$movie_model = new Movie_model();
				$errors_count = 0;
				$errors = array();
				foreach ($movies as $movie) {
					if (!$movie_model->addMovie($movie)) {
						$errors_count++;
						$errors[] = $movie;
					}
				}

				if ($errors_count) {
					Message::put('Movies: ' . count($movies) . '. Uploaded: ' . (count($movies) - $errors_count) . '. Errors: ' . $errors_count, 'movie_upload_warning');
					header('Location: ' . ROOT_PATH .'movie/upload');
					die();
				} else {
					Message::put('Movies uploaded!', 'movie_upload_success');
					header('Location: ' . ROOT_PATH .'movie/upload');
					die();
				}
			}


			$this->displayView(NULL, NULL, 'views/movie_upload.php');
		}
	}
?>