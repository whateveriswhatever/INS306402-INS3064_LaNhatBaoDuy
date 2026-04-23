<?php
    require_once "../config/config.php";

    abstract class BaseModel {
        protected string $table;
        protected PDO $dbConnection;

        public function __construct(string $table_name) {
            $this->dbConnection = Database::getInstance()->getConnection();
            $this->table = $table_name;
        }

        abstract public function validate($data): bool;

        public function all(): array {
            try {
                $query = "
                    select
                        *
                    from
                    {$this->table}
                ";
                $stmt = ($this->dbConnection)->prepare($query);
                $stmt->execute();
                $data = $stmt->fetchAll();
                return $data;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw $e;
            }
        }

        public function allID(): array {
            try {
                $query = "
                    select
                        id 
                    from {$this->table}
                ";
                $stmt = ($this->dbConnection)->prepare($query);
                $stmt->execute();
                $ids = $stmt->fetchAll();
                return $ids;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw $e;
            }
        }

        public function find($conditions): array {
            /* If an exception is thrown, the function doesn't return at all => The return type array only applies when the function successfully returns */
            if (count($conditions) == 0) {throw new InvalidArgumentException("Conditions can not be empty!");}
            try {
                $keys = array_keys($conditions);
                $vals = array_values($conditions);
                $where = implode(" and ", array_map(function ($key) {
                    return "{$key} = :{$key}";
                }, $keys));
                $query = "
                    select
                        *
                    from {$this->table}
                    where {$where}
                ";
                $params = [];
                for ($i = 0; $i < count($keys); $i++) {
                    $params[":{$keys[$i]}"] = $vals[$i];
                }
                $stmt = ($this->dbConnection)->prepare($query);
                $stmt->execute($params);
                $data = $stmt->fetchAll();
                return $data;
            } catch (PDOException $e) {
                // Log it, don't show the error
                error_log($e->getMessage());
                throw $e; // rethrow for upper layer
            }
            
        }

        public function delete($conditions): bool {
            if (empty($conditions)) throw new InvalidArgumentException("The conditions can't be hollow!");
            try {
                $keys = array_keys($conditions);
                $vals = array_values($conditions);
                $where = implode(" and ", array_map(function ($key) {
                    return "$key = :$key";
                }, $keys));
                $query = "
                    delete from {$this->table}
                    where {$where}
                ";
                $params = [];
                for ($i = 0; $i < count($keys); $i++) {
                    $params[":$keys[$i]"] = $vals[$i];
                }
                $stmt = ($this->dbConnection)->prepare($query);
                $isSuccess = $stmt->execute($params);
                if ($isSuccess) {echo "<div>Erased product successfully</div>"; return true;}
                else {echo "<div>Failed to erase product!</div>"; return false;}
            } catch (PDOException $e) {
                error_log($e->getMessage());
                throw $e;
            }

        }

        public function getTableName(): string {
            return $this->table;
        }

        protected function getDBConnection(): PDO {
            return $this->dbConnection;
        }
    }
?>