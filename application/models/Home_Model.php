<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_Model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insertinfo($data){

        $this->db->insert('personal_information',$data);
        $user_id = $this->db->insert_id();
        return $user_id;
      
    }
    public function citylist()
    {
        $this->db->select('*');
        $this->db->from('city');
        $query = $this->db->get();
        return $query->result();
    }
public function statelist()
{
    $this->db->select('*');
    $this->db->from('state');
    $query = $this->db->get();
    return $query->result();
}
public function updateotp($otp,$user_id)
{
    $this->db->where('user_id',$user_id);
    $this->db->update('personal_information',$otp);
    return true;
} 

public function insertempl($data){

    $this->db->insert('employment',$data);
    $user_id = $this->db->insert_id();
    return $user_id;
  
} 
public function inserteduca($data)
{
    $this->db->insert('education',$data);
    $user_id = $this->db->insert_id();
    return $user_id;
} 
public function insertlast($data)
{
    $this->db->insert('preference',$data);
    $user_id = $this->db->insert_id();
    return $user_id;
}
public function insertcity($data)
{          
    $this->db->insert('work_location',$data);
    return true;
}
public function verifynum($phone)
{
    $this->db->select('*');
    $this->db->where('phone',$phone);
    $this->db->from('personal_information');
    $query = $this->db->get();
    return $query->num_rows();
}
}
?>