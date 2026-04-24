<?php
    require_once ROOT_DIR . "/config/database-config.php";

    abstract class BaseModel {
        protected string $tableName;
        protected PDO $dbConnection;

        public function __construct(string $table_name) {
            $this->dbConnection = (Database::getInstance())->getConnection();
            $this->tableName = $table_name;
        }

        public function all(): array {
            try {
                $query = "select * from {$this->tableName}";
                $stmt = ($this->dbConnection)->prepare($query);
                $stmt->execute();
                $data = $stmt->fetchAll();
                echo "<div>Receiving all rows from table!</div>";
                return $data;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw $e;
            }
        }
        
        public function find($conditions): array {
            /*
                [
                    "where" => [
                        "name" = "Harry Potter",
                        "author" = "J. K. Rowling"
                    ],
                    "limit" => [1]
                ]
             */
            try {
                $keys = array_keys($conditions);
                $vals = array_values($conditions);
                $where = implode(" and ", array_map(function ($key) {
                    return "$key = :$key";
                }, $keys));
                $params = [];
                for ($i = 0; $i < count($keys); $i++) {
                    echo "<div>:{$keys[$i]} -> $vals[$i]</div>";
                    $params[":$keys[$i]"] = $vals[$i];
                }
                $query = "
                    select
                        *
                    from {$this->tableName}
                    where {$where}
                ";
                echo "<div>{$query}</div>";
                $stmt = ($this->dbConnection)->prepare($query);
                $isSuccess = $stmt->execute($params);
                if ($isSuccess) {
                    echo "<div>Found a matched data row!</div>";
                } else {
                    echo "<div>Failed to find matched data row!</div>";
                }
                $data = $stmt->fetchAll();
                return $data;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw $e;
            }
        }

        public function delete(array $conditions): bool {
            try {
                $keys = array_keys($conditions);
                $vals = array_values($conditions);
                $where = implode(" and ", array_map(function ($key) {return "{$key} = :{$key}";}, $keys));
                $query = "delete from {$this->tableName}
                        where {$where}";
                $stmt = ($this->dbConnection)->prepare($query);
                $params = [];
                for ($i = 0; $i < count($keys); $i++) {
                    $params[":{$keys[$i]}"] = $vals[$i];
                }
                $isSuccess = $stmt->execute($params);
                if ($isSuccess) {echo "<div>Deleted product successfully</div>";return true;}
                echo "<div>Failed to erase product!</div>";
                return false;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw $e;
            }
        }

        public function getTableName(): string {
            return $this->tableName;
        }

        public function setTableName($tbName): void {
            $this->tableName = $tbName;
        }
    }
?>