<?php
    require_once ROOT_DIR . "/models/base.php";
    class BookModel extends BaseModel {
        public string $bookName;

        public function __construct(string $book_name) {
            $this->bookName = $book_name;
            parent::__construct("books");
            
        }

        private function extractSymbol($str, $symbol): string {
            $storage = str_split($str);
            $chars = array_values($storage);
            $withoutSymbol = "";
            foreach ($chars as $char) {
                if ($char !== $symbol) $withoutSymbol .= $char;
            }
            return $withoutSymbol;
        }

        private function replaceSymbolWith($str, $symbol, $replaced_symbol): string {
            $storage = str_split($str);
            $chars = array_values($storage);
            $withoutSymbol = "";
            foreach ($chars as $char) {
                if ($char !== $symbol) {$withoutSymbol .= $char;}
                else {$withoutSymbol .= " ";}
            }
            return $withoutSymbol;
        }

        private function filterStringField($str, $symbols = []): string {
            if (count($symbols) === 0) {return $str;}
            foreach ($symbols as $symbol) {
                $str = $this->extractSymbol($str, $symbol);
            }
            return $str;
        }

        private function isContainSpecialChars(string $str): bool {
            // \p{L}: Khớp với bất kỳ chữ cái nào từ bất kỳ ngôn ngữ nào (có dấu hoặc không)
            // \p{N}: Khớp với bất kỳ con số nào
            // \s: Khớp với khoảng trắng (dấu cách, tab, xuống dòng)
            // Modifier /u: Bắt buộc phải có để PHP hiểu chuỗi theo chuẩn UTF-8
            if (preg_match("/[^\p{L}\p{N}\s]/u", $str)) return true;
            return false;
        }

        public function validate(array $data): bool {
            if (empty($data)) return false;
            try {
                $isbn = $data["isbn"];
                $title = $data["title"];
                $author = $data["author"];
                $public_year = $data["public_year"];
                $avail_copies = $data["copies"];
                $check = gettype($public_year);
                echo "<div>Type of public year: {$check}</div>";
                // $public_year = new DateTime($public_year)->format("Y-m-d H:i:s");
                echo "<div>{$public_year}</div>";

                // extract hyphen symbol from ISBN code for size comparision
                $title = $this->filterStringField($title, ["'", "-", "_"]);
                $isbn = $this->filterStringField($isbn, ["-"]);
                $author = $this->filterStringField($author, ["_", "'"]);
                if ($this->isContainSpecialChars($title) || $this->isContainSpecialChars($author)) {echo "<div>Title and author must not contain special character</div>";return false;}
                if (strlen($title) < 3 || strlen($author) < 3) {echo "<div>Maximum length for title and author must be more than 3 characters</div>";return false;}
                if (strlen($isbn) !== 10 && new DateTime($public_year) < new DateTime("2007-01-01")) {echo "<div>The length of ISBN must be 10 before 2007-01-01</div>";return false;}
                if (strlen($isbn) !== 13 && new DateTime($public_year) >= new DateTime("2007-01-01")) {echo "<div>The length of ISBN must be 13 after 2007-01-01</div>";return false;}
                if ($avail_copies < 0) {echo "<div>Available copies must be positive integer</div>";return false;}

                return true;
                
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw $e;
            }
        }

        public function update(array $new_data): bool {
            $isValidated = $this->validate($new_data);
            if (!$isValidated) return false;
            try {
                /*
                    ["id" => 2]
                 */
                $currId = $new_data["id"];
                unset($new_data["id"]);
                if ($currId < 1) return false;
                $tableName = parent::getTableName();
                $keys = array_keys($new_data);
                $vals = array_values($new_data);

                for ($i = 0; $i < count($vals); $i++) {
                    $vals[$i] = $this->replaceSymbolWith($vals[$i], "_", " ");
                }
                
                $bindingCols = implode(" , ", array_map(function ($key) {return "{$key} = :{$key}";}, $keys));

                $query = "update {$tableName}
                        set {$bindingCols}
                        where id = :id";
                echo "<div>Update query: {$query}</div>";
                $params = [];
                for ($i = 0; $i < count($keys); $i++) {
                    $params[":{$keys[$i]}"] = $vals[$i];
                }
                $params[":id"] = $currId;
                $stmt = ($this->dbConnection)->prepare($query);
                $isSuccess = $stmt->execute($params);
                if ($isSuccess) {
                    echo "<div>Updated book ID: {$currId}</div>";
                    return true;
                } else {
                    echo "<div>Failed to update book ID: {$currId}</div>";
                    return false;
                }

            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw $e;
            }
        }

        public function add(array $data): bool {
            /* insert into tableName (keys) values (?, ?, ?, ?) */
            $isValidated = $this->validate($data);
            if (!$isValidated) return false;
            try {
                $keys = array_keys($data);
                $vals = array_values($data);
                // removing all underscore symbol from the values
                for ($i = 0; $i < count($vals); $i++) {
                    $vals[$i] = $this->replaceSymbolWith($vals[$i], '_', ' ');
                }
                $insertedCols = implode(" , ", array_map(function($key) {return "{$key}";}, $keys));
                $bindingCols = implode(" , ", array_map(function($key) {return ":{$key}";}, $keys));
                $query = "insert into {$this->tableName} ($insertedCols)
                        values ($bindingCols)";
                $params = [];
                for ($i = 0; $i < count($keys); $i++) {
                    $params[":{$keys[$i]}"] = $vals[$i];
                }
                $stmt = ($this->dbConnection)->prepare($query);
                $isSuccess = $stmt->execute($params);
                if ($isSuccess) {
                    echo "<div>Added a new book!</div>";
                    return true;
                } else {
                    echo "<div>Failed to add a new book!</div>";
                    return false;
                }
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw $e;
            }
        }

        
    }
?>