<?php
require_once './bootstrap.php';
$bookRepository = new BookRepository($databaseConnection);

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $book = $bookRepository->getById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];
        $genre = $_POST['genre'];
        $copies = $_POST['copies'];

        $bookRepository->updateBook($id, $title, $author, $year, $genre, $copies);
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Actualizează Carte</title>
</head>

<body>
<div class="container mt-5">
    <h2>Actualizează Carte</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Titlu</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Autor</label>
            <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Anul publicării</label>
            <input type="number" class="form-control" id="year" name="year" value="<?php echo htmlspecialchars($book['year']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Gen</label>
            <input type="text" class="form-control" id="genre" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="copies" class="form-label">Numărul de exemplare disponibile</label>
            <input type="number" class="form-control" id="copies" name="copies" value="<?php echo htmlspecialchars($book['copies']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizează</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
