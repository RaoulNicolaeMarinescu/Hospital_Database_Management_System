<?php
session_start();

$conn = pg_connect("host=localhost port=5432 dbname=ospedale user=postgres password=unimi");

if (!$conn) {
    echo "Connection failed";
    exit;
}
?>