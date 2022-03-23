<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog author object
  $author = new Author($db);

  // Get ID
  $author->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $author->read_single();

  // Create array
  if(isset($author->name)){
    $author_arr = array(
      'id' => $author->id,
      'author' => $author->name
    );
  }
  else{
    $author_arr = array('message' => 'authorId Not Found');
  }
  

  // Make JSON
  print_r(json_encode($author_arr));
