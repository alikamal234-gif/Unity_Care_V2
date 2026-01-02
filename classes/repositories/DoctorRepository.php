<?php
require_once "BaseRepository.php";
class DoctorRepository extends BaseModel{
    protected string $table = 'doctors';


    public function deleteDoctor($id){
        return $this->delete($this->table,$id);
    }
}