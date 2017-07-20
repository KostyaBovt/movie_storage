# movie_storage
Web application for storing films info. Functions: add, delete film, search by name or actor, show info, upload films info from file.

### Installation of application

1. Clone this repository on your localhost in folder 'movie_storage'
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

#### Pages
0. Sidebar
   * Find    - redirect to Home page : localhost/movie_storage/home/index
   * Add     - redirect to Add movie page : localhost/movie_storage/movie/add
   * Upload  - redirect to Upload movies form file page : localhost/movie_storage/movie/upload
1. Home page
   * Display all films in alphabetical order
   * You can filter films by film name **OR/AND** actor name through filter form and button **'Filter'**
   * You can view information about film through button **'Information'**
   * You can delete film through button **'Delete'**
2. Add movie
   * Form to add movie to DB manually
   * All fields required
   * Show error if invalid fields values filled or film already exists 
3. Upload movie
   * Upload movies to DB from strictly formatted .txt file
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
   * Creates and keeps PDO in properies, conect to DB on construct, keeps last query executed results in properties.
   * Have basic methods to manipiulate DB
4. Home_controller
   * Display Home page content (home/index and home/filter)
   * Uses to install DB (home/install)
5. Movie_controller
   * Display and process  Movie Information page (movie/index)
   * Display and process  Add movie page (movie/add)
   * Display and process  Upload movie page (movie/upload)
   * Process Delete movie (movie/delete)
6. Movie_list_model
   * Return movies data from DB to be displayed through Home_controller
7. Movie_model
   * Return movie data form DB to be displayed through Movie_controller
   * Uses to add or delete Movie from DB
8. Separate classes
   * Session: uses to put, get, delete data from SESSION variable
   * Message: uses to put, get(and delete) messages from SESSION variable
   * File: uses to maipulate file content (validate)
   * Validator: uses to validate array to meet requirements - used in form validation



