<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * @author Cokeshome
 * @copyright Copyright (c) 2016, Cokeshome
 * 
 * This is model class for table "supplier"
 */

class Todo_model extends CI_Model
{

    /**
     * @var string  User Table Name
     */
    protected $db_con 			= 'todo';
    protected $table_name 		= 'APP_T01_MODULES';
    protected $key        		= 'T01_ID';
	
	protected $auto_increment_id = true;
    protected $sequence_auto_id = 'TDG_TB_MENU_SEQ';
    

    /**
     * @var bool Set the created time automatically on a new record (if true)
     */
    protected $log_user  = false;
	
    protected $set_created = false;
	protected $created_field = "";

    /**
     * @var bool Set the modified time automatically on editing a record (if true)
     */
    protected $set_modified = false;
	protected $modified_field = "";
    /**
     * @var string The type of date/time field used for $created_field and $modified_field.
     * Valid values are 'int', 'datetime', 'date'.
     */
    /**
     * @var bool Enable/Disable soft deletes.
     * If false, the delete() method will perform a delete of that row.
     * If true, the value in $deleted_field will be set to 1.
     */
    protected $soft_deletes = false;
	protected $deleted_field = "";
	protected $deleted_on_field = "";

    protected $date_format = 'datetime';

    /**
     * Function construct used to load some library, do some actions, etc.
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->database('todo');
    }
	

}
