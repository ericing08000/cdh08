<?php
session_start();
$_session = array();

session_destroy();

$url = $_GET['url'];
header("location:http://$url")
?>
