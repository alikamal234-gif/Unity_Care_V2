<?php
require_once "BaseRepository.php";
class DoctorRepository extends BaseModel
{
    protected string $table = 'doctors';


    public function deleteDoctor($id)
    {
        return $this->delete($this->table, $id);
    }



    public function insertDoctor($data)
    {
        $sql = "INSERT INTO $this->table (id,spicialization,department_id)  VALUES (?,?,?)";
        $stm = $this->db->prepare($sql);
        $stm->execute([$data->getId(),$data->getSpecialization(), $data->getDepartmentId()]);
    
    }

    public function getNumber(){
        $sql = "SELECT  * FROM $this->table";

        $stm = $this->db->query($sql);
        return $stm->fetchColumn();

    }

    public function GetValueDoctors($id){
        return $this->getValue($id,$this->table);
    }
    public function updateDoctor($data){
        $sql = "UPDATE $this->table SET  
                spicialization = ? , 
                department_id= ?
                 WHERE 
                id = ?";
        $stm = $this->db->prepare($sql);
        $stm->execute([$data->getSpecialization(), $data->getDepartmentId(),$data->getId()]);
   
    }

    public function getAllDoctor(){
        return $this->getUserValue($this->table);
    }

    public function getPatientBydoctorId($id){
        $sql = "SELECT DISTINCT  a.id,
		a.date AS appointment_date, 
        a.time AS appointment_time,
        a.reason AS appointment_reason,
        a.status AS appointment_status,
        d.id AS doctor_id,
        d.spicialization AS doctor_spicialization,
        d.department_id AS doctor_department_id,
        u.first_name AS user_first_name,
        u.id AS user_id,
        u.last_name AS user_last_name,
        u.phone AS user_phone,
        u.role AS user_role,
		p.id AS patient_id,
        p.gender AS patient_gender,
        p.date_of_birth AS patient_date_of_birth,
        p.adress AS patient_adress
        FROM appointments a 
        JOIN doctors d ON d.id = a.doctor_id
        JOIN patients p ON p.id = a.patient_id
        JOIN users u ON u.id = p.id
        
        WHERE doctor_id = :id;
        ";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(":id",$id);
        $stm->execute();
        $result = $stm->fetchAll();
        return $result;
    }
    public function getNumberPatientBydoctorId($id){
        $sql = "SELECT COUNT(*) 
    FROM appointments 
    WHERE doctor_id = :id
        ";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(":id",$id);
        $stm->execute();
        $result = $stm->fetchColumn();
        return $result;
    }

    
}



