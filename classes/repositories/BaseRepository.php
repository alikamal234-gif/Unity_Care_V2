<?php
require_once __DIR__ . "../../Database.php";

class BaseModel
{
    public PDO $db;
    protected string $table;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

    }

    // crud starting 
    public function getAll($table)
    {
        $sql = "SELECT * FROM $table";
        $stm = $this->db->query($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete($table, $id)
    {
        $sql = "DELETE FROM `$table` WHERE id=:id";
        echo $sql;
        $stm = $this->db->prepare($sql);
        $stm->bindParam('id', $id);
        $stm->execute();
    }




    public function getUserValue($table)
    {
        $sql = "SELECT * FROM $table p  JOIN users u ON p.id = u.id ";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }


    public function getValue($id, $table)
    {
        $sql = "SELECT * FROM $table p  JOIN users u ON p.id = u.id WHERE p.id= ?";
        $stm = $this->db->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetch();

        return $result;
    }



    

    

}

