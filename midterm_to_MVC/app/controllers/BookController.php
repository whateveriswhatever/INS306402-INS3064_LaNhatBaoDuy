<?php
    require_once "BaseController.php";
    require_once ROOT_DIR . "/models/book.php";

    class BookController extends BaseController {
        protected BookModel $bookModel;

        public function __construct() {
            $this->bookModel = new BookModel("controller");
        }

        public function index(): void {
            $books = ($this->bookModel)->all();
            echo "<div>Receiving all books from server</div>";
            $this->view("books/all", ["books" => $books]);
            // $this->redirect(BASE_PATH . "/books");
        }

        public function create($old_data = []): void {
            $this->view("books/create", $old_data);
        }

        public function edit(int $optionalID = 0): void {
            $id = null;
            if ($optionalID !== 0) {
                $id = $optionalID;
            } else {
                $id = $_GET["id"];
            }
            
            if ($id < 1) return;
            echo "<div>Current book ID: {$id}</div>";
            $currBook = ($this->bookModel)->find([
                "id" => $id
            ]);
            // $cols = array_keys($currBook);
            // $vals = array_values($currBook);
            // $check = gettype($currBook);
            // echo "<div>{$check}</div>";
            // foreach ($cols as $col) {
            //     echo "<div>{$col}</div>";
            // }
            // foreach ($vals as $val) {
            //     echo "<div>{$val}</div>";
            // }
            // $subCols = array_keys($currBook[0]);
            // foreach ($subCols as $col) {
            //     echo "<div>{$col}</div>";
            // }
            $this->view("books/edit", ["book" => $currBook[0]]);
        }

        public function update(): bool {
            /*
                Don't call $this->index() after POST 
                Always redirect after successful POST
                This follows proper MVC + PRG pattern 
            */
            $bookID = (int)$_POST["id"];
            $new_isbn = $_POST["isbn-editor"];
            $new_title = $_POST["title-editor"];
            $new_author = $_POST["author-editor"];
            $new_publicYear = $_POST["date-editor"];
            $new_avail_copies = (int)$_POST["amountOfCopies-editor"];

            echo "<div>{$new_publicYear} ?></div>";    // 1997-06-26  
            echo "<div>{$new_title}</div>";
            echo "<div>{$new_author}</div>";
            echo "<div>{$new_isbn}</div>";

            $new_data = [
                "id" => $bookID,
                "isbn" => $new_isbn,
                "title" => $new_title,
                "author" => $new_author,
                "public_year" => $new_publicYear,
                "copies" => $new_avail_copies
            ];
            $isValidated = ($this->bookModel)->validate($new_data);
            if (!$isValidated) {echo "<div>New data is invalid for update!</div>";$this->redirect(BASE_PATH . "/book/update?id={$bookID}");return false;}
            try {
                $isSuccess = ($this->bookModel)->update($new_data);
                if (!$isSuccess) {
                    // echo "<div>Failed to update book ID: {$bookID}!</div>";
                    $this->edit();
                    return false;
                }
                // echo "<div>Updated book ID: {$bookID}</div>";
                $this->redirect(BASE_PATH . "/books");
                return true;
            } catch (Throwable $e) {
                http_response_code(500);
                $this->view("errors/500", ["error" => $e]);
                throw $e;
            }
        }

        public function deleteViaID(): bool {
            $bookID = (int)$_GET["id"];
            if ($bookID < 1) return false;
            try {
                $isSuccess = ($this->bookModel)->delete(["id" => $bookID]);
                if (!$isSuccess) {
                    echo "<div>Failed to delete book ID: {$bookID}!</div>";
                    return false;
                }
                echo "<div>Deleted book ID: {$bookID}!</div>";
                $this->redirect(BASE_PATH . "/books");
                return true;
            } catch (Throwable $e) {
                http_response_code(505);
                $this->view("errors/505", ["error" => $e]);
                throw $e;
            }
        }

        public function store(): bool {
            $data = [
                "isbn" => $_POST["isbn-editor"],
                "title" => $_POST["title-editor"],
                "author" => $_POST["author-editor"],
                "public_year" => $_POST["date-editor"],
                "copies" => $_POST["amountOfCopies-editor"]
            ];
            $isValidated = ($this->bookModel)->validate($data);
            if (!$isValidated) {$this->create($data);return false;}
            try {
                $isSuccess = ($this->bookModel)->add($data);
                if (!$isSuccess) {
                    $this->redirect(BASE_PATH, "/book/create.php");
                }
                $this->redirect(BASE_PATH . "/books");
                return true;
            } catch (Throwable $e) {
                http_response_code(505);
                $this->view("errors/505", ["error" => $e]);
                throw $e;
            }
        }
    }
?>