<?php
    require_once root_dir . "/config/database-config.php";

    abstract class BaseRepository {
        protected string $tableName;
        protected PDO $dbConnection;

        public function __construct(string $table_name) {
            $this->dbConnection = (DatabaseConfig::getInstance()->getConnection());
            $this->tableName = $table_name;
        }

        public function all(): array {
            try {
                $query = "select * from {$this->tableName}";
                $stmt = ($this->dbConnection)->prepare($query);
                $stmt->execute([]);
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            } catch (PDOException $ex) {
                error_log($ex->getMessage());
                throw $ex;
            }
        }

        public function add(array $data): bool {
            try {
                $cols = array_keys($data);
                $vals = array_values($data);
                $insertedCols = implode(" , ", array_map(function ($col) {return "{$col}";}, $cols));
                $bindParams = implode(" , ", array_map(function ($col) {return ":{$col}";}, $cols));
                $query = "
                    insert into {$this->tableName} ({$insertedCols})
                    values ({$bindParams})
                ";
                $params = [];
                for ($i = 0; $i < count($cols); $i++) {
                    $params[":{$cols[$i]}"] = $vals[$i];
                }
                $stmt = ($this->dbConnection)->prepare($query);
                $isSuccess = $stmt->execute($params);
                return $isSuccess;
            } catch (PDOException $ex) {
                error_log($ex->getMessage());
                throw $ex;
            }
        } 

        public function findViaCreteria(array $criteria): array {
            try {
                $keys = array_keys($criteria);
                $vals = array_values($criteria);
                $where = implode(" and ", array_map(function ($key) {return "{$key} = :{$key}";}, $keys));
                $params = [];
                for ($i = 0; $i < count($keys); $i++) {
                    $params[":{$keys[$i]}"] = $vals[$i]; 
                }
                $query = "
                    select
                        * 
                    from {$this->tableName}
                    where {$where}";
                $stmt = ($this->dbConnection)->prepare($query);
                $stmt->execute($params);
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            } catch (PDOException $ex) {
                error_log($ex->getMessage());
                throw $ex;
            }
        }

        public function deleteViaCreteria(array $criteria): bool {
            try {
                $keys = array_keys($criteria);
                $vals = array_values($criteria);
                $where = implode(" and ", array_map(function ($key) {return "{$key} = :{$key}";}, $keys));
                $query = "
                    delete from {$this->tableName}
                    where {$where}
                ";
                $stmt = ($this->dbConnection)->prepare($query);
                $params = [];
                for ($i = 0; $i < count($keys); $i++) {
                    $params[":{$keys[$i]}"] = $vals[$i];
                }
                $isSuccess = $stmt->execute($params);
                if ($isSuccess) {echo "<div>Deleted product successfully</div>";return true;}
                echo "<div>Failed to erase product!</div>";
                return false;

            } catch (PDOException $ex) {
                error_log($ex->getMessage());
                throw $ex;
            }
        }

        public function updateViaCriteria(array $updatedData, array $critera): bool {
            try {
                $newDataKeys = array_keys($updatedData);
                $newDataVals = array_values($updatedData);
                $keys = array_keys($critera);
                $vals = array_keys($critera);
                $where = implode(" and ", array_map(function ($key) {return "{$key} = :{$key}";}, $keys));
                $setStmt = implode(" , ", array_map(function ($key) {return "{$key} = :{$key}";}, $newDataKeys));
                $query = "
                    update {$this->tableName}
                    set {$setStmt}
                    where {$where}";
                $params = [];
                for ($i = 0; $i < count($keys); $i++) {
                    $params[":{$keys[$i]}"] = $vals[$i];
                }
                for ($j = 0; $j < count($newDataKeys); $j++) {
                    $params[":{$newDataKeys[$j]}"] = $newDataVals[$j];
                }
                $stmt = ($this->dbConnection)->prepare($query);
                $isSuccess = $stmt->execute($params);
                if (!$isSuccess) {
                    return false;
                }
                return true;
            } catch (PDOException $ex) {
                error_log($ex->getMessage());
                throw $ex;
            }
        }

        public function getTableName(): string {
            return $this->tableName;
        }

        public function setTableName(string $name): void {
            $this->tableName = $name;
        }
    }
?>