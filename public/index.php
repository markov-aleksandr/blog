<?php
session_start();
//var_dump($_SESSION['id']);
$_SESSION['id'] = 1;
ini_set('display_errors', 1);
require "../vendor/autoload.php";
require "../routes.php";
//\Core\Route::start();
