<?php

require_once "BaseRepository.php";

class AppointmentRepository extends BaseModel {
    protected string $table = 'appointments';
    public function getNumber(){
        $sql = "SELECT  * FROM $this->table";

        $stm = $this->db->query($sql);
        return $stm->fetchColumn();

    }

    public function deleteAppointment($id)
    {
        return $this->delete($this->table, $id);
    }

    public function getChartAppointments(string $startDate): array
    {
        $sql = "
            SELECT 
                d.day_name AS day,
                COALESCE(COUNT(a.id), 0) AS total
            FROM (
                SELECT 0 AS d, 'Monday'    AS day_name UNION ALL
                SELECT 1, 'Tuesday'   UNION ALL
                SELECT 2, 'Wednesday' UNION ALL
                SELECT 3, 'Thursday'  UNION ALL
                SELECT 4, 'Friday'    UNION ALL
                SELECT 5, 'Saturday'  UNION ALL
                SELECT 6, 'Sunday'
            ) d
            LEFT JOIN appointments a
                ON WEEKDAY(a.date) = d.d
                AND a.date BETWEEN :startDate
                AND DATE_ADD(:startDate, INTERVAL 6 DAY)
            GROUP BY d.d, d.day_name
            ORDER BY d.d
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'startDate' => $startDate
        ]);

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['day']] = (int) $row['total'];
        }

        return $result;
    }

        public function setAppointment($data){
            $sql = "INSERT INTO $this->table (date,time,doctor_id,patient_id,reason,status) VALUES (?,?,?,?,?,?) ";
            $stm = $this->db->prepare($sql);
            $stm->execute([$data->getDate(),$data->getTime(),$data->getDoctorId(),$data->getPatientId(),$data->getReason(),$data->getStatus()]);
        }

    

    public function getAppointments($id)
    {
        $sql = "SELECT 
    p.id            AS appointment_id,
    p.date,
    p.time,
    p.reason,
    p.status,

    pat.id          AS patient_id,
    pat.gender,
    pat.date_of_birth,
    pat.adress,

    d.id            AS doctor_id,
    d.spicialization,

    u.first_name    AS doctor_first_name,
    u.last_name     AS doctor_last_name

FROM $this->table p
JOIN patients pat ON p.patient_id = pat.id
JOIN doctors d    ON p.doctor_id = d.id
JOIN users u      ON u.id = d.id
WHERE p.patient_id = :id
";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(":id", $id);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function GetValueAppointment($id){
         $sql = "
        SELECT 
            p.*,
            u.first_name,
            u.last_name
        FROM appointments p
        JOIN patients pat ON pat.id = p.patient_id
        JOIN doctors d ON d.id = p.doctor_id
        JOIN users u ON u.id = d.id
        WHERE p.id = :id
    ";

    $stm = $this->db->prepare($sql);
    $stm->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stm->execute();

    return $stm->fetch(PDO::FETCH_ASSOC);

    }
    public function updateAppointment($data,$id){
        $sql = "UPDATE $this->table SET  
                date = ? , 
                time= ?,
                doctor_id = ?,
                patient_id = ?,
                reason = ?,
                stats = ? WHERE 
                id = ?";
        $stm = $this->db->prepare($sql);
        $stm->execute([$data->getDate(), $data->getTime(), $data->getDoctorId(), $data->getPatientId(),$data->getReason(),$data->getStatus(),$id]);
 
    }
    

    public function getAppointmentByDoctorsId($id){
        $sql = "SELECT * FROM $this->table WHERE doctor_id = :id";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(":id",$id);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    
}

