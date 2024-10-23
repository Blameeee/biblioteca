<?php
require_once "./app/DatabaseConnectionInterface.php";
require_once "./app/BookRepositoryInterface.php";
require_once "./app/DatabaseConnection.php";
require_once "./app/BookRepository.php";

[$dsn, $username, $password] = require_once './config.php';
$databaseConnection = new DatabaseConnection($dsn, $username, $password);
