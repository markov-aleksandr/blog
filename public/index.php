<?php
session_start();
//var_dump($_SESSION['id']);
ini_set('display_errors', 1);
require "../vendor/autoload.php";
\Core\Route::start();
