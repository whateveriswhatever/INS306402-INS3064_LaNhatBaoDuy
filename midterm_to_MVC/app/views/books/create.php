<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new book</title>
</head>
<body>
    <div id="header">
        <h1>Add</h1>
    </div>

    <div id="body">
        <div id="editor">
            <form method="POST" action="<?= BASE_PATH ?>/book/create">
                <div>
                    <div>ISBN</div>
                    <input type="text" name="isbn-editor" placeholder="Enter book ISBN" />
                </div>

                <div>
                    <div>Title</div>
                    <input type="text" name="title-editor" placeholder="Enter book title" />
                </div>

                <div>
                    <div>Author</div>
                    <input type="text" name="author-editor" placeholder="Enter book author" />
                </div>

                <div>
                    <div>Public Year</div>
                    <input type="date" name="date-editor" />
                </div>

                <div>
                    <div>Available Copies</div>
                    <input type="int" name="amountOfCopies-editor" placeholder="Enter available copies of the book" />
                </div>

                <div>
                    <button type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>

    <div id="footer"></div>
</body>
</html>