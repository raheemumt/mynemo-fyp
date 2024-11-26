<?php 

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Cokeshome
 * @copyright Copyright (c) 2016, Cokeshome
 * 
 * This is controller for Supplier
 */
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Test extends Base_Controller {
    
    /**
     * Load the models, library, etc
     *
     * 
     */
    //Permission
    protected $viewPermission   = "Supplier.View";
    protected $addPermission    = "Supplier.Add";
    protected $managePermission = "Supplier.Manage";
    protected $deletePermission = "Supplier.Delete";

    public function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
		//$this->load->model("mainpage/t01_model","t01m");
		$this->load->model(array('mainpage/t01_model'=>'t01m',
								 'mainpage/t02_model'=>'t02m',
								 'users/personel_model'=>'per'));
    	$this->load->model('todo/todo_model');
    	$this->load->library('users/auth');
		$this->load->library('jquery');
		$this->load->helper(array('form', 'url'));		
    }
	
	function info()
	{
		phpinfo();
	}
	
}
?>