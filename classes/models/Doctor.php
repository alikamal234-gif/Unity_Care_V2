<?php

require_once "User.php";

class Doctor 
{
    private $specialization;
    private $departmentid;

    public function __construct(
        $specialization,
        $departmentid
    ) {
        $this->specialization = $specialization;
        $this->departmentid = $departmentid;
    }



    public function getspecialization(){
        return $this->specialization;
    }

    public function getDepartmentId(){
        return $this->departmentid;
    }
   
    public function setspecialization($specialization){
        $this->specialization = $specialization;
    }

    public function setDepartmentId($departmentid){
        $this->departmentid = $departmentid;
    }

}