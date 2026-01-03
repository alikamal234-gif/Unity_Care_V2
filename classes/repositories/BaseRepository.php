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
    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
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

    public function insert($tableau, $column, $preparValue, $data)
    {

        $sql = "INSERT INTO $tableau ($column) Values ($preparValue)";
        $stm = $this->db->prepare($sql);
        $stm->execute($data);
        if (in_array('patient',$data)) {
            $data_patient = [
                'gender' => $_POST['gender'] ?? null,
                'date_of_birth' => $_POST['date_of_birth'] ?? null,
                'adress' => $_POST['adress'] ?? null,
            ];
            $columnsP = "";
            $placeholders = "";
            $value = "";
            foreach ($data_patient as $key => $val) {
                $columnsP .= "$key, ";
                $placeholders .= "?, ";
                $value .= "$val, ";
            }

            $columnsP = rtrim($columnsP, ", ");
            $placeholders = rtrim($placeholders, ", ");

            $userId = $this->db->lastInsertId();
            
            $sql = "INSERT INTO patients (id,$columnsP) Values ($userId,$placeholders)";
            $stm = $this->db->prepare($sql);
            $stm->execute(array_values($data_patient));
        }else if (in_array('doctor',$data)) {
            $data_doctor = [
                'spicialization' => $_POST['spicialization'] ?? null,
                'department_id' => $_POST['department_id'] ?? null
            ];
            $columnsD = "";
            $placeholders = "";

            foreach ($data_doctor as $key => $val) {
                $columnsD .= "$key, ";
                $placeholders .= "?, ";
            }

            $columnsD = rtrim($columnsD, ", ");
            $placeholders = rtrim($placeholders, ", ");

            $userId = $this->db->lastInsertId();
            
            $sql = "INSERT INTO doctors (id,$columnsD) Values ($userId,$placeholders)";
            $stm = $this->db->prepare($sql);
            $stm->execute(array_values($data_doctor));
        }

        
        
    }
    
    public function insertAll($columns,$values,$data){

        $sql = "INSERT INTO departments ($columns) VALUES ($values)";
        $stm= $this->db->prepare($sql);
        $stm->execute(array_values($data));

    }






}

