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

class Todo extends Front_Controller {
    
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

	  public function main_todo()
   	{
   		  //$this->auth->restrict($this->viewPermission);
		    $data = $this->auth->userdata();
		    $t0204 = $this->t02m->t02_aplikasi($data->IDSTAF);
		    $t01 = $this->t01m->t01_group();
		    $this->template->set('t01',$t01);
		    $this->template->set('t0204',$t0204);
		    $this->template->set('data',$data);
		    $this->template->render('main_todo');
   	}
	
	  function todogen($ic=null)
	  {
		    $display = false;
			
		
		    $json = array("display" => ($display) ? "Y" : "N",  "sistem"=> $array_sistem, "todo" => $html_pra);
		
		    if ($display)
		    {
			      $_SESSION["todo"] = $_SESSION["todo"].$html_pra;
		    }
		  	/*else
			{
				$_SESSION["todo"] = $html_pra;
			}*/
	
		    //$_SESSION["todo"] = "bewok";
		    echo json_encode($json);
	  }
    
	function todo_reload()
    {
			unset($_SESSION['todo']);
			//ob_clean();
    }
    
	function getTodoFromSession()
    {
        if(isset( $_SESSION['todo'] ))
             $json = array( "todo" => $_SESSION['todo'] );
             
        echo json_encode( $json );
    }
	
	/*function refreshtodo()
	{
		$idstaf 	= $this->input->post('idstaf');
		$t0204 = $this->t02m->t02_aplikasi($idstaf);
		//$table = $this->load->view('main_menupage.php', array("t0204" => $t0204), true);
		ajaxQuery("#tabletodo")->html($table);
		//ajaxResponse();
	}*/
/*	
	function todogen_icon($ic=null)
	{
		$tab = $this->input->post("tab");
		if($ic == "")
		{
			$json = array("display" => 'E');
			echo json_encode($json);
			exit;
		}
		
		$this->load->database('smsportal');
		$display = false;
		
		$stid = $this->db->get_cursor(); 
		$stid2 = $this->db->get_cursor(); 
		
		$server_info = 'SERVERHOST:'.gethostname().'|IP:'.$_SERVER["REMOTE_ADDR"]. '|SERVERIP:'.$_SERVER["SERVER_ADDR"];
		if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])) $server_info .= 'HTTP_X_FORWARDED_FOR: '.$_SERVER["HTTP_X_FORWARDED_FOR"];
		
        $params2=array
		(
			array('name'=>':p_idstaf', 		'value'=>$ic, 			'type'=>SQLT_CHR, 		'length'=>99),
			array('name'=>':p_session', 	'value'=>session_id(), 	'type'=>SQLT_CHR, 		'length'=>99),
			array('name'=>':p_server_host', 'value'=>$server_info, 	'type'=>SQLT_CHR, 		'length'=>99),
			array('name'=>':p_recordset', 	'value'=>&$stid, 		'type'=>OCI_B_CURSOR, 	'length'=>-1),
			array('name'=>':p_nama_sistem', 	'value'=>&$stid2, 		'type'=>OCI_B_CURSOR, 	'length'=>-1),
			array('name'=>':p_tab', 		'value'=>$tab, 			'type'=>SQLT_CHR, 		'length'=>99)
		);
		
				
        $haha = $this->db->stored_procedure("UP_PORTAL.TODO","TODO_ALL" ,$params2);
		
		oci_execute($stid);
		oci_execute($stid2);
		
		$array = array();
		$array_sistem = array();
		$html_pra = "";
		$display = false;
		
		while ($row1 = oci_fetch_object($stid)) 
		{
			$array[] = array(
				"app" 		=>	$row1->T01_NM_MODULE, 		
				"mesej" 	=>	$row1->MESEJ,
				"url"		=>	$row1->URL,
				"hide_url"  =>  $row1->HIDE_URL,
				"t02id_todo"  =>  $row1->T02_ID,
			);
		 
		
		}
	
		  
		while ($row = oci_fetch_object($stid2)) 
		{
			$display = true;			
			$array_sistem[] = $row->KOD_SISTEM;	
			

			$html_pra .= "
							<div class='dropdown-item'>
						   		<div class='media'>
									<div class='media-body'>
										<h3 class='dropdown-item-title'><strong>".$row->KOD_SISTEM."</strong></h3>
						  ";
			
			
			
			foreach($array as $td)
			{					
				if ($row->KOD_SISTEM == $td["app"]) 
				{
					$link = base_url()."mainpage/opensys_todo/".$td["t02id_todo"];
					$btn_url = ($td["hide_url"] == "1") ? "<p class='text-sm'> ".$td["mesej"]."</p></a><div class='dropdown-divider'></div>" : "<a href='".$link."'><p class='text-sm'> ".$td["mesej"]."</p></a><div class='dropdown-divider'></div>";
					$html_pra .= $btn_url;	
					//$html_pra .= "<a href='".$btn_url."'><p class='text-sm'> ".$td["mesej"]."</p></a><div class='dropdown-divider'></div>";	
				}
			}
			$html_pra .= "</div></div></div>";	
			
		}
		
		$json = array("display" => ($display) ? "Y" : "N",  "sistem"=> $array_sistem, "todo" => $html_pra);
		
		echo json_encode($json);
		
	}
	
	function todogen_count($ic=null)
	{
		if($ic == "")
		{
			$json = array("display" => 'E');
			echo json_encode($json);
			exit;
		}
		$stid=0;
		$this->load->database('smsportal');
		$display = false;
		
		
		$server_info = 'SERVERHOST:'.gethostname().'|IP:'.$_SERVER["REMOTE_ADDR"]. '|SERVERIP:'.$_SERVER["SERVER_ADDR"];
		if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])) $server_info .= 'HTTP_X_FORWARDED_FOR: '.$_SERVER["HTTP_X_FORWARDED_FOR"];
		
        $params2=array
		(
			array('name'=>':p_idstaf', 		'value'=>$ic, 			'type'=>SQLT_CHR, 		'length'=>99),
			array('name'=>':p_session', 	'value'=>session_id(), 	'type'=>SQLT_CHR, 		'length'=>99),
			array('name'=>':p_server_host', 'value'=>$server_info, 	'type'=>SQLT_CHR, 		'length'=>99),
			array('name'=>':p_todo_count', 	'value'=>&$stid, 		'type'=>SQLT_INT, 	'length'=>99)
		);
		
				
        $haha = $this->db->stored_procedure("UP_PORTAL.TODO","TODO_COUNT" ,$params2);
		
		//oci_execute($stid);
		//oci_execute($stid2);
		
		$array = array();
		$array_sistem = array();
		$html_pra = "";
		$display = false;
		
		
		$stid = $stid-2;
		$html_pra .= "
		  
			<i class='far fa-bell'></i>
			<span class='badge badge-warning navbar-badge'>".$stid."</span>
		  ";
		
		
		$json = array("display" => ($display) ? "Y" : "N",  "sistem"=> $array_sistem, "todo" => $html_pra);
		
		echo json_encode($json);
		
	}*/
	
	/*function ssss()
	{
		print_r($_SESSION);exit;
	}
	*/
}
?>