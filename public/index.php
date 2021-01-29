<?php
session_start();
$_SESSION['userId'] = 1;
ini_set('display_errors', 1);
require "../vendor/autoload.php";
\Core\Route::start();
