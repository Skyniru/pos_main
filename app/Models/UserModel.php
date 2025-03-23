<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'user_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['fname', 'mname','lname','username','password', 'role'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getAllofUsers(){
        return $this->withDeleted()->findAll();
    }

    public function getExistingUsers(){
        return $this->findAll();
    }

    public function getUserbyUsername($username){
        return $this->where('username', $username)
                    ->first();
    }

    public function getUserbyFirstname($first_name){
        return $this->where('fname', $first_name)
                    ->first();
    }

    public function verifyPassword($input_password, $stored_password){
        if($input_password ==  $stored_password){
            return true;
        }else{
            return false;
        }

        // return password_verify($input_password, $stored_password);
    }

    public function registerNewUser($data){
        $insertdata = [
            'username' => $data['username'],
            // 'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'password' => $data['password'],
            'fname' => $data['fname'],
            'mname' => $data['mname'],
            'lname' => $data['lname'],
            'role' => '2',
        ];


        $this->insert($insertdata);
        return $this->getInsertID();
    }


    //template for your reference
    public function insertdata($username){
        $this->insert($username);
    }
}