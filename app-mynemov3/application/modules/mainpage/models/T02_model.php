<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * @author CokesHome
 * @copyright Copyright (c) 2015, CokesHome
 * 
 * This is model class for table "users"
 */

class T02_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
   // protected $table_name = 't02_aplikasi';
   // protected $key        = 't02_id';
	
	
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

    function t02_aplikasi($idstaf)
    {
            
        $query = $this->db->query("select t02_aplikasi.T02_ID, T02_NAMA_APP, T02_STATUS, T02_PTJOWNER, T02_KETERANGAN, T01_ID, 
				T02_ICON, T02_LEVEL_ACCESS, T02_URL, T02_SHORTNAME,T02_LOGIN,T02_QUERYMENU,T02_PLATFORM
                FROM up_portal.t02_aplikasi
				join up_portal.t04_fav on t04_fav.t02_id = t02_aplikasi.t02_id
				where t04_idstaf='$idstaf'
				order by t02_aplikasi.t02_id asc");
        
        return $query;
    }
	
	 function t02_aplikasifav($idstaf,$t01id)
    {
            
        $query = $this->db->query("select t02_aplikasi.T02_ID, T02_NAMA_APP, T02_STATUS, T02_PTJOWNER, T02_KETERANGAN, T01_ID, 
				T02_ICON, T02_LEVEL_ACCESS, T02_URL, T02_SHORTNAME,T02_LOGIN,T02_QUERYMENU,T02_PLATFORM
                FROM up_portal.t02_aplikasi
				join up_portal.t04_fav on t04_fav.t02_id = t02_aplikasi.t02_id
				where t04_idstaf='$idstaf'
				and t02_aplikasi.t01_id='$t01id' 
				order by t02_aplikasi.t02_id asc");
        
        return $query;
    }
	
	function t02_aplikasi_iconcolor($idstaf)
    {
        $sql = "select t02_aplikasi.T02_ID, T02_NAMA_APP, T02_STATUS, T02_PTJOWNER, T02_KETERANGAN, t02_aplikasi.T01_ID, 
				T02_ICON, T02_LEVEL_ACCESS, T02_URL, T02_SHORTNAME,T02_LOGIN,T02_QUERYMENU,T02_PLATFORM,
                t01_group.T01_ICON, t01_group.T01_ICON_COLOUR
                FROM up_portal.t02_aplikasi
                join up_portal.t01_group on t01_group.t01_id = t02_aplikasi.t01_id
				join up_portal.t04_fav on t04_fav.t02_id = t02_aplikasi.t02_id
				where t04_idstaf='$idstaf'
				order by t02_aplikasi.t02_id asc";
				
        $query = $this->db->query($sql);
        
        return $query;
    }
	
	function t02t01($t01id)
    {
            
       $query = $this->db->query("select t02_aplikasi.T02_ID, T02_NAMA_APP, T02_STATUS, T02_PTJOWNER, T02_KETERANGAN, 
	   			t02_aplikasi.T01_ID, T02_ICON, T02_LEVEL_ACCESS, T02_URL, T02_SHORTNAME,T02_LOGIN,T02_QUERYMENU,T02_PLATFORM
                FROM up_portal.t02_aplikasi
				join up_portal.t01_group on t01_group.t01_id = t02_aplikasi.t01_id
				where t02_aplikasi.t01_id='$t01id'
				and t02_aplikasi.t02_status='A'
				order by t02_aplikasi.t02_id asc");
        
       return $query;
    }
	function get_t03($t02id)
    {
            
       $query = $this->db->query("select a.nama, b.t03_notel
              from personel a
              join up_portal.t03_support_user b on b.t03_nokp = a.nokp_baru
              where b.t02_id='$t02id'
			  order by t03_id asc");
			  
        
       return $query;
    }
	
	function t04_count($t02id,$idstaf)
    {
            
        $query = $this->db->query("select count(T04_ID) as jum
				from up_portal.t04_fav
				where t02_id = '$t02id'
				and t04_idstaf='$idstaf'")->row();
        
        return $query;
    }
	
	function sen_t04($t02id,$t04idstaf)
    {
            
        $query = $this->db->query("select T04_ID
				from up_portal.t04_fav
				where t02_id = '$t02id'
				and t04_idstaf='$t04idstaf'")->row();
        
        return $query;
    }
	
	function get_t01t04($t04idstaf)
    {
            
       $query = $this->db->query("select distinct a.t01_id,a.t01_icon,a.t01_nama_bi,a.t01_jujukan,a.t01_icon_colour
                from t01_group a
                join t02_aplikasi b on b.t01_id = a.t01_id
                join t04_fav c on c.t02_id = b.t02_id
                where c.t04_idstaf='$t04idstaf'
				order by a.t01_jujukan asc");
			         
       return $query;
    }
	function newid_t01()
	{
		$query = $this->db->query('SELECT MAX(T04_ID) ID FROM UP_PORTAL.T04_FAV')->row();		
		return $query->ID;
	}
	
	function insert_t04($data)
	{		
		//$this->db->insert('up_portal.T04_FAV', $data);
		if(( $dtls = $this->db->insert( "UP_PORTAL.T04_FAV", $data )) !== false )
            return true;
        else
            return false;
	}
	
	function del_t04($t04id)
	{  
		$this->db->where('T04_ID', $t04id);
		$this->db->delete('UP_PORTAL.T04_FAV');
	}
	
	function sen_t07()
    {
            
        $query = $this->db->query("select *
				from up_portal.t07_infotajuk
				where t07_status='A'
				order by t07_id asc");
        
        return $query;
    }
	
	function get_t08($t07id)
    {
            
        $query = $this->db->query("SELECT T08_ID,T07_ID,T08_KETERANGAN,T08_STATUS,nama,sms_singkatan
			  FROM up_portal.T08_INFOSUBTAJUK
			  join personel on nokp_baru = t08_nokpupdate
			  join tempat_kerja on tempat_kerja = kod
			  WHERE T07_ID='$t07id'
			  and t08_status='A'
			  order by t08_id asc");
        
        return $query;
    }
	function get_t09($t08id)
    {
            
        $query = $this->db->query("SELECT T09_ID,T09_STATUS,T09_TAJUKLINK,T09_LINK
			 FROM up_portal.T09_INFOLINK
			 WHERE T08_ID='$t08id'
			  and t09_status='A'
			  order by t09_id asc");
        
        return $query;
    }
	
	function get_url($id)
    {
            
        $query = $this->db->query("SELECT T02_PLATFORM, T02_URL,T02_NAMA_APP,T01_NAMA_BI
			 FROM T02_APLIKASI A
             JOIN T01_GROUP B ON B.T01_ID = A.T01_ID
			 WHERE T02_ID='$id'")->row();
        
        return $query;
    }
	
	function get_todourl($id)
    {
            
        $query = $this->db->query("SELECT A.T02_URL,C.T02_ID,C.T02_PLATFORM
			 FROM APP_T02_TODO A
             JOIN APP_T01_MODULES B ON B.T01_ID = A.T01_ID
             JOIN T02_APLIKASI C ON C.T02_ID = B.T01_PID
			 WHERE A.T02_ID='$id'")->row();
		
        
        return $query;
    }
	////////////////DUMMY LINK //////////////////////////////
	
	function add_t11($data)
	{		
		//$this->db->set('T11_DATEEXPIRE',"to_date('$masa','DD-MON-YYYY HH24:MI:SS')",false);
		$this->db->insert('T11_TMP_LOGIN', $data);
	}
	
	/*public function hapus_urusetia($id)
	{

		$query = $this->db->where('ID', $id)
						  ->delete('SETUP_PENGGUNA');
		return $query;
	}
	function updateUser( $data, $clause )
    {
        if(( $dtls = $this->db->update( "PROFIL_SARINGAN", $data, $clause )) !== false )
            return true;
        else
            return false;
    }
	*/
    
}