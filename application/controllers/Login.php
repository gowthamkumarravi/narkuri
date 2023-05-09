<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
class Login extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_Model');
    }
    public function index()
    {
       
            $email = $this->input->post('email');
            $password = $this->input->post('password');        
            $obj = $this->Login_Model->loginCheck($email,$password);
            if(is_object($obj)){
                $this->session->set_userdata('user_id',$obj->id); 
                $this->session->set_userdata('first_name',$obj->first_name); 
                redirect('Home/registerpage');
            }else{
                $this->session->set_flashdata('error','invalide login details');
            }
        
        $this->load->view('login_form');
    }

}
?>