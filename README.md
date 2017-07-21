# movie_storage
Web application for storing films info. Functions: add, delete film, search by name or actor, show info, upload films info from file.

### Installation of application on build-in PHP server

1. ```git clone https://github.com/KostyaBovt/movie_storage.git```
2. ```cd movie_storage```
3. ```php -S localhost:8000```
4. configure DB_USER, DB_PASSWORD in config/database.php 
5. open in browser http://localhost:8000/home/install to install db
6. installation is finished



### Installation of application on apache server

1. Clone this repository to your localhost in folder 'movie_storage'
2. Configure files
    * config/database.php
      * configure DB_USER and DB_PASSWORD
      * configure HOST_NAME : if needs
      * configure ROOT_PATH : is not required if folder of app named 'movie_storage' and is placed in root localhost
    * assets/js/config.js
      * if folder of app named 'movie_storage' and is placed in root localhost - configure is not required'
3. Run localhost/movie_storage/home/install to install DB
4. Installation is finished

### Architecture of application

#### General
1. OOP style
2. MVC pattern implemented
3. Also using separate classes in classes/
4. Routing to index.php through .htaccess
5. Routing structure: localhost/movie_storage/**controller/method/id1/id2**
6. JS/AJAX used to delete movie from DB (Home page)

#### Pages
0. Sidebar
   * Find    - redirect to Home page : localhost/movie_storage/home/index
   * Add     - redirect to Add movie page : localhost/movie_storage/movie/add
   * Upload  - redirect to Upload movies form file page : localhost/movie_storage/movie/upload
1. Home page
   * Displays all films in alphabetical order
   * You can filter films by film name **OR/AND** actor name through filter form and button **'Filter'**
   * You can view information about film through button **'Information'**
   * You can delete film through button **'Delete'**
2. Add movie
   * Form for adding movie to DB manually
   * All fields required
   * Shows error if invalid fields values filled or film already exists 
3. Upload movie
   * Uploads movies to DB from strictly formatted .txt file
   * Error if invalid file
   * Warnings if some films was not added (already exists in DB): shows number of films added, errors and total films.

#### Classes
1. Bootstrap
   * Index.php create Bootstrap object (with controller and action as properties)
   * Bootstrap object creates controller and executes action
2. Controller
   * Parent class for all controllers in application
3. Model
   * Parent class for all models in application
   * Creates and keeps PDO in properties, connect to DB on construct, keeps last query executed results in properties.
   * Has basic methods to manipulate DB
4. Home_controller
   * Displays Home page content (home/index and home/filter)
   * Uses to install DB (home/install)
5. Movie_controller
   * Displays and process  Movie Information page (movie/index)
   * Displays and process  Add movie page (movie/add)
   * Displays and process  Upload movie page (movie/upload)
   * Process Delete movie (movie/delete)
6. Movie_list_model
   * Return movies data from DB to be displayed through Home_controller
7. Movie_model
   * Return movie data form DB to be displayed through Movie_controller
   * Uses to add or delete Movie from DB
8. Separate classes
   * Session: uses to put, get, delete data from SESSION variable
   * Message: uses to put, get(and delete) messages from SESSION variable
   * File: uses to manipulate file content (validate)
   * Validator: uses to validate array to meet requirements - used in form validation



