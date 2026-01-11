<?php
require_once __DIR__ . "/../repositories/BaseRepository.php";
class User extends BaseModel
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $phone;
    private $role;
    private $password_hash;



    public function __construct(
        $id,
        $fname,
        $lname,
        $email,
        $phone,
        $role,
        $password_hash
    ) {
        $this->id = $id;
        $this->firstname = $fname;
        $this->lastname = $lname;
        $this->email = $email;
        $this->phone = $phone;
        $this->role = $role;
        $this->password_hash = $password_hash;
    }
    



    public function setId($id)
    {
        $this->id = $id;
    }
    public function setFirstName($fname)
    {
        $this->firstname = $fname;
    }
    public function setLastName($lname)
    {
        $this->lastname = $lname;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
  

    public function getId():int{
        return $this->id;
    }
    public function getFirstName():string
    {
        return $this->firstname;
    }
    public function getLastName():string
    {
        return $this->lastname;
    }
    public function getEmail():string
    {
        return $this->email;
    }
    public function getPhone():string
    {
        return $this->phone;
    }
    public function getRole():string
    {
        return $this->role;
    }
    public function getPassword():string
    {
        return $this->password_hash;
    }



    
}