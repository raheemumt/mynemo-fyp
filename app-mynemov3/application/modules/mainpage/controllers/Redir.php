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

class Redir extends Redir_Controller {
    
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
		$this->load->model(array('mainpage/t01_model'=>'t01m',
								 'mainpage/t02_model'=>'t02m',
								 'users/personel_model'=>'per'));
    	
		$this->load->library('jquery');
		$this->load->helper(array('form', 'url'));
		$this->load->library('jwt');
		//$this->load->library('form_validation');
    }

    public function index()
    {
        
		//$data = $this->personel_model->personel( $_SESSION['icno'] )->row_array();
		//$this->template->set('data',$data);
		
    }

    
	public function redirect( $id = null )
   	{
		
		//echo "sini";exit;
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
   	}
	
	
	////////////////DUMMY LINK //////////////////////////////
	
	function opensys($t02id=""/*,$url=""*/)
	{
	//echo "huhu".$t02id;exit;
		
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
		
		$http =  (isset($_SERVER["REQUEST_SCHEME"] ) && $_SERVER["REQUEST_SCHEME"]=='https') ? 'https':'http';
		header("Location: $http://mynemov31.umt.edu.my/tmp_login.php?t=$token");
		exit;	
		

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
		$expire     = $issuedAt->modify('+60 seconds')->getTimestamp();      // Add 60 seconds

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
		
			$http =  (isset($_SERVER["REQUEST_SCHEME"] ) && $_SERVER["REQUEST_SCHEME"]=='https') ? 'https':'http';
			Redirect("$http://mynemov31.umt.edu.my/tmp_login_todo.php?t=".$token);
		ajaxResponse();
	  }
	}
	
	
}