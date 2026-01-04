<?php
require_once "BaseRepository.php";
class PatientRepository extends BaseModel{
    protected string $table = 'patients';


    public function deletePatient($id){
        return $this->delete($this->table,$id);
    }

  
    public function insertPatient(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
    
            $data_patient = [
        'gender' => $_POST['gender'] ?? null,
        'date_of_birth' => $_POST['date_of_birth'] ?? null,
        'adress' => $_POST['adress'] ?? null
    ];

    $columns = "";
    $placeholders = "";

    foreach ($data_patient as $key => $val) {
        $columns .= "$key, ";
        $placeholders .= "?, ";
    }

    $columns = rtrim($columns, ", ");
    $placeholders = rtrim($placeholders, ", ");

    return $this->insert($this->table, $columns, $placeholders, array_values($data_patient));
        }
    }


    public function getNumber(){
        $sql = "SELECT  * FROM $this->table";

        $stm = $this->db->query($sql);
        return $stm->fetchColumn();

    }

    public function GetValuePatients($id){
        return $this->getValue($id,$this->table);
    }
    public function updatePatient($columns,$values,$id){
        return $this->update($columns,$values,$this->table,$id);
    }
}

// $test =new PatientRepository();
// print_r($test->getValue(12,'hh'));

