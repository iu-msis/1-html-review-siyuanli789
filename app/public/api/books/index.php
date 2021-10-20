<?php
// require 'common.php';
require 'class/DbConnection.php';

// Step 1: Get a datase connection from our helper class
$db = DbConnection::getConnection();

// Step 2: Create & run the query
$sql = 'SELECT * FROM books';
$vars = [];

// if (isset($_GET['bookid'])) {
//   $sql = 'SELECT * FROM books WHERE bookid = ?';
//   $vars = [$_GET['bookid']];
// }

$stmt = $db->prepare($sql);
$stmt->execute($vars);

$books = $stmt->fetchAll();

// Step 3: Convert to JSON
$json = json_encode($books, JSON_PRETTY_PRINT);

// Step 4: Output
header('Content-Type: application/json'); //can't change http header ifalready started printing 
echo $json;
