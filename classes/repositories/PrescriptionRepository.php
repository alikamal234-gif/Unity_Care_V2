<?php
require_once "BaseRepository.php";

class PrescriptionRepository extends BaseModel {
    protected string $table = "prescriptions";
    public function getById($id){
        $sql = "SELECT * FROM $this->table p JOIN medications m ON m.id = p.medication_id JOIN users u ON u.id = p.id WHERE p.id = :id";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(":id",$id);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}