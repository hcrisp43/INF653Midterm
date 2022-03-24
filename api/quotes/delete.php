<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';
  // Instantiate DB & connect
  $Quote = new Database();
  $db = $Quote->connect();

  // Instantiate blog post object
  $quote = new Quote($db);

  // Get raw posted data
  $data = isset($_GET['id']) ? $_GET['id'] : die();

  // Set ID to UPDATE
  $quote->id = $data->id;

  // Delete post
  if($quote->delete()) {
    echo json_encode(
      array('message' => 'Quote deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Quote not deleted')
    );
  }
