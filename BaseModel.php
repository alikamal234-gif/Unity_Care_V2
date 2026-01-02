<?php
require_once "Database.php";



abstract class BaseModel
{
    protected PDO $conn;
    protected string $table;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
        $this->table = $this->getTableName();
    }

    abstract protected function getTableName(): string;
    abstract protected function fromArray($arr): object;
    abstract protected function toArray(): array;


    // ---------- CRUD ----------------
    public function getAll(): array
    {
        $qry = "SELECT * FROM $this->table";

        $stmt = $this->conn->prepare($qry);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arr = [];
        foreach ($result as $key => $value) {
            $arr[] = $this->fromArray($value);
            
        }
        return $arr;
    }

    public function getById($id)
    {

        $qry = "SELECT * FROM $this->table WHERE id=$id";

        $stmt = $this->conn->prepare($qry);
        $stmt->execute();

        $result = $stmt->fetchAll();
        print_r($result);
    }

    public function getBy($column, $value)
    {

        $qry = "SELECT * FROM $this->table WHERE $column = $value";

        $stmt = $this->conn->prepare($qry);
        $stmt->execute();

        $result = $stmt->fetchAll();
        print_r($result);
    }

    public function insert($data)
    {
        $keys = array_keys($data);

        $columns = implode(", ", $keys);
        $values = implode(", ", array_fill(0, count($data), "?"));

        $qry = "INSERT INTO $this->table ($columns) values($values)";

        $stmt = $this->conn->prepare($qry);
        $stmt->execute(array_values($data));
    }
}
