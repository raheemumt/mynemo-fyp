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

class App extends Nemo_Controller {
    
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
		//$this->load->library('app/auth');
		//$this->load->model("mainpage/t01_model","t01m");
		$this->load->model(array('mainpage/t01_model'=>'t01m',
								 'mainpage/t02_model'=>'t02m',
								 'users/personel_model'=>'per',
								 'app/app_model'=>'ap'));
    	
    	//$this->load->library('users/auth');
		$this->load->library('jquery');
		$this->load->helper(array('form', 'url'));
		//$this->load->library('form_validation');
    }
	
	public function index()
    {
		$nama = $this->input->post("nama");
		if( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ){ 
  			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];// your code here
			$ip1 = substr($ip,0,8);
	 		$ip2 = substr($ip,0,7);
		} else {
			$ip ="";
			$ip1 ="";
			$ip2 = "";
		}
        //$this->auth->t01_main();
		$t01 = $this->ap->t01_group();
		$data = $this->per->personel( $_SESSION['icno'] );
		// $covid = $this->per->cek_covid( $_SESSION['icno'] );
		// $wfh = $this->per->cek_wfh( $_SESSION['icno'] );
		// $ipmytime = $this->per->cek_ipmytime($ip1,$ip2);
		$capp = $this->ap->carian_app($nama);
		$this->template->set('capp',$capp);
		$this->template->set('t01',$t01);
		$this->template->set('data',$data);
		// $this->template->set('covid',$covid);
		// $this->template->set('wfh',$wfh);
		// $this->template->set('ipmytime',$ipmytime);
		$table="";
		$this->template->set("table",$table);
		$this->template->render('sen_aplikasi');
		
    }
	
	/*function sen_aplikasi($nama="")
	{
		$capp = $this->t02m->carian_app($nama);
		$this->template->set('capp',$capp);
		$this->template->render('sen_aplikasi');
	}*/

}