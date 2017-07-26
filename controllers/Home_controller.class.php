<?php
	class Home_controller extends Controller {
		public function Index() {
			$movie_list_model = new Movie_list_model();
			$view_data = $movie_list_model->getMovieList();
			$this->displayView(NULL, $view_data, 'views/movie_list.php');
		}

		public function Filter() {
			$movie_list_model = new Movie_list_model();
			$view_data = $movie_list_model->getMovieListFiltered($this->_params_get);
			$this->displayView(NULL, $view_data, 'views/movie_list.php');
		}

		public function Install() {
			require_once 'install.php';
		}

	}

?>