<?php
require_once __DIR__ . "../repositories/BaseRepository.php";
class User extends BaseModel
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $phone;
    private $role;
    private $creat_at;
    private $updated_at;

    private string $table;

    public function __construct(
        $id,
        $fname,
        $lname,
        $email,
        $phone,
        $role,
        $created,
        $updated,
        $table
    ) {
        $this->firstname = $fname;
        $this->lastname = $lname;
        $this->email = $email;
        $this->phone = $phone;
        $this->role = $role;
        $this->creat_at = $created;
        $this->updated_at = $updated;
        $this->table = $table;
        $this->id = $id;
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
    public function setCreatAt($created)
    {
        $this->creat_at = $created;
    }
    public function setUpdatedAt($updated)
    {
        $this->updated_at = $updated;
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
    public function getCreatAt()
    {
        return $this->creat_at;
    }
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }


    
}