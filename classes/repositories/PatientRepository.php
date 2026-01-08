<?php
require_once "BaseRepository.php";
class PatientRepository extends BaseModel
{
    protected string $table = 'patients';


    public function deletePatient($id)
    {
        return $this->delete($this->table, $id);
    }


    public function insertPatient($data)
    {
        $sql = "INSERT INTO $this->table (id,gender,date_of_birth,adress)  VALUES (?,?,?,?)";
        $stm = $this->db->prepare($sql);
        $stm->execute([$data->getId(),$data->getGender(), $data->getDateOfBirthday(), $data->getAddress()]);
    }


    public function getNumber()
    {
        $sql = "SELECT  * FROM $this->table";

        $stm = $this->db->query($sql);
        return $stm->fetchColumn();

    }

    public function GetValuePatients($id)
    {
        return $this->getValue($id, $this->table);
    }
    public function updatePatient($columns, $values, $id)
    {
        return $this->update($columns, $values, $this->table, $id);
    }



}

// $test =new PatientRepository();
// print_r($test->getValue(12,'hh'));

