<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $quote = new Quote($db);

  $quote->quote = isset($_GET['quote']) ? $_GET['quote'] : die();
  $quote->authorId = isset($_GET['authorId']) ? $_GET['authorId'] : die();
  $quote->categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : die();

  // Create Quote
  if($quote->create()) {
    echo json_encode(
      array('message' => 'Quote Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Quote Not Created')
    );
  }
