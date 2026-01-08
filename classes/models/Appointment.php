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
    private $created;
    private $updatedat;


    public function __construct(
        $id,
        $date,
        $time,
        $doctorsid,
        $patientid,
        $reason,
        $status,

    ) {

        $this->id = $id;
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
    public function getDoctorsid(){
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
    public function getCreated(){
        return $this->created;
    }
    public function getUpdatedat(){
        return $this->updatedat;
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
    public function setDoctorsid($doctorsid){
        $this->doctorsid = $doctorsid;
    }
    public function setPatientid($patientid){
        $this->patientid = $patientid;
    }
    public function setReason($reason){
        $this->reason = $reason;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function setCreated($created){
        $this->created = $created;
    }
    public function setUpdatedat($updatedat){
        $this->updatedat = $updatedat;
    }
}