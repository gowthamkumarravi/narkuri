<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mobile_Model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
    public function verifynum($phone)
    {
        $data = 'Mobile number not available';
        $this->db->select('*');
        $this->db->where('phone',$phone);
        $this->db->from('personal_information');
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $data = 'Mobile number available';
        }
        return $data;
    }
}
?>