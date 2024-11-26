<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * @author Cokeshome
 * @copyright Copyright (c) 2016, Cokeshome
 * 
 * This is model class for table "supplier"
 */

class Personel_model extends CI_Model
{
public function __construct()
    {
        parent::__construct();
		$this->load->database();
    }

    /**
     * @var string  User Table Name
     */
    //protected $table_name = 'personel';
    //protected $key        = 'nokp_baru';

    /**
     * @var bool Set the created time automatically on a new record (if true)
     */
    protected $set_created = true;

    /**
     * @var bool Set the modified time automatically on editing a record (if true)
     */
    protected $set_modified = false;
    /**
     * @var string The type of date/time field used for $created_field and $modified_field.
     * Valid values are 'int', 'datetime', 'date'.
     */
    /**
     * @var bool Enable/Disable soft deletes.
     * If false, the delete() method will perform a delete of that row.
     * If true, the value in $deleted_field will be set to 1.
     */
    protected $soft_deletes = true;

    protected $date_format = 'datetime';
	
	
    function personel( $nokp )
    {
		$query = $this->db
			->select("NAMA, NOKP NOKP_BARU, ID_WARGA IDSTAF")
			->select("JANTINA")
			->where("NOKP", $nokp)
			->get("WARGA_UMT");
			
		return $query->row();	
    }
	
	
	
	
	function Create_User_Profile( $ic )
    {	
		$query = $this->db
			->select("WARGA_UMT.*")
			->select("NOKP NOKP_BARU")
			->select("KOD_PROGRAM_GRED GRED")
			->select("FAK_TMPT_KERJA TEMPAT_KERJA")
			->where("ID_WARGA", $ic)
			->get("WARGA_UMT");
		return $query->row();
            
    }
	
	
	
	function t01_group()
    {
        
        $query = $this->db->query("select t01_id,t01_nama,t01_kategori,t01_icon
                FROM up_portal.t01_group 
				WHERE t01_status='A'
				order by t01_id asc");
        
		//$result= $query->result();
        return $query;
    }
	
	
    
	function check_profile($ic)
	{
		$data = $this->db->where("ID_WARGA", $ic)
			->get("WARGA_UMT");
		
		return ($data->num_rows()> 0 ) ? true : false;		
		
	}
}
