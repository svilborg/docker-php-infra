<?php
try {
    $dbh = new pdo('mysql:host=backend:3306;dbname=test', 'admin', 'admin', array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
    die(json_encode(array(
        'outcome' => true
    )));
} catch (PDOException $ex) {
    die(json_encode(array(
        'outcome' => false,
        'message' => 'Unable to connect',
        'error' => $ex->getMessage()
    )));
}
