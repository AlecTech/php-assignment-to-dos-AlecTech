<?php

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';
//convert JSON to PHP array using decode
$json = file_get_contents('todo.json');
$jsonArray = json_decode($json, true);
//get one task and invert status of that todo item inside array
$todoName = $_POST['task'];
$jsonArray[$todoName]['done'] =  !$jsonArray[$todoName]['done'];
//when we change status of task then convert it back to JSON and redirect us back to main TODO page
file_put_contents('todo.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
header('Location: todo.php');