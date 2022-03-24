<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $quote = new Quote($db);

  // Get raw posted data

  $quote->quote = isset($_GET['quote']) ? $_GET['quote'] : die();
  $quote->authorId = isset($_GET['authorId']) ? $_GET['authorId'] : die();
  $quote->categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : die();

  // Update post
  if($category->update()) {
    echo json_encode(
      array('message' => 'Quote Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Quote not updated')
    );
  }
