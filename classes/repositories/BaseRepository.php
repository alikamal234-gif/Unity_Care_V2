<?php
require_once  __DIR__ ."../../Database.php" ;

class BaseModel {
    private PDO $db;
    protected string $table ;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
        
    }

    // crud starting 
    public function getAll(){
        $sql = "SELECT * FROM $this->table";
        $stm = $this->db->query($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete($table,$id){
        $sql = "DELETE FROM `$table` WHERE id=:id";
        echo $sql;
        $stm = $this->db->prepare($sql);
        $stm->bindParam('id',$id);
        $stm->execute();
    }

}
