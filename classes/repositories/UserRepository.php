<?php

require_once "BaseRepository.php";

class UserRepository extends BaseModel{
    protected string $table = 'users';
    public function insertUser(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
             $data = [
        'first_name' => $_POST['first_name'] ?? null,
        'last_name' => $_POST['last_name'] ?? null,
        'email' => $_POST['email'] ?? null,
        'phone' => $_POST['phone'] ?? null,
        'role' => $_POST['role'] ?? null,
        'password_hash' => $_POST['password_hash'] ?? null,
    ];
    

    $columns = "";
    $placeholders = "";

    foreach ($data as $key => $val) {
        $columns .= "$key, ";
        $placeholders .= "?, ";
    }

    $columns = rtrim($columns, ", ");
    $placeholders = rtrim($placeholders, ", ");

    return $this->insert($this->table, $columns, $placeholders, array_values($data));
        }
    }

    public function updateUser($columns,$values,$id){
        return $this->update($columns,$values,$this->table,$id);
    }

    

}