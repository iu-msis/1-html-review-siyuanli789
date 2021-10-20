<?php

try {
    $_POST = json_decode(
        file_get_contents('php://input'),
        true,
        2,
        JSON_THROW_ON_ERROR
    );
} catch (Exception $e) {
    header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad Request");
    exit;
}

require("class/DbConnection.php");

$db = DbConnection::getConnection();

$stmt = $db->prepare(
    'INSERT INTO books (title, author, yearPublished, publisher, pageCount, msrp)
    VALUES (?, ?, ?, ?, ?, ?)'
);

$stmt->execute([
    $_POST['title'],
    $_POST['author'],
    $_POST['yearPublished'],
    $_POST['publisher'],
    $_POST['pageCount'],
    $_POST['msrp']
]);

// $pk = $db->lastInsertId();

header('HTTP/1.1 303 See Other');
header('Location: ../books/');