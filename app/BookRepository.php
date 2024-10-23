<?php

class BookRepository implements BookRepositoryInterface
{
    private $pdo;

    public function __construct(DatabaseConnectionInterface $databaseConnection)
    {
        $this->pdo = $databaseConnection->connect();
    }

    // Creare carte
    public function createBook($title, $author, $year, $genre, $copies)
    {
        $sql = 'INSERT INTO books (title, author, year, genre, copies) VALUES (:title, :author, :year, :genre, :copies)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':title' => $title, ':author' => $author, ':year' => $year, ':genre' => $genre, ':copies' => $copies]);
        $_SESSION['message'] = "Cartea a fost adăugată cu succes!";
    }

    // Citire toate cărțile
    public function readBooks()
    {
        $sql = 'SELECT * FROM books';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Citire carte după ID
    public function getById($id)
    {
        $sql = 'SELECT * FROM books WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizare carte
    public function updateBook($id, $title, $author, $year, $genre, $copies)
    {
        $sql = 'UPDATE books SET title = :title, author = :author, year = :year, genre = :genre, copies = :copies WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':title' => $title, ':author' => $author, ':year' => $year, ':genre' => $genre, ':copies' => $copies, ':id' => $id]);
        $_SESSION['message'] = "Cartea a fost actualizată cu succes!";
    }

    // Ștergere carte
    public function deleteBook($id)
    {
        $sql = 'DELETE FROM books WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $_SESSION['message'] = "Cartea a fost ștearsă cu succes!";
    }
    public function searchBooks($query)
    {
        $sql = 'SELECT * FROM books WHERE title LIKE :query OR author LIKE :query';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':query' => '%' . $query . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
