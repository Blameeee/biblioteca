<?php
session_start();
require_once './bootstrap.php';
$bookRepository = new BookRepository($databaseConnection);
$books = $bookRepository->readBooks();
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $books = $bookRepository->searchBooks($searchQuery);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $copies = $_POST['copies'];

    $bookRepository->createBook($title, $author, $year, $genre, $copies);
    $_SESSION['message'] = "Carte adăugată cu succes!";
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestionare Bibliotecă</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Adaugă Carte</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Titlu</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Autor</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Anul publicării</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Gen</label>
                <input type="text" class="form-control" id="genre" name="genre" required>
            </div>
            <div class="mb-3">
                <label for="copies" class="form-label">Numărul de exemplare disponibile</label>
                <input type="number" class="form-control" id="copies" name="copies" required>
            </div>
            <button type="submit" class="btn btn-primary">Adaugă</button>
        </form>
    </div>

    <div class="container mt-5">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>

        <h2 class="mb-4">Lista Cărților</h2>
        <form method="GET" action="">
            <input type="text" name="search" class="form-control" placeholder="Caută după titlu sau autor"
                aria-label="Caută după titlu sau autor">
            <div class="input-group-append mt-3 mb-3">
                <button class="btn btn-primary" type="submit">Caută</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titlu</th>
                    <th>Autor</th>
                    <th>Anul publicării</th>
                    <th>Gen</th>
                    <th>Exemplare disponibile</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['id']); ?></td>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['year']); ?></td>
                        <td><?php echo htmlspecialchars($book['genre']); ?></td>
                        <td <?php if ($book['copies'] == 0)
                            echo 'class="text-danger"'; ?>>
                            <?php echo htmlspecialchars($book['copies']); ?>
                        </td>
                        <td>
                            <a href="edit.php?id=<?php echo $book['id']; ?>" class="btn btn-warning btn-sm">Actualizează</a>
                            <a href="delete.php?id=<?php echo $book['id']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Ești sigur că vrei să ștergi această carte?');">Șterge</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>