<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog quote object
  $quote = new Quote($db);

  // Get ID
  $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $quote->read_single();

  // Create array
  if(isset($quote->name)){
    $quote_arr = array(
      'id' => $quote->id,
      'quote' => $quote->quote,
      'authorId' => $quote->authorId,
      'categoryId' => $quote->categoryId
    );
  }
  else{
    $quote_arr = array('message' => 'Quote Not Found');
  }
  

  // Make JSON
  print_r(json_encode($quote_arr));
