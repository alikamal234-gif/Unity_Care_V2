<?php

require_once "BaseRepository.php";

class AppointmentRepository extends BaseModel {
    protected string $table = 'appointments';
    public function getNumber(){
        $sql = "SELECT  * FROM $this->table";

        $stm = $this->db->query($sql);
        return $stm->fetchColumn();

    }
}