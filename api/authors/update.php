<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $author = new Author($db);

  // Get raw posted data

  // Set ID to UPDATE
  $author->id = isset($_GET['id']) ? $_GET['id'] : die();

  $author->name = isset($_GET['author']) ? $_GET['author'] : die();

  // Update post
  if($category->update()) {
    echo json_encode(
      array('message' => 'Author Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Author not updated')
    );
  }
