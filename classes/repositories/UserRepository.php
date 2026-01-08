<?php

require_once "BaseRepository.php";

class UserRepository extends BaseModel{
    protected string $table = 'users';
    public function insertUser($data){
        $sql = "INSERT INTO $this->table (id,email,first_name,last_name,phone,password_hash,role) values (?,?,?,?,?,?,?)";
        $stm = $this->db->prepare($sql);
        $stm->execute([null,$data->getEmail(),$data->getFirstName(),$data->getLastName(),$data->getPhone(),$data->getPassword(),$data->getRole()]);
        return $this->db->lastInsertId();
    }

    public function updateUser($columns,$values,$id){
        return $this->update($columns,$values,$this->table,$id);
    }

    

}