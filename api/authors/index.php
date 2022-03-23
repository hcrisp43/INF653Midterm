<?php 
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	$method = $_SERVER['REQUEST_METHOD'];
	if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
	}

	
	if($method === 'GET')
	{
		if(empty($_SERVER['QUERY_STRING'])){
			require 'read.php';
		}
		else{
			require 'read_single.php';
		}
	}

	else if($method === 'POST')
	{
		require 'create.php';
	}

	else if($method === 'PUT')
	{
		require 'update.php';
	}

	else if($method === 'DELETE')
	{
		require 'delete.php';
	}

	else
	{
		echo json_encode(array('message' => 'Cannot use this method'));
	}


	