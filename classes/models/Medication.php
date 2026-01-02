<?php

class Medication
{
    private $id;
    private $name;
    private $instructions;
    private $creatat;

    public function __construct(
        $id,
        $name,
        $instructions,
        $creatat
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->instructions= $instructions;
        $this->creatat = $creatat;
    }


    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getinstructions(){
        return $this->instructions;
    }
    public function getcreated(){
        return $this->creatat;
    }



    public function setId($id){
        $this->id = $id;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setinstructions($instructions){
        $this->instructions = $instructions;
    }
    public function setcreated($creatat){
        $this->creatat = $creatat;
    }

}