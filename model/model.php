<?php

define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'blog_aymeric_arn');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $db = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST.';', DB_USER, DB_PASS);

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    die('Error :'.$e->getMessage());
}