<?php
require_once "BaseRepository.php";
class DoctorRepository extends BaseModel
{
    protected string $table = 'doctors';


    public function deleteDoctor($id)
    {
        return $this->delete($this->table, $id);
    }



    public function insertDoctor()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data_doctor = [
                'spicialization' => $_POST['spicialization'] ?? null,
                'department_id' => $_POST['department_id'] ?? null
            ];
            $columns = "";
            $placeholders = "";

            foreach ($data_doctor as $key => $val) {
                $columns .= "$key, ";
                $placeholders .= "?, ";
            }

            $columns = rtrim($columns, ", ");
            $placeholders = rtrim($placeholders, ", ");

            return $this->insert($this->table, $columns, $placeholders, array_values($data_doctor));
        }
    }
}