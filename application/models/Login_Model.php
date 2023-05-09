<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_Model extends CI_Model 
{

    function loginCheck($email,$password){
        $data = array();
        $this->db->select('*');
        $this->db->from('personal_information');
        $this->db->where('email',$email);
        $this->db->where('password',$password);
         
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $data = $query->row();
        }
        return $data;
    }
}
?>