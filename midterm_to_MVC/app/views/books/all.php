<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="header">
        <h1>Library</h1>
    </div>

    <div id="body">
        <div>
            <a href="<?= BASE_PATH ?>/book/create">Add a new book?</a>
        </div>
        <div id="table">
            <table border="1">
                <thead>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Public Year</th>
                    <th>Available Copies</th>
                </thead>

                <tbody>
                    <?php if (!empty($books)): ?>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?= $book["isbn"] ?></td>
                                <td><?= $book["title"] ?></td>
                                <td><?= $book["author"] ?></td>
                                <td><?= $book["public_year"] ?></td>
                                <td><?= $book["copies"] ?></td>
                                <td>
                                    <a href="<?= BASE_PATH ?>/book/edit?id=<?= $book["id"] ?>">Edit</a>
                                </td>
                                <td>
                                    <a href="<?= BASE_PATH ?>/book/delete?id=<?= $book["id"] ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No book found!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>