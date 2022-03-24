<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $category = new Category($db);

  // Get raw posted data
  $data = isset($_GET['category']) ? $_GET['category'] : die();

  $category->name = $data->category;

  // Create Author
  if($category->create()) {
    echo json_encode(
      array('message' => 'Author Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Author Not Created')
    );
  }
