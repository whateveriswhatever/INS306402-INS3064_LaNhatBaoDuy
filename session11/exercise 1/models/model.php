<?php
    require_once "../config/config.php";

    abstract class BaseModel {
        protected string $table;
        protected PDO $db;

        public function __construct(string $table_name): void {
            $this->db = Database::getInstance()->getConnection();
            $this->table = $table_name;
        }

        abstract public function validate($data): bool;

        public function all(): array {
            $stmt = ($this->db)->query("
                select
                    *
                from {$this->table}
            ");
            return $stmt->fetchAll();
        }

        public function find(array $conditions): array {
            if (empty($conditions)) {
                return [];
            }
            
            $columns = array_keys($conditions);

            $where = implode(" and ", array_map(function($col) {
                return "$col = :$col";
            }, $columns));

            $query = "select * from {$this->table} where $where";
            $stmt = ($this->db)->prepare($query);

            // bind values
            foreach ($conditions as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();
            return $stmt->fetchAll();
        }

        protected function getDBConnection(): PDO {
            return $this->db;
        }
    }
?>