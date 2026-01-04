<?php

require_once "BaseRepository.php";

class AppointmentRepository extends BaseModel {
    protected string $table = 'appointments';
    public function getNumber(){
        $sql = "SELECT  * FROM $this->table";

        $stm = $this->db->query($sql);
        return $stm->fetchColumn();

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
        $columns = "";
        $values = "";

        foreach ($data as $key => $value) {
            $columns .= "$key, ";
            $values .= "?, ";
        }

        $values = rtrim($values, ", ");
        $columns = rtrim($columns, ", ");
        return $this->insertAll($columns,$values,$data,$this->table);
    }

    public function getAppointments($id){
        return $this->getAllWithDoctors($this->table,$id);
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
    public function updateAppointment($columns,$values,$id){
        return $this->update($columns,$values,$this->table,$id);
    }
    
}

