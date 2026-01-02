<?php
require_once "BaseRepository.php";
class PatientRepository extends BaseModel{
    protected string $table = 'patients';


    public function deletePatient($id){
        return $this->delete($this->table,$id);
    }
}