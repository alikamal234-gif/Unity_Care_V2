<?php

class Departement
{
    private int $id;
    private string $name;
    private string $location;

    public function __construct(
        $name,
        $location
    ) {
        $this->name = $name;
        $this->location = $location;
    }

   
    public function getName(){
        return $this->name;
    }
    public function getLocation(){
        return $this->location;
    }



    public function setName($name){
        $this->name = $name;
    }
    public function setLocation($location){
        $this->location = $location;
    }
}