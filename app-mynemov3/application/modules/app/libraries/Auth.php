<?php 


//if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This library for authentication user 
 */
class Auth
{
	protected $ci;
	protected $user;

	public function __construct()
	{
		
		$this->ci =& get_instance();
		$this->ci->load->database();
        $this->ci->load->library('session');
       // $this->ci->lang->load('users/users');
		$this->ci->load->model(array(['app/app_model' => 'ap']));
		//$this->ci->load->helper( 'url' );
		$this->ci->load->helper(array('form', 'url'));

	}

	

    public function t01_main()
    {
       
	    $group = $this->ci->ap->t01_group();
        return $group;
    }

	
}