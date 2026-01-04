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

    public function insert($tableau, $column, $preparValue, $data)
    {

        $sql = "INSERT INTO $tableau ($column) Values ($preparValue)";
        $stm = $this->db->prepare($sql);
        $stm->execute($data);
        if (in_array('patient', $data)) {
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
        } else if (in_array('doctor', $data)) {
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

    public function insertAll($columns, $values, $data, $table)
    {

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stm = $this->db->prepare($sql);
        $stm->execute(array_values($data));

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

    public function getAllValue($table)
    {
        $sql = "SELECT * FROM $table";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetch();

        return $result;
    }

    public function update($columns, $values, $table, $id)
    {
        $sql = "UPDATE $table SET $columns = ? WHERE id = ?";
        $stm = $this->db->prepare($sql);
        $stm->execute([$values, $id]);
    }


    public function getAllWithDoctors($table, $id)
    {
        $sql = "SELECT 
    p.id            AS appointment_id,
    p.date,
    p.time,
    p.reason,
    p.status,

    pat.id          AS patient_id,
    pat.gender,
    pat.date_of_birth,
    pat.adress,

    d.id            AS doctor_id,
    d.spicialization,

    u.first_name    AS doctor_first_name,
    u.last_name     AS doctor_last_name

FROM appointments p
JOIN patients pat ON p.patient_id = pat.id
JOIN doctors d    ON p.doctor_id = d.id
JOIN users u      ON u.id = d.id
WHERE p.patient_id = :id
";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(":id", $id);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    

}

