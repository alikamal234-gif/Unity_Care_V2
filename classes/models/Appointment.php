<?php

class Appointment
{
    private int $id;
    private string $date;
    private string $time;
    private int $doctorsid;
    private int $patientid;
    private string $reason;
    private string $status;



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

    public function getId():int{
        return $this->id;
    }
    public function getDate(): string{
        return $this->date;
    }
    public function getTime(): string{
        return $this->time;
    }
    public function getDoctorId(): int{
        return $this->doctorsid;
    }
    public function getPatientid(): int{
        return $this->patientid;
    }
    public function getReason(): string{
        return $this->reason;
    }
    public function getStatus(): string{
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