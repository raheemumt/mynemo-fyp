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

class Langswitch extends Nemo_Controller {
    
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
		$this->load->helper('url');
		
    }
	
	function switchLanguage($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect(base_url());
    }

}