<?php
	require_once 'config/database.php';
	
	$sql = file_get_contents('movie_storage.sql');
	
	$db = new PDO('mysql:host=' . HOST_NAME . ';charset=utf8;', DB_USER, DB_PASSWORD);
	try {
	    $db->exec($sql);
	}
	catch (PDOException $e)
	{
	    echo $e->getMessage();
	    die();
	}
	header('Location: ' . ROOT_PATH . 'home/index');
?>