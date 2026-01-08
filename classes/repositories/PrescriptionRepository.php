<?php
require_once "BaseRepository.php";

class PrescriptionRepository extends BaseModel {
    protected string $table = "prescriptions";
    public function getById($id){
        $sql = "SELECT 
p.id as prescription_id,
p.date as prescription_date,
p.doctor_id as prescription_doctor_id,
p.patient_id as prescription_patient_id,
p.medication_id as prescription_medication_id ,
p.dosage_instructions as prescription_dosage_instructions,
m.id as medication_id,
m.name as medication_name,
m.instructions as medication_instructions,
u.id as user_id,
u.email as user_email,
u.first_name as user_first_name,
u.last_name as user_last_name,
u.phone as user_phone
FROM $this->table p JOIN medications m ON m.id = p.medication_id JOIN users u ON u.id = p.id WHERE p.id = :id";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(":id",$id);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function getNumberPrescriptions($id){
        $sql = "SELECT COUNT(*) FROM $this->table WHERE doctor_id = :id";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(":id",$id);
        $stm->execute();
        $result = $stm->fetchColumn();
        return $result;

    }

    public function getByDoctorId($id){
        $sql = "SELECT 
p.id as prescription_id,
p.date as prescription_date,
p.doctor_id as prescription_doctor_id,
p.patient_id as prescription_patient_id,
p.medication_id as prescription_medication_id ,
p.dosage_instructions as prescription_dosage_instructions,
m.id as medication_id,
m.name as medication_name,
m.instructions as medication_instructions,
u.id as user_id,
u.email as user_email,
u.first_name as user_first_name,
u.last_name as user_last_name,
u.phone as user_phone
FROM prescriptions p JOIN medications m ON m.id = p.medication_id JOIN users u ON u.id = p.id WHERE p.doctor_id = :id";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(":id",$id);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}