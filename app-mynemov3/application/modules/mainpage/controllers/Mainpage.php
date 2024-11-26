<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
 
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author CokesHome
 * @copyright Copyright (c) 2015, CokesHome
 * 
 * This is controller for Authentication
 */

class Mainpage extends Nemo_Controller {
    
    /**
     * Load the models, library, etc
     *
     * 
     */
	protected $viewPermission   = "Mainpage.View";
	
    public function __construct()
    {
    	parent::__construct();
		$this->load->database();
		$this->load->library('session');
		//$this->load->model("mainpage/t01_model","t01m");
		$this->load->model(array('mainpage/t01_model'=>'t01m',
								 'mainpage/t02_model'=>'t02m',
								 'users/personel_model'=>'per'));
    	
		$this->load->library('jquery');
		$this->load->helper(array('form', 'url','loc'));
		$this->template->title(lang('title_manage'));
		//$this->userData = $this->ci->session->userdata('app_session');
    }

    public function index()
    {
       
		
    }
	
	

    public function main()
    {
		//echo "nokp=".$_SESSION['icno'];exit;
		if($_SESSION['icno']=='')
        {
            redirect('login');
        }
		
		if( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ){ 
  			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];// your code here
			$ip1 = substr($ip,0,8);
	 		$ip2 = substr($ip,0,7);
		} else {
			$ip ="";
			$ip1 ="";
			$ip2 = "";
		}
		//echo "sini".$ip1."=".$ip2;
	 	//language
    
    $session_lang = get_lang_sis();
    
		/*$set_lang_cms = $_POST['dataLang'];
		$session_lang = $set_lang_cms;*/
		if($session_lang == "EN"){
			
			$set_lang_cms = "EN";
			$array = array("rslt_lang"  =>  $set_lang_cms );
			$session_lang = $set_lang_cms;
			
		}else{
			
			$set_lang_cms = "MY";
			$array = array("rslt_lang"  =>  $set_lang_cms );
			$session_lang = $set_lang_cms;	
		}
		
		if($session_lang == "MY")
		{ 	
	
			
			$this->lang->load('mainpage_my');	
			
		}else{ 
		
			
			$this->lang->load('mainpage_en');
			
		}
		$array = array( "rslt_lang"  =>  $set_lang_cms );
		$this->userData = $array;
		$this->session->set_userdata( 'app_session', $this->userData );
    //*/
		//$language = $this->lang_pick();
		
		$timestamp = time();
		$date = date("H:i:s", $timestamp);
		$masa = date("H:i", $timestamp);
		$curdate = date("dmY", $timestamp);
		
		$t07id      = $this->input->post('t07id');
		$data = $this->per->personel( $_SESSION['icno'] );
		// $covid = $this->per->cek_covid( $_SESSION['icno'] );
		// $wfh = $this->per->cek_wfh( $_SESSION['icno'] );
		// $tkhwbf= $this->per->wbf_pprtkh($_SESSION['icno'],$curdate);
		// $ipmytime = $this->per->cek_ipmytime($ip1,$ip2);
		// $t01 = $this->t01m->t01_group();
		$t0204 = $this->t02m->t02_aplikasi_iconcolor($data->IDSTAF);				
		// $sent07 = $this->t02m->sen_t07();				
		// $json = $this->get_token();
		// $this->template->set('json',$json);
		$this->template->set('language',$session_lang);
		// $this->template->set('sent07',$sent07);
		// $this->template->set('t01',$t01);
		// // $this->template->set('t07id',$t07id);
		$this->template->set('t0204',$t0204);
		$this->template->set('data',$data);
		// $this->template->set('covid',$covid);
		// $this->template->set('wfh',$wfh);
		// $this->template->set('tkhwbf',$tkhwbf);
		// $this->template->set('ipmytime',$ipmytime);
		//$this->template->set('session_lang',$language);
		$this->template->render('main');
		
    }
	
	public function get_token()
   	{
		if($_SESSION['icno']=='')
        {
            redirect('login');
        }
		
		$this->load->library('curl');
		
		// $url = "http://192.168.23.51/mynemov3.1/dashboard/testsubmit";
		
		$url = "https://api.umt.edu.my/mobilestaf/isv1m2p0/istaff_dashboard";
		
		$bearer    = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkudW10LmVkeS5teVwvZnVzaW9cL3B1YmxpYyIsInN1YiI6ImVhODJlZGM3LTY5ZTQtNTZkMi04NzcwLTBlYWI1ZDA5N2M2MSIsImlhdCI6MTYxNzU4NjYzNywiZXhwIjo0NzQxNzI0MjM3LCJuYW1lIjoibW9ic3RhZiJ9.L-s6Rpb51jNLCbFnMrUiWYQcsZ0ay9wa0XPmIU0HELg";
		$useragent = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';
		
		$params = array(
			'nokp'  		=> $_SESSION['icno'],
			'tRefresh'  	=> 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOiI4MDAxMDExMTYzNDAiLCJleHAiOjE3MTgzMzk1MDB9.cu53XC_4iXbIgxIZ8fszX4dwTw1fyO7Jhc4Fv99WOpk',
			'tAccess'  		=> 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOiI4MDAxMDExMTYzNDAiLCJleHAiOjE3MTMxNTU1NjB9.w3H5mgqxwYehfBs4PMVN7KD9TMcCQtSVByuAQVURrOY',
			'apps_ver'  	=> '1.2.0',
			'apps_name'  	=> 'ISTAFF',
			//'taraf_khidmat'  	=> $_SESSION['taraf'],
			'stafkump'  	=> $_SESSION['kump_staf'],
			'kategori'  	=> $_SESSION['kategori']
		);
		
		$this->curl->create($url);
		$this->curl->options(array(
			// 'HTTPHEADER' 			=>	["Authorization: Bearer " . $bearer, ], 	
			// 'RETURNTRANSFER'		=>	TRUE,
			'USERAGENT'				=>	$useragent,
		));
		$this->curl->http_header("Authorization: Bearer " . $bearer);  
		$this->curl->ssl(FALSE, FALSE);  
		
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
			
			//print_r($json);
		}
		return $json;
		
	}
	public function main_dashboard()
   	{
   		//$this->auth->restrict($this->viewPermission);
		if($_SESSION['icno']=='')
        {
            redirect('login');
        }
		$this->template->render('main_dashboard');
   	}
	/*
	public function redirect( $id = null )
   	{
		if($_SESSION['icno']=='')
        {
            redirect('login');
        }
		$data = $this->per->personel( $_SESSION['icno'] );
		$platform = $this->t02m->get_url($id);
		$t01 = $this->t01m->t01_group();
		$this->template->set('platform',$platform);
		$this->template->set('t01',$t01);
		$this->template->set('id',$id);
		$this->template->set('data',$data);
		$this->template->render('redirect');
   	}
	
	public function todoredirect( $id = null)
   	{
		if($_SESSION['icno']=='')
        {
            redirect('login');
        }
		$data = $this->per->personel( $_SESSION['icno'] );
		$g_url = $this->t02m->get_todourl($id);
		$platform = $this->t02m->get_url($g_url->T02_ID);
		$t01 = $this->t01m->t01_group();
		$this->template->set('platform',$platform);
		$this->template->set('g_url',$g_url);
		$this->template->set('t01',$t01);
		$this->template->set('id',$id);
		$this->template->set('todo_url',$url);
		$this->template->set('data',$data);
		$this->template->render('todoredirect');
   	}*/
	
	public function main_menu()
   	{
   		//$this->auth->restrict($this->viewPermission);
		
		$this->template->render('main_menu');
   	}
	
	/*public function main_dashboard()
   	{
   		//$this->auth->restrict($this->viewPermission);
		if($_SESSION['icno']=='')
        {
            redirect('login');
        }
		$this->template->render('main_dashboard');
   	}*/
	
	public function main_menupage($t01id= null)
   	{
   		if($_SESSION['icno']=='')
        {
            redirect('login');
        }
		
		$session_lang = get_lang_sis();
    
		
		if($session_lang == "EN"){
			
			$set_lang_cms = "EN";
			$array = array("rslt_lang"  =>  $set_lang_cms );
			$session_lang = $set_lang_cms;
			
		}else{
			
			$set_lang_cms = "MY";
			$array = array("rslt_lang"  =>  $set_lang_cms );
			$session_lang = $set_lang_cms;	
		}
		
		if($session_lang == "MY")
		{ 	
	
			
			$this->lang->load('mainpage_my');	
			
		}else{ 
		
			
			$this->lang->load('mainpage_en');
			
		}
		$array = array( "rslt_lang"  =>  $set_lang_cms );
		$this->userData = $array;
		$this->session->set_userdata( 'app_session', $this->userData );
		
		$data = $this->per->personel( $_SESSION['icno'] );
		$t01 = $this->t01m->t01_group();
		$dt01 = $this->t01m->get_t01($t01id);
		$t02 = $this->t02m->t02t01($t01id);
		$this->template->set('data',$data);
		$this->template->set('t01',$t01);
		$this->template->set('dt01',$dt01);
		$this->template->set('t02',$t02);
		/*$data = array("t01id"=> $t01id,"dt01"=> $dt01,"t02"=> $t02);
		$table = $this->load->view('mainpage/main_menupage.php', $data, true);
		ajaxResponse();*/
		$this->template->render('main_menupage');
   	}
	
	
	/*function refresh_mainmenupage()
	{
		$t01id 	= $this->input->post('t01id');
		//$t0204 = $this->t02m->t02_aplikasi($idstaf);
		$table = $this->load->view('main_menupage.php', array("t01id" => $t01id), true);
		ajaxQuery("#tablefav")->html($table);
		//ajaxResponse();
	}*/	
    function fmodal_app()
	{
		//echo "sini";
		
		$t01id = $this->input->post("t01id");
		//ajaxAlert($t01id);
		$dt01 = $this->t01m->get_t01($t01id);	
		$t02 = $this->t02m->t02t01($t01id);		
		$table="";
		$data = array("t01id"=> $t01id,"dt01"=> $dt01,"t02"=> $t02);
		$table = $this->load->view('mainpage/modal_app.tpl.php', $data, true);
		$this->template->set("table",$table);
		//$this->template->set("warna2",$warna2);
		ajaxQuery("#tabapp")->html($table);
		ajaxResponse();
		//ajaxQuery("#myadd_modal")->html($table);
		//ajaxResponse();
	}
	
	
	function save_fav()
   	{
		
		$idstaf 	= $this->input->post('idstaf');
		$t02id      = $this->input->post('t02id');
		//$warna      = $this->input->post('warna');
		//ajaxAlert("hoho".$idstaf);exit;
		
		$warna2="";
		 //ajaxAlert($t02id);		
		//$dt04  = $this->t04_model->find_by(array('t04_idstaf' => $idstaf,'t02_id' => $t02id));
		$dt04 = $this->t02m->sen_t04($t02id,$idstaf);
		if (!empty($dt04->T04_ID))
		{
			 //$warna2 = "grey";
			 $this->t02m->del_t04($dt04->T04_ID);
			 ajaxQuery("#love_".$t02id)->html('<iconify-icon icon="solar:star-linear" class="fs-8 text-warning py-1 px-2 ms-auto"></iconify-icon>');
			// ajaxQuery("#love_".$t02id)->html($warna);
		} else {
		$id = $this->t02m->newid_t01();
		$dataupd = array(
			'T04_ID'    => $id+1,
			'T02_ID'    => $t02id,
			'T04_IDSTAF' => $idstaf
		);
		//$warna2 = "red";	
		$id =$this->t02m->insert_t04($dataupd);
		ajaxQuery("#love_".$t02id)->html('<iconify-icon icon="solar:star-bold" class="fs-8 text-warning py-1 px-2 ms-auto"></iconify-icon>');
		//ajaxQuery("#love_".$t02id)->html($warna2);
		//$result = $this->agent_model->update($id, $dataupd);
		}
		
		ajaxResponse();		
   	}
	
	function refreshlist()
	{
		$idstaf 	= $this->input->post('idstaf');
		$t0204 = $this->t02m->t02_aplikasi($idstaf);
		$table = $this->load->view('main_menupage.php', array("t0204" => $t0204), true);
		ajaxQuery("#tablefav")->html($table);
		ajaxResponse();
	}
	
	function refreshlist_fav()
	{
		$idstaf 	= $this->input->post('idstaf');
		$t0204 = $this->t02m->t02_aplikasi($idstaf);
		$table = $this->load->view('main_fav.php', array("t0204" => $t0204), true);
		ajaxQuery("#tablefav2")->html($table);
		ajaxResponse();
	}
	public function info_app()
   	{
   		//$this->auth->restrict($this->viewPermission);
		
		$this->template->render('info_app');
   	}
	public function info_app2()
   	{
   		//$this->auth->restrict($this->viewPermission);
		
		$this->template->render('info_app2');
   	}
	
	////////////////DUMMY LINK //////////////////////////////
	
	function opensys($t02id=""/*,$url=""*/)
	{
	
		
		$issuedAt   = new DateTimeImmutable();
		$expire     = $issuedAt->modify('+60 seconds')->getTimestamp();      // Add 60 seconds
		//$serverName = "gssp.umt.edu.my";

		$payloadArray = [
			'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
			//'iss'  => $serverName,                       // Issuer
			'nbf'  => $issuedAt->getTimestamp(),         // Not before
			'exp'  => $expire,                           // Expire
			'userName' => $_SESSION['UID'] // User name
		];
		$serverKey = 'xxx5f2b5cdbe5194f10b3241568fe4e2b24yyy';

		$token = JWT::encode(
			$payloadArray,
			$serverKey,
			'HS512'
		);
		//$url = $_GET['url'];
		$g_url = $this->t02m->get_url($t02id);
		
		
			$d = array (
			   "T11_NOKP"=> $_SESSION['icno'],
			   "T11_KEYSESSION"=>$token,
			   "T11_UID"=>$_SESSION['UID'],
			   "T11_URL"=>$g_url->T02_URL,
			   "T02_ID"=>$t02id);	
				$this->t02m->add_t11($d);
		
		//echo "huhu".$token;exit;
		$http =  (isset($_SERVER["REQUEST_SCHEME"] ) && $_SERVER["REQUEST_SCHEME"]=='https') ? 'https':'http';
		header("Location: $http://mynemov31.umt.edu.my/tmp_login.php?t=$token");
		exit;	
		//jQuery::evalScript('paparinfopointer()');
		//ajaxResponse();

	}
	/*function opensys()
	{
	//ajaxAlert("sini");
	//	ajaxResponse();	
		//$this->load->library('jwt');
		$nokp = $this->input->post("nokp");
		$url = $this->input->post("linkurl");
		$t02id = $this->input->post("t02id");

		
			$d = array (
			   "T11_NOKP"=> $nokp,
			   "T11_KEYSESSION"=>$_SESSION['tokenx'],
			   "T11_UID"=>$_SESSION['UID'],
			   "T11_URL"=>$url,
			   "T02_ID"=>$t02id);	
				$this->t02m->add_t11($d);
			
		jQuery::evalScript('paparinfopointer()');
		ajaxResponse();

	}*/
	
	function opensys_todo($id = null)
	{
		
		$g_url = $this->t02m->get_todourl($id);
		
			//$url= $_GET['url'];
		//echo "huhu".$url;exit;
		
		if ($g_url->T02_PLATFORM=='8')
		{ 
			echo "<div style='display: flex; justify-content: center;'>
					<iframe class='embed-responsive-item' src='".$g_url->T02_URL."' scrolling='yes' style='height: 800px; min-width:100%' width='100%' height='100%' frameborder='0'></iframe>
			";
		} else{
			
		$issuedAt   = new DateTimeImmutable();
		$expire     = $issuedAt->modify('+15 seconds')->getTimestamp();      // Add 60 seconds

		$payloadArray = [
			'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
			'nbf'  => $issuedAt->getTimestamp(),         // Not before
			'exp'  => $expire,                           // Expire
			'userName' => $_SESSION['UID'] // User name
		];
		$serverKey = 'xxx5f2b5cdbe5194f10b3241568fe4e2b24yyy';

		$token = JWT::encode(
			$payloadArray,
			$serverKey,
			'HS512'
		);
			$d = array (
			   "T11_NOKP"=> $_SESSION['icno'],
			   "T11_KEYSESSION"=>$token,
			   "T11_UID"=>$_SESSION['UID'],
			   "T11_URL"=>$g_url->T02_URL,
			   "T02_ID"=>$g_url->T02_ID);	
				$this->t02m->add_t11($d);
		
			//jQuery::evalScript('window.location.href=http://192.168.20.101/tmp_login.php?t='.$_SESSION['tokenx']);
		//jQuery::evalScript('todoinfopointer()');
			$http =  (isset($_SERVER["REQUEST_SCHEME"] ) && $_SERVER["REQUEST_SCHEME"]=='https') ? 'https':'http';
			Redirect("$http://mynemov31.umt.edu.my/tmp_login_todo.php?t=".$token);
		ajaxResponse();
	  }
	}
	public function get_lang()
    {
       
		$session_lang = get_lang_sis();
		if($session_lang == "en"){
			
			$set_lang_cms = "en";
			$array = array("rslt_lang"  =>  $set_lang_cms );
			$session_lang = $set_lang_cms;
			
		}else{
			
			$set_lang_cms = "ms";
			$array = array("rslt_lang"  =>  $set_lang_cms );
			$session_lang = $set_lang_cms;	
		}
		
		if($session_lang == "en")
		{ 	
	
			
			$this->lang->load('mainpage_en');	
			
		}else{ 
		
			
			$this->lang->load('mainpage_my');
			
		}
		//return $session_lang;
		//$data = $this->personel_model->personel( $_SESSION['icno'] )->row_array();
		$this->template->set('session_lang',$session_lang);
		//$this->template->render('get_lang');
    }
	public function lang_pick()
	{		
		
		$this->userData = $this->session->userdata( "app_session" );
		//var_dump($this->userData);exit;
		//echo "langpick=".$_POST['dataLang'];exit;
		$set_lang_cms = $_POST['dataLang'];
		$session_lang = $set_lang_cms;
		
		$array = array( "rslt_lang"  =>  $set_lang_cms );
        $this->userData = $array;
		$this->session->set_userdata( 'app_session', $this->userData );
		
	}
	function test()
	{
		$language = $this->get_lang();
		$this->template->set('app_session',$language);
		$this->template->render('test');
	}
	
	public function t_menu()
   	{
   		//$this->auth->restrict($this->viewPermission);
		
		$this->template->render('t_menu');
   	}
	
	
}