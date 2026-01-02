<?php
require_once __DIR__ . "../../Database.php";

class AdminRepository
{
    private PDO $db;


    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

    }

    // crud starting 
    public function getAll($table, $role)
    {
        $sql = "SELECT u.*, d.*
        FROM users u
        JOIN $table d ON d.id = u.id
        WHERE u.role = '$role' ;";
        $stm = $this->db->query($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRendezVous()
    {
        $sql = "SELECT 
    a.id AS appointment_id,

    up.id AS patient_id,
    up.first_name AS patient_first_name,
    up.last_name  AS patient_last_name,

    ud.id AS doctor_id,
    ud.first_name AS doctor_first_name,
    ud.last_name  AS doctor_last_name,

    a.date,
    a.time,
    a.reason,
    a.status

    FROM appointments a

    JOIN users up ON up.id = a.patient_id
    JOIN users ud ON ud.id = a.doctor_id;";


        $stm = $this->db->query($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);

    }

}

