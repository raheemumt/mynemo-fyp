<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors',1);
 ini_set('display_startup_errors',1);
 error_reporting(-1);
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
    	$this->load->library('users/auth');
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

    	//$identitas = $this->identitas_model->find(1);

    	if(isset($_POST['login']))
    	{
    		$username = $this->input->post('username');
    		$password = $this->input->post('password');

    		$this->auth->login($username, $password);
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

    public function logout()
    {
    	$this->auth->logout();
    }
}