<?php

require_once "User.php";

class Prescription extends User {
    private $id ;
    private $date;
    private $doctorid;
    private $patientid;
    private $medicationid;
    private $dosageinstructioons;
    private $createdat;
    
    public function __construct( $date, $doctorid, $patientid, $medicationid, $dosageinstructioons){
        $this->date = $date;
        $this->doctorid= $doctorid;
        $this->patientid = $patientid;
        $this->medicationid = $medicationid;
        $this->dosageinstructioons = $dosageinstructioons;
    }

    public function getId(){
        return $this->id;
    }
    public function getDate(){
        return $this->date;
    }
    public function getDoctorId(){
        return $this->doctorid;
    }
    public function getPatientId(){
        return $this->patientid;
    }
    public function getMedicationId(){
        return $this->medicationid;
    }
    public function getDosage(){
        return $this->dosageinstructioons;
    }
    public function getCreated(){
        return $this->createdat;
    }


    public function setId($id){
        $this->id = $id;
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setDoctorId($doctorid){
        $this->doctorid = $doctorid;
    }
    public function setPatientId($patientid){
        $this->patientid = $patientid;
    }
    public function setMedicationId($medicationid){
        $this->medicationid = $medicationid;
    }
    public function setDosage($dosageinstructioons){
        $this->dosageinstructioons = $dosageinstructioons;
    }
    public function setCreated($createdat){
        $this->createdat = $createdat;
    }
}