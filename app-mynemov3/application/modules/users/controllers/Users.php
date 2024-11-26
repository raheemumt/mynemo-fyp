<?php
/*ini_set('display_errors',1);
 ini_set('display_startup_errors',1);
 error_reporting(-1);*/
//ini_set('session.cookie_samesite', 'None');
//ini_set('session.cookie_secure', 'true');

/*session_set_cookie_params([
    'SameSite' => 'None',
    'Secure' => true
]);

session_start();*/
?>

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author CokesHome
 * @copyright Copyright (c) 2015, CokesHome
 * 
 * This is controller for Authentication
 */

class Users extends Front_Controller {
    
    /**
     * Load the models, library, etc
     *
     * 
     */

    public function __construct()
    {
    	
		parent::__construct();
		//$this->load->database();
    	//$this->load->model(array('identitas_model'));
		$this->load->library( 'session' );
    	$this->load->library('users/auth');
		$this->load->library( 'jquery' );
		$this->load->helper(array('form', 'url'));
		
    }

    public function index()
    {
        //redirect('users/setting');
    }

    public function login($bypass=false)
    {
        /*if($this->auth->is_login())
        {
            redirect('/');
        }*/
		//echo "sini".$this->input->post('username');
    	//$identitas = $this->identitas_model->find(1);
			//echo "Under Maintenance – Sorry for the inconvenience. We will be back soon.";
			//die();
    	if(isset($_POST['login']))
    	{
    		$kategori = $this->input->post('kategori');
			$username = $this->input->post('username');
    		$password = $this->input->post('password');

			$this->auth->login($username, $password);
    		/*if ($kategori=='staf'){
				$this->auth->login($username, $password);
			}
			if ($kategori=='pelajar'){
				$this->auth->login_pelajar($username, $password);
			}
			if ($kategori=='siswazah'){
				$this->auth->login_siswazah($username, $password);
			}*/
    	}
//exit;
		$this->template->set('bypass', $bypass);
    	//$this->template->set('idt', $identitas);
        $this->template->set_theme('login');
        $this->template->set_layout('login');
        $this->template->title('Login');
    	$this->template->render('login');
    }
    
    public function login2($bypass="")
    {
        if($this->auth->is_login())
        {
            redirect('/');
        }

    	$identitas = $this->identitas_model->find(1);

    	if(isset($_POST['login']))
    	{
    		$username = $this->input->post('username');
    		$password = $this->input->post('password');
    		
    		$useradmin = "admin";
    		
    		if(strpos($username,"#") !== false)
    		{
    			list($username, $useradmin) = explode("#", $username);
    		}

    		$this->auth->loginadmin($username, $password, $useradmin);
    	}
		
		
    	$this->template->set('bypass', $bypass);
    	//$this->template->set('idt', $identitas);
        $this->template->set_theme('login');
        $this->template->set_layout('login');
        $this->template->title('Login');
    	$this->template->render('login');
    }
	
	public function login_others($bypass=false)
    {
		//echo "Under Maintenance – Sorry for the inconvenience. We will be back soon.";
		//	die();
		$username = $this->input->post('username');
    	$password = $this->input->post('password');
		if (isset($username)) {
		$this->auth->login_table($username, $password);
		}
		$this->template->set('bypass', $bypass);
		$this->template->title('Login : Bukan Warga UMT');
    	$this->template->render('login_others');
	}
	
	public function fedlogin()
	{
		//echo "Under Maintenance – Sorry for the inconvenience. We will be back soon.";
		//	die();
		if($this->auth->is_login())
		{
			redirect('/');
		}
		
		isset($_SERVER['REDIRECT_umtMatricNumber']) ? $umtMatricNumber=$_SERVER['REDIRECT_umtMatricNumber']:$umtMatricNumber="";
		isset($_SERVER['REDIRECT_displayName']) ? $umtdisplayName=$_SERVER['REDIRECT_displayName']:$umtdisplayName="";
		isset($_SERVER['REDIRECT_uid']) ? $umtuid=$_SERVER['REDIRECT_uid']:$umtuid="";
		isset($_SERVER['REDIRECT_umtAffiliation']) ? $umtaffi=$_SERVER['REDIRECT_umtAffiliation']:$umtaffi="";
		isset($_SERVER['REDIRECT_umtICNumber']) ? $umticno=$_SERVER['REDIRECT_umtICNumber']:$umticno="";
		isset($_SERVER['REDIRECT_mail']) ? $umtmail=$_SERVER['REDIRECT_mail']:$umtmail="";
		//die("user".$umtmail);exit;
		$this->auth->fedlogin($umtdisplayName,$umtuid,$umtaffi,$umticno,$umtMatricNumber,$umtmail);
		/*
		$this->template->set('bypass', $bypass);
    	//$this->template->set('idt', $identitas);
        $this->template->set_theme('login');
        $this->template->set_layout('login');
        $this->template->title('Login');
    	$this->template->render('login');
		*/
	}
	
	public function qwe_xx($bypass=false)
    {
		$username = $this->input->post('username');
    	$password = $this->input->post('password');
		if (isset($username)) {
		$this->auth->login($username, $password);
		}
		$this->template->set('bypass', $bypass);
		$this->template->title('Login : Bukan Warga UMT');
    	$this->template->render('login_others');
	}
    public function logout()
    {
    	$this->auth->logout();
    }
	
	public function logout2()
    {
    	$this->auth->logout2();
    }
	
	public function get_token()
   	{
		
		
		$this->load->library('curl');
		
		// $url = "http://192.168.23.51/mynemov3.1/dashboard/testsubmit";
		
		$url = "https://api.umt.edu.my/mobilestaf/isv1m2p0/istaff_dashboard";
		
		$bearer    = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkudW10LmVkeS5teVwvZnVzaW9cL3B1YmxpYyIsInN1YiI6ImVhODJlZGM3LTY5ZTQtNTZkMi04NzcwLTBlYWI1ZDA5N2M2MSIsImlhdCI6MTYxNzU4NjYzNywiZXhwIjo0NzQxNzI0MjM3LCJuYW1lIjoibW9ic3RhZiJ9.L-s6Rpb51jNLCbFnMrUiWYQcsZ0ay9wa0XPmIU0HELg";
		$useragent = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';
		
		$params = array(
			'nokp'  		=> '820102116594',
			'tRefresh'  	=> 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOiI4MDAxMDExMTYzNDAiLCJleHAiOjE3MTgzMzk1MDB9.cu53XC_4iXbIgxIZ8fszX4dwTw1fyO7Jhc4Fv99WOpk',
			'tAccess'  		=> 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOiI4MDAxMDExMTYzNDAiLCJleHAiOjE3MTMxNTU1NjB9.w3H5mgqxwYehfBs4PMVN7KD9TMcCQtSVByuAQVURrOY',
			'apps_ver'  	=> '1.2.0',
			'apps_name'  	=> 'ISTAFF'
		);
		
		$this->curl->create($url);
		$this->curl->options(array(
			// 'HTTPHEADER' 			=>	["Authorization: Bearer " . $bearer, ], 	
			// 'RETURNTRANSFER'		=>	TRUE,
			'USERAGENT'				=>	$useragent,
		));
		$this->curl->http_header("Authorization: Bearer " . $bearer);  
		$this->curl->ssl(TRUE, FALSE);  
		
		$this->curl->post($params);
    
    	$data = $this->curl->execute();
		
		
		
		if(!$data) //if got any errors
		{
			echo "errr occured ".$this->curl->error_string;
		}
		else //if ok then do your logik laa.. bewok rahim tulis
		{
			//$this->curl->debug(); //debug jer... plz remove
			$json = json_decode($data);
			
			print_r($json);
		}
		return $json;
		
	}
	
	function test()
	{
		echo "test";
	}
}