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
    'UPDATE books SET
        title = ?,
        author = ?,
        yearPublished = ?,
        publisher = ?,
        pageCount = ?,
        msrp = ?
        WHERE id = ?'
);

$stmt->execute([
    $_POST['title'],
    $_POST['author'],
    $_POST['yearPublished'],
    $_POST['publisher'],
    $_POST['pageCount'],
    $_POST['msrp'],
    $_POST['id']
]);

// $pk = $db->lastInsertId();

header('HTTP/1.1 303 See Other');
header('Location: ../books/?books=');

