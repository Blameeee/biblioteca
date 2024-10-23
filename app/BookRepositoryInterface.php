<?php
interface BookRepositoryInterface
{
    public function createBook($title, $author, $year, $genre, $copies);
    public function readBooks();
    public function getById($id);
    public function updateBook($id, $title, $author, $year, $genre, $copies);
    public function deleteBook($id);
}
