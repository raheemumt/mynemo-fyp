<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * @author CokesHome
 * @copyright Copyright (c) 2015, CokesHome
 * 
 * This is model class for table "users"
 */

class T01_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
		$this->load->database();
		
    }
    /**
     * @var string  User Table Name
     */
    //protected $table_name = 't01_group';
    //protected $key        = 't01_id';
	
	
    /**
     * @var string Field name to use for the created time column in the DB table
     * if $set_created is enabled.
     */
    protected $created_field = 'created_on';

    /**
     * @var string Field name to use for the modified time column in the DB
     * table if $set_modified is enabled.
     */
    protected $modified_field = 'modified_on';

    /**
     * @var bool Set the created time automatically on a new record (if true)
     */
    protected $set_created = TRUE;

    /**
     * @var bool Set the modified time automatically on editing a record (if true)
     */
    protected $set_modified = false;

    /**
     * @var bool Enable/Disable soft deletes.
     * If false, the delete() method will perform a delete of that row.
     * If true, the value in $deleted_field will be set to 1.
     */
    protected $soft_deletes = TRUE;

    /**
     * @var string The type of date/time field used for $created_field and $modified_field.
     * Valid values are 'int', 'datetime', 'date'.
     */
    protected $date_format = 'datetime';
    //--------------------------------------------------------------------

    /**
     * @var bool If true, will log user id in $created_by_field, $modified_by_field,
     * and $deleted_by_field.
     */
    protected $log_user = false;

    function t01_group()
    {
        
        $query = $this->db->query("select t01_id,t01_nama,t01_kategori,t01_icon, t01_nama_bi
                FROM up_portal.t01_group 
				WHERE t01_status='A'
				order by t01_jujukan asc");
        
		//$result= $query->result();
        return $query;
    }
	
	function get_t01($t01id)
    {
        
        $query = $this->db->query("select t01_id,t01_nama,t01_kategori,t01_icon,t01_nama_bi,T01_ICON_COLOUR
                FROM up_portal.t01_group 
				WHERE t01_status='A'
				and t01_id='$t01id'")->row();
        
		//$result= $query->result();
        return $query;
    }
	
	/*function personel( $nokp )
    {
		$query = $this->db->query("select nama,idstaf,nokp_baru,jawatan, gred
                FROM personel 
				join jawatan on jawatan.gred = personel.staf_gred and jawatan.jujukan = personel.jujukan
				WHERE nokp_baru = '" . $nokp . "'
				and status_aktif='Y'")->row();		
		return $query;
            
        
    }*/
	
    
}