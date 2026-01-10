<?php

class Appointment
{
    private $id;
    private $date;
    private $time;
    private $doctorsid;
    private $patientid;
    private $reason;
    private $status;



    public function __construct(
        $date,
        $time,
        $doctorsid,
        $patientid,
        $reason,
        $status,

    ) {

        $this->date = $date;
        $this->time = $time;
        $this->doctorsid = $doctorsid;
        $this->patientid = $patientid;
        $this->reason = $reason;
        $this->status = $status;


    }

    public function getId(){
        return $this->id;
    }
    public function getDate(){
        return $this->date;
    }
    public function getTime(){
        return $this->time;
    }
    public function getDoctorId(){
        return $this->doctorsid;
    }
    public function getPatientid(){
        return $this->patientid;
    }
    public function getReason(){
        return $this->reason;
    }
    public function getStatus(){
        return $this->status;
    }






    public function setId($id){
        $this->id = $id;
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setTime($time){
        $this->time = $time;
    }
    public function setDoctorId($doctorsid){
        $this->doctorsid = $doctorsid;
    }
    public function setPatientId($patientid){
        $this->patientid = $patientid;
    }
    public function setReason($reason){
        $this->reason = $reason;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    
}