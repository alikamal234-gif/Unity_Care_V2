<?php

require_once "User.php";

class Doctor 
{
    private int $id;
    private $specialization;
    private $departmentid;

    public function __construct(
        $id,
        $specialization,
        $departmentid
    ) {
        $this->id = $id;
        $this->specialization = $specialization;
        $this->departmentid = $departmentid;
    }



    public function getId(){
        return $this->id;
    }
    public function getSpecialization(){
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