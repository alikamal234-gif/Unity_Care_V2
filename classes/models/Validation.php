<?php
require_once __DIR__ . '/../repositories/BaseRepository.php';
session_start();
class ValidationLogin extends BaseModel{
    public function login($email , $password){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(":email",$email);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        if($result){
            if($result['password_hash'] == $password){
                $_SESSION['id_login'] = $result['id'];
                $_SESSION['role'] = $result['role'];
                if($_SESSION['role'] == 'admin'){
                    header('Location: ../../index.php');
                }else if ($_SESSION['role'] == 'patient'){
                    header('Location: ../P_patients.php');
                }else if($_SESSION['role'] == 'doctor'){
                    header('Location: ../P_doctors.php');


                }
                exit;
            }else{
                echo "login was failed";
            }
        }else{
            echo "there not email like this";
        }
    }
}

