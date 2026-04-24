<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book Information</title>
</head>
<body>
    <div id="header">
        <h1>Book ID: <?= $_GET["id"] ?></h1>
    </div>

    <div id="body">
        <div id="editor">
            <form method="POST" action="<?= BASE_PATH ?>/book/update">
                <div>
                    <input type="int" name="id" value="<?= $_GET["id"] ?>" style="display: none;" />
                </div>
                <div>
                    <div>ISBN</div>
                    <input type="text" name="isbn-editor" placeholder="Enter new ISBN" value="<?= $book["isbn"] ?? "" ?>" />
                </div>

                <div>
                    <div>Title</div>
                    <input type="text" name="title-editor" placeholder="Enter new title" value="<?= $book["title"] ?? "" ?>" />
                </div>

                <div>
                    <div>Author</div>
                    <input type="text" name="author-editor" placeholder="Enter new author" value="<?= $book["author"] ?? "" ?>" />
                </div>

                <div>
                    <div>Public Year</div>
                    <input type="date" name="date-editor" value="<?= $book["public_year"] ?>" />
                </div>

                <div>
                    <div>Available Copies</div>
                    <input type="int" name="amountOfCopies-editor" placeholder="Enter new available copies" value="<?= $book["copies"] ?? 0 ?>" />
                </div>

                <div>
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div id="footer"></div>
</body>
</html>