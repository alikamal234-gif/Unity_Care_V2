<?php

require_once __DIR__ . "../repositories/BaseRepository.php";
require_once "User.php";

class Patient{
    private $gender;
    private $dateofbirthday;
    private $address;

    

    public function getGender(){
        return $this->gender;
    }
    public function getDateOfBirthday(){
        return $this->dateofbirthday;
    }
    public function getAddress(){
        return $this->address;
    }


    


    public function setGender($gender){
        if(!in_array($gender,['male','female'])){
            echo "invalid gender";
            exit;
        }
        $this->gender = $gender;
    }
    public function setDateOfBirthday($dateofbirthday){
        $this->dateof = $dateofbirthday;
    }
    public function setAddress($address){
        $this->addres = $address;
    }

    public function getTable():string{
        return 'patient';
    }
}