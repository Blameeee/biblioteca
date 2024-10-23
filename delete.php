<?php
require_once './bootstrap.php';
$bookRepository = new BookRepository($databaseConnection);
$books = $bookRepository->readBooks();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $bookRepository->deleteBook($id);
    header('Location: index.php');
    exit;
}
