<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Home_Model');
	 }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */


	public function registerpage()
	{
		$data['count'] = 1;
		if($this->session->userdata('count') != ''){
			$data['count'] = $this->session->userdata('count');
		}
		if($this->input->post())
		{
		
			if( $this->input->post('step') == "one"){
				$basicInfo['first_name'] = $this->input->post('first_name');
				$basicInfo['email'] = $this->input->post('email');
				$basicInfo['password'] = $this->input->post('Password');
				$basicInfo['phone'] = $this->input->post('phone');
				$basicInfo['gender'] = $this->input->post('gender');
				$basicInfo['work_status'] = $this->input->post('workstatus');
				$basicInfo['city'] = $this->input->post('city');
				$basicInfo['state'] = $this->input->post('state');
				$basicInfo['register_step'] = 1;
		
				//print_r($this->input->post() );exit;
				$filename = '';
				$target_dir = "image/";
				if(isset($_FILES["Resume"]["tmp_name"])) {
					$filename = $_FILES["Resume"]["name"];
					$target_file = $target_dir . basename($_FILES["Resume"]["name"]);
					move_uploaded_file($_FILES["Resume"]["tmp_name"], $target_file);
						//echo "The file", htmlspecialchars( basename($_FILES["Resume"]["name"])), "has ben uploaded";
				}
				$basicInfo['resume'] = $filename;
				$last_id = $this->Home_Model->insertinfo($basicInfo);
				$this->session->set_userdata('user_id',$last_id);
				$otp= rand(1231,7879);
				$this->session->set_userdata('otp',$otp);
				$url = 'http://site.ping4sms.com/api/smsapi?key=481de99dcdf7af0fd3d2a73dbeb766a4&route=2&sender=PNGOTP&number='.$basicInfo['phone'].'&sms=Dear%20Customer,'.$otp.'%20is%20your%20verification%20code%20-PNGOTP&templateid=1507165967974501361';
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET',
					CURLOPT_HTTPHEADER => array(
						'Cookie: ci_session=15u5k870kg509usdel2rcrhqk40dfhuq'
					),
				));
				$response = curl_exec($curl);
				curl_close($curl);
				$this->session->set_userdata('count',2);
			}
			$data['count'] = 2;
			if($this->session->userdata('count') != ''){
				$data['count'] = $this->session->userdata('count');
			}
			
		//echo  $this->input->post('step');
			if( $this->input->post('step') == "two")
			{
				$otp['register_step'] = 2;
				$this->session->set_userdata('count',3);
				$data['count'] = 3;
				if($this->session->userdata('count') != ''){
					$data['count'] = $this->session->userdata('count');
					
				}
			}
		    //echo  $this->input->post('step');
			if( $this->input->post('step') == "three")
			{
				
				$this->session->set_userdata('count',4);
				$empInfo['currently_employed'] = $this->input->post('Employed');
				$empInfo['experience'] = $this->input->post('Work');
				$empInfo['company'] = $this->input->post('company');
				$empInfo['job_title'] = $this->input->post('title');
				$empInfo['city'] = $this->input->post('precity');
				$empInfo['work_experience'] = $this->input->post('experience');
				$empInfo['working_since'] = $this->input->post('Since');
				$empInfo['annual_salary'] = $this->input->post('annualsalary');
				$empInfo['notice_period'] = $this->input->post('Notice');
				$empInfo['user_id'] = $this->session->userdata('user_id');
				$obj = $this->Home_Model->insertempl($empInfo);
				if($this->session->userdata('count') != ''){
					$data['count'] = $this->session->userdata('count');
				}
			}
			
			if( $this->input->post('step') == "four")
			{
				
				$this->session->set_userdata('count',5);
				$eduInfo['qualification'] = $this->input->post('Qualification');
				$eduInfo['course'] = $this->input->post('Course');
				$eduInfo['specialization'] = $this->input->post('Specialization');
				$eduInfo['university'] = $this->input->post('University');
				$eduInfo['course_type'] = $this->input->post('Course_Type');
				$eduInfo['starting_year'] = $this->input->post('Starting');
				$eduInfo['passing_year'] = $this->input->post('Passing');
			    $eduInfo['user_id'] = $this->session->userdata('user_id');
				$obj = $this->Home_Model->inserteduca($eduInfo);
			}
			
			if( $this->input->post('step') == "five")
			{
				$lastInfo['resume_headline'] = $this->input->post('Headline');
				$lastInfo['salary'] = $this->input->post('Salary');
				$user_id = $this->session->userdata('user_id');
			    $lastInfo['user_id'] = $user_id;
				$this->Home_Model->insertlast($lastInfo);

				$city = $this->input->post('prefcity');
				//print_r($city); exit;
				for($i = 0;$i<sizeof($city); $i++){
					$cityobj['user_id'] = $user_id;
					$cityobj['city_id'] = $city[$i];
						   //print_r($city); exit;
			 $this->Home_Model->insertcity($cityobj);
				
				}


				redirect('Login/index');
				
			}
		   

		}
		$this->load->view('register',$data);
	}
	public function VerifyMobile()
	{
    	$phone = $this->input->post('mobile');
		$count = $this->Home_Model->verifynum($phone);
		if($count == 0){
			echo "Mobile number available";
		}else{
			echo "Mobile number already exist";
		}
    }
	public function CheckOtp()
	{
        $otp1 = $this->input->post('otp');
        $otp = $this->session->userdata('otp');
        //echo $otp1; exit;
        if($otp == $otp1){
            echo "Valid";
        }else{
            echo "Invalid OTP";
        }
    }
}
?>