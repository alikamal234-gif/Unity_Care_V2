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
        $sql = "SELECT * FROM $this->table where id=?";
        $stm = $this->db->prepare($sql);
        $stm->execute([$id]);
        return $stm->fetch();
    }
    public function updateDepartment($data,$id)
    {
         $sql = "UPDATE $this->table SET  
                name = ? , 
                location= ?
                 WHERE 
                id = ?";
        $stm = $this->db->prepare($sql);
        $stm->execute([$data->getName(), $data->getLocation(),$id]);
 
    }
}