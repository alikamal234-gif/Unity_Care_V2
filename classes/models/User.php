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
  


    public function getFirstName()
    {
        return $this->firstname;
    }
    public function getLastName()
    {
        return $this->lastname;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getPassword()
    {
        return $this->password_hash;
    }



    
}