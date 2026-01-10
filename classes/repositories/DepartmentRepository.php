<?php
require_once "BaseRepository.php";
class DepartmentRepository extends BaseModel
{
    protected string $table = 'departments';


    public function insertDepartment($data)
    {
        $sql = "INSERT INTO $this->table (name,location) VALUES (?,?)";
        $stm = $this->db->prepare($sql);
        $stm->execute([$data->getName(),$data->getLocation()]);
    }



    public function deleteDepartment($id)
    {
        return $this->delete($this->table, $id);
    }

    public function getNumber()
    {
        $sql = "SELECT  * FROM $this->table";

        $stm = $this->db->query($sql);
        return $stm->fetchColumn();

    }
    public function getDepartment()
    {
        return $this->getAll($this->table);
    }

    public function GetValueDepartment($id)
    {
        return $this->getAll($this->table);
    }
    public function updateDepartment($columns, $values, $id)
    {
        return $this->update($columns, $values, $this->table, $id);
    }
}