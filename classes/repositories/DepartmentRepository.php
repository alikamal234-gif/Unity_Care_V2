<?php
require_once "BaseRepository.php";
class DepartmentRepository extends BaseModel{
    protected string $table = 'departments';

    
    public function insertDepartment(){
        $data = [
            "name" => $_POST['name'],
            "location" => $_POST['location']
        ];

        $columns = "";
        $values = "";

        foreach ($data as $key => $value) {
            $columns .= "$key, ";
            $values .= "?, ";
        }

        $values = rtrim($values, ", ");
        $columns = rtrim($columns, ", ");

        return $this->insertAll($columns,$values,$data);

        }

        public function getNumber(){
        $sql = "SELECT  * FROM $this->table";

        $stm = $this->db->query($sql);
        return $stm->fetchColumn();

    }
}