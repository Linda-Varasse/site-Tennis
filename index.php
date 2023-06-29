<?php

use App\Router;
// Autoloading On
require __DIR__ . '/vendor/autoload.php';
// Init Session
if (session_status() === PHP_SESSION_NONE) session_start();

// Test si l'utilisateur a demandé une page
Router::handleRequest();
