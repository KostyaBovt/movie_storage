<?php
	class Home_controller extends Controller {
		public function Index() {
			$movie_list_model = new Movie_list_model();
			$view_data = $movie_list_model->getMovieList();
			$this->displayView(NULL, $view_data, 'views/movie_list.php');
		}

		public function Filter() {
			$movie_list_model = new Movie_list_model();
			$post  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$view_data = $movie_list_model->getMovieListFiltered(filter_var_array($this->_params_get, FILTER_SANITIZE_STRING));
			$this->displayView(NULL, $view_data, 'views/movie_list.php');
		}

		public function Install() {
			require_once 'install.php';
		}

	}

?>