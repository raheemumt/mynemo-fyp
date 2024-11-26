<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author CokesHome
 * @copyright Copyright (c) 2015, CokesHome
 * 
 * This is controller for Users Management
 */

class Setting extends Front_Controller {
    
    /**
     * Load the models, library, etc
     *
     * 
     */

    //Permissions
    protected $viewPermission   = "Users.View";
    protected $addPermission    = "Users.Add";
    protected $managePermission = "Users.Manage";
    protected $deletePermission = "Users.Delete";

    public function __construct()
    {
    	parent::__construct();
        $this->lang->load('users');
        // $this->load->model(array('users/users_model',
			// 'users/groups_model',
			// 'users/teams_model',
			// 'users/bank_model',
			// ['users/attachment_model' => 'atth_model'],
			// ['users/user_attachment_model' => 'ua'],
			// 'users/role_model',
			// 'users/user_groups_model',
			// 'users/permissions_model',
			// 'users/user_permissions_model',
			// 'manage/parlimen_model',
			// 'manage/lookup_model'
			// ));

        $this->template->page_icon('fa fa-users');
        
    }
    
    public function loaderlookup()
    {
    	$this->load->helper("loc_helper");
    	$negeri = get_all_parlimen();
    	
    	foreach($negeri as $v)
    	{
    		$this->lookup_model->insert([
    			"t00_jenis"	=>	"PARLIMEN",
    			"t00_kod_parent"	=>	$v["negeri"],
    			"t00_kod"	=>	$v["kod"],
    			"t00_desc"	=>	$v["name"],
    		]);
    	}
    }

    public function index()
    {
        $this->auth->restrict($this->viewPermission);
		
		$role = $this->user_data->id_role;

        if(isset($_POST['delete']) && has_permission($this->deletePermission))
        {
            $checked = $this->input->post('checked');

            if (is_array($checked) && count($checked))
            {
                $result = FALSE;
                $sukses = 0;
                foreach ($checked as $pid)
                {
                    $result      = $this->users_model->delete($pid);

                    if($result)
                    {
                        $keterangan = "SUKSES, hapus data user dengan ID : ".$pid;
                        $status     = 1;

                        $sukses++;
                    }
                    else
                    {
                        $keterangan = "GAGAL, hapus data user dengan ID : ".$pid;
                        $status     = 0;
                    }

                    $nm_hak_akses   = $this->deletePermission; 
                    $kode_universal = $pid;
                    $jumlah         = 1;
                    $sql            = $this->db->last_query();

                    //simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
                }

                if ($result)
                {
                    $this->template->set_message(count($sukses) .' '. lang('users_del_success') .'.', 'success');
                }
                else
                {
                    $this->template->set_message(lang('users_del_fail') . $this->users_model->error, 'error');
                }
            }
            else
            {
                $this->template->set_message(lang('users_del_error'), 'error');
            }

            unset($_POST['delete']);
        }

        // Pagination
        $this->load->library('pagination');

        if(isset($_POST['table_search']))
        {
            $search = isset($_POST['table_search'])?$this->input->post('table_search'):'';
        }
        else
        {
            $search = isset($_GET['search'])?$this->input->get('search'):'';
        }

        $filter = "";
        if($search!="")
        {
            $filter = "?search=".$search;
        }

        $search2 = $this->db->escape_str($search);

        $where="users.deleted = 0
                    AND (`username` LIKE '%$search2%' ESCAPE '!'
                    OR `nm_lengkap` LIKE '%$search2%' ESCAPE '!'
                    OR `users`.`alamat` LIKE '%$search2%' ESCAPE '!'
                    OR `users`.`kota` LIKE '%$search2%' ESCAPE '!'
                    OR `users`.`hp` LIKE '%$search2%' ESCAPE '!'
                   )";
        
        $total = $this->users_model
                    ->where($where)
                    ->count_all();

        $offset = $this->input->get('per_page');

        $limit = $this->config->item('list_limit');

        $this->pager['base_url']            = current_url().$filter;
        $this->pager['total_rows']          = $total;
        $this->pager['per_page']            = $limit;
        $this->pager['page_query_string']   = TRUE;

        $this->pagination->initialize($this->pager);

        $data = $this->users_model->select("users.*, groups.ket as nama_role, a.ket as nm_team")
					->join("groups","groups.id_group=users.id_role", "LEFT")
					->join("teams a","a.id_group=users.id_team", "LEFT")
                    ->where($where)
                    ->order_by('username,id_role, nm_lengkap','ASC')
                    ->limit($limit, $offset)->find_all();
					

        $this->template->set('results', $data);
        $this->template->set('search', $search);
		$this->template->set('isadmin', ($role==1)?true:false);
		
        $this->template->title(lang('users_manage_title'));
        $this->template->set("numb", $offset+1);
        $this->template->render('index'); 
       
    }

    public function create()
    {
        $this->auth->restrict($this->addPermission);

        if(isset($_POST['save']))
        {
            if($this->save_user())
            {
                $this->template->set_message(lang('users_create_success'),'success');
                redirect('users/setting');
            }
        }
	
        $dt_group = $this->teams_model->select("teams.*")
                    ->where("st_aktif = 1")
                    ->order_by('nm_group','ASC')
                    ->find_all();
					
		if($this->user_data->id_role != 1)
			$dt_role = $this->groups_model->format_dropdown("ket","id_group","id_group <> 1");
		else
			$dt_role = $this->groups_model->format_dropdown("ket");
		
		
		$dt_group = $this->teams_model->format_dropdown("ket");
		
		$this->template->set('groups', $dt_group);
		$this->template->set('roles', $dt_role);
		
        $this->template->title(lang('users_new_title'));
        $this->template->page_icon('fa fa-user');
        $this->template->render('users_form');
    }

    public function edit($id = 0)
    {
        $this->auth->restrict($this->managePermission);

        if($id == 0 || is_numeric($id) == FALSE)
        {
            $this->template->set_message(lang('users_invalid_id'), 'error');
            redirect('users/setting');
        }

        if(isset($_POST['save']))
        {
            if($this->save_user("update", $id))
            {
                $this->template->set_message(lang('users_edit_success'),'success');
            }
        }

        $data = $this->users_model->find($id);

        if($data)
        {
            if($data->deleted == 1)
            {
                $this->template->set_message(lang('users_already_deleted'), 'error');
                redirect('users/setting');
            }
        }
		
		if($this->user_data->id_role != 1)
			$dt_role = $this->groups_model->format_dropdown("ket","id_group","id_group <> 1");
		else
			$dt_role = $this->groups_model->format_dropdown("ket");
		
		$dt_group = $this->teams_model->format_dropdown("ket");
		
		$left = $this->load->view("users/users_form_left", ["id"=>$id,"data"=>$data], true);
		$this->template->set('left', $left);

		$this->template->set('groups', $dt_group);
		$this->template->set('roles', $dt_role);
	
        $this->template->set('id', $id);
        $this->template->set('data', $data);
		
        $this->template->title(lang('users_edit_title'));
        $this->template->page_icon('fa fa-user');
        $this->template->render('users_form');
    }

    public function permission($id = 0)
    {
        $this->auth->restrict($this->managePermission);

        if($id == 0 || is_numeric($id) == FALSE || $id == 1)
        {
            $this->template->set_message(lang('users_invalid_id'), 'error');
            redirect('users/setting');
        }

        if(isset($_POST['save']))
        {
            if($this->save_permission($id))
            {
                $this->template->set_message(lang('users_permission_edit_success'), 'success');
            }
        }

        //User data
        $data = $this->users_model->find($id);

        if($data)
        {
            if($data->deleted == 1)
            {
                $this->template->set_message(lang('users_already_deleted'), 'error');
                redirect('users/setting');
            }
        }
        //All Permission
        $permissions = $this->permissions_model
                                            ->order_by("nm_permission","ASC")
                                            ->find_all();

        $auth_permissions = $this->get_auth_permission($id);
        
        $rows   = array();
        $header = array();
        $tmp    = array();
        if($permissions)
        {
            //table Header
            foreach ($permissions as $key => $pr) {
                $x = explode(".", $pr->nm_permission);
                if(!in_array($x[1], $header))
                {
                    $header[] = $x[1];
                    $tmp[$x[1]] = 0;
                }
            }
            //Temporary value
            foreach ($permissions as $key2 => $pr) {
                $x = explode(".", $pr->nm_permission);
                $rows[$x[0]] = $tmp;
            }
            //Actual value
            foreach ($permissions as $key3 => $pr) {
                $x = explode(".", $pr->nm_permission);
                //Rows
                $rows[$x[0]][$x[1]] = array('perm_id' => $pr->id_permission,'action_name' => $x[1], 'is_role_permission' => (isset($auth_permissions[$pr->id_permission]->is_role_permission) && $auth_permissions[$pr->id_permission]->is_role_permission == 1) ? 1 : '','value' => (isset($auth_permissions[$pr->id_permission]) ? 1 : 0));
            }
        }

        $this->template->set('data', $data);
        $this->template->set('header', $header);
        $this->template->set('permissions', $rows);

        $this->template->title(lang('users_edit_perm_title'));
        $this->template->page_icon('fa fa-shield');
        $this->template->render('user_permissions');
    }

    protected function save_permission($id_user = 0)
    {
        if($id_user == 0 || $id_user == "")
        {
            $this->template->set_message(lang('users_invalid_id'), 'error');
            return FALSE;
        }

        $id_permissions = $this->input->post('id_permissions');

        $insert_data = array();
        if($id_permissions)
        {
            foreach ($id_permissions as $key => $idp) {
                $insert_data[] = array(
                                'id_user' => $id_user,
                                'id_permission' => $idp
                                );
            }
        }

        //Delete Fisrt All Previous user permission
        $result = $this->user_permissions_model->delete_where(array('id_user' => $id_user));

        //Insert New one
        if($insert_data)
        {
            $result = $this->user_permissions_model->insert_batch($insert_data);
        }

        if($result === FALSE)
        {
            $this->template->set_message(lang('users_permission_edit_fail'), 'error');
            return FALSE;
        }

        unset($_POST['save']);

        return $result;
    }

    protected function get_auth_permission($id = 0)
    {
        $role_permissions = $this->users_model->select("permissions.*")
                                            ->join("user_groups","users.id_user = user_groups.id_user")
                                            ->join("group_permissions","user_groups.id_group = group_permissions.id_group")
                                            ->join("permissions","group_permissions.id_permission = permissions.id_permission")
                                            ->where("users.id_user", $id)
                                            ->find_all();

        $user_permissions = $this->users_model->select("permissions.*")
                                            ->join("user_permissions","users.id_user = user_permissions.id_user")
                                            ->join("permissions","user_permissions.id_permission = permissions.id_permission")
                                            ->where("users.id_user", $id)
                                            ->find_all();

        $merge = array();
        if($role_permissions)
        {
            foreach ($role_permissions as $key => $rp) {
                if(!isset($merge[$rp->id_permission]))
                {
                    $rp->is_role_permission = 1;
                    $merge[$rp->id_permission] = $rp;
                }
            }
        }

        if($user_permissions)
        {
            foreach ($user_permissions as $key => $up) {
                if(!isset($merge[$up->id_permission]))
                {
                    $up->is_role_permission = 0;
                    $merge[$up->id_permission] = $up;
                }
            }
        }

        return $merge;
    }

    protected function save_user($type = 'insert', $id = 0)
    {
        if($type == "insert")
        {
            
            $extra_rule = "|unique[users.username]";
            //$rule_email = "|unique[users.email]";
        }
        else
        {
            $_POST['id_user'] = $id;
            $extra_rule = "|unique[users.username, users.id_user]";
            //$rule_email = "|unique[users.email, users.id_user]";
        }

        $this->form_validation->set_rules('username', 'lang:users_username', 'required'.$extra_rule);
        if($type == "insert")
        {
            $this->form_validation->set_rules('password','lang:users_password','required');
            $this->form_validation->set_rules('re-password','lang:users_repassword','required|matches[password]');
        }
        else
        {
            if(!empty($_POST['password']))
            {
                $extra_rule = "|unique[users.username]";
                $this->form_validation->set_rules('password','lang:users_password','required');
                $this->form_validation->set_rules('re-password','lang:users_repassword','required|matches[password]');
            }
        }

        //$this->form_validation->set_rules('email','lang:users_email','required|valid_email'.$rule_email);
        $this->form_validation->set_rules('email','lang:users_email','required|valid_email');
        $this->form_validation->set_rules('nm_lengkap','lang:users_nm_lengkap','required');
        $this->form_validation->set_rules('alamat','lang:users_alamat','required');
        $this->form_validation->set_rules('kota','lang:users_kota','required');
        $this->form_validation->set_rules('hp','lang:users_hp','required');
        $this->form_validation->set_rules('users_type','lang:users_type','required');
        $this->form_validation->set_rules('st_aktif','lang:users_st_aktif','required');

        if($this->form_validation->run($this) === FALSE)
        {
            $this->template->set_message(validation_errors(),'error');
            return FALSE;
        }

        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $email      = $this->input->post('email');
        $nm_lengkap = $this->input->post('nm_lengkap');
        $alamat     = $this->input->post('alamat');
        $kota       = $this->input->post('kota');
        $hp         = $this->input->post('hp');
        $st_aktif   = $this->input->post('st_aktif');
        $id_role   = $this->input->post('users_type');
        $id_team   = $this->input->post('user_group');

        /**
         * This code will benchmark your server to determine how high of a cost you can
         * afford. You want to set the highest cost that you can without slowing down
         * you server too much. 8-10 is a good baseline, and more is good if your servers
         * are fast enough. The code below aims for ≤ 50 milliseconds stretching time,
         * which is a good baseline for systems handling interactive logins.
         */
        $timeTarget = 0.05; // 50 milliseconds 

        // $cost = 8;
        // do {
            // $cost++;
            // $start = microtime(true);
            // password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
            // $end = microtime(true);
        // } while (($end - $start) < $timeTarget);
        // //End finding cost

        // $options = [
            // 'cost' => $cost,
            // 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
        // ];

        $password = password_hash($password, PASSWORD_BCRYPT);

		$data_insert = array(
				'username' => $username,
				
				'email'    => $email,
				'nm_lengkap' => $nm_lengkap,
				'alamat'   => $alamat,
				'kota'     => $kota,
				'hp'       => $hp,
				'ip'        => $this->input->ip_address(),
				'st_aktif' 	=>	$st_aktif,
				'id_role'	=>	$id_role,
				'id_team'	=>	$id_team,
				'ic'		=>	$this->input->post("ic"),
				'ig'		=>	$this->input->post("ig"),
				'fb'		=>	$this->input->post("fb"),
				'bank'		=>	$this->input->post("bank"),
				'bank_acc'		=>	$this->input->post("bank_acc"),
				'mula_kerja'		=>	$this->input->post("mula_kerja"),
				'bank_holder'		=>	$this->input->post("bank_holder"),
				'negeri'		=>	$this->input->post("negeri"),
				'parlimen'		=>	$this->input->post("parlimen"),
		);
		
		//$data_insert = $_POST;
		
        if($type=='insert')
        {
            $data_insert["password"] = $password;
			$result = $this->users_model->insert($data_insert);

            if($result)
            {
                
				$this->user_groups_model->insert([
						'id_user' => $result,
                        'id_group' => $id_role
				]);
				
				$this->upload_attach($result);
                return TRUE;
            }
            else
            {
                $this->template->set_message(lang('users_create_fail').$this->users_model->error,'error');
                return FALSE;
            }
        }
        else
        {
           
            if(!empty($_POST['password']))
            { 
                $data_insert['password'] = $password;
            }
            
            $result = $this->users_model->update($id, $data_insert);

            if($result)
            {
				$this->user_groups_model->delete_where(array('id_user' => $id));
				$this->user_groups_model->insert([
					'id_user' => $id,
					'id_group' => $id_role
				]);
				
				$this->upload_attach($id);
				
                return TRUE;
            }
            else
            {
                $this->template->set_message(lang('users_edit_fail').$this->users_model->error,'error');
                return FALSE;
            }
        }    
    }
	
	public function upload_attach($id)
	{
		$files = $_FILES["docs"]["name"];
				
		foreach($files as $i => $val)
		{
			$_FILES['file']['name']     = $_FILES['docs']['name'][$i];
			$_FILES['file']['type']     = $_FILES['docs']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['docs']['tmp_name'][$i];
			$_FILES['file']['error']     = $_FILES['docs']['error'][$i];
			$_FILES['file']['size']     = $_FILES['docs']['size'][$i];
			
			// File upload configuration
			$uploadPath = 'uploads/users/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			
			// Load and initialize upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			// Upload file to server
			if($this->upload->do_upload('file')){
				// Uploaded file data
				$fileData = $this->upload->data();
				$uploadData[$i]['file_name'] = $fileData['file_name'];
				$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
				$this->ua->delete_where("id_user=$id and kod_attachment=$i");
				$this->ua->insert([
					"id_user"	=>	$id,
					//"id_trip"	=>	$id,
					"nm_file"	=>	$uploadData[$i]['file_name'],
					"kod_attachment"	=>	$i
				]);
			}
		}	
	}

    public function default_select($val)
    {
        return $val == "" ? FALSE : TRUE;
    }
	
	public function user_password($id = 0)
    {
        $id = $this->user_data->id_user;

        if($id == 0 || is_numeric($id) == FALSE)
        {
            $this->template->set_message(lang('users_invalid_id'), 'error');
            redirect('users/setting');
        }

        if(isset($_POST['save']))
        {
			$this->form_validation->set_rules('password','lang:users_password','required');
			$this->form_validation->set_rules('re-password','lang:users_repassword','required|matches[password]');
            
			
			if($this->form_validation->run($this) === FALSE)
			{
				$this->template->set_message(validation_errors(),'error');
				//return FALSE;
			}
			else {
				
				
			/**
			 * This code will benchmark your server to determine how high of a cost you can
			 * afford. You want to set the highest cost that you can without slowing down
			 * you server too much. 8-10 is a good baseline, and more is good if your servers
			 * are fast enough. The code below aims for ≤ 50 milliseconds stretching time,
			 * which is a good baseline for systems handling interactive logins.
			 */
			// $timeTarget = 0.05; // 50 milliseconds 
	
			// $cost = 8;
			// do {
				// $cost++;
				// $start = microtime(true);
				// password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
				// $end = microtime(true);
			// } while (($end - $start) < $timeTarget);
			// //End finding cost
	
			// $options = [
				// 'cost' => $cost,
				// 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
			// ];
	
			$password = password_hash($this->input->post("password"), PASSWORD_BCRYPT);
				$result = $this->users_model->update($id, [
					"password"	=>	$password
				]);
                $this->template->set_message(lang('users_edit_success'),'success');
			}
			
        }

        $data = $this->users_model->find($id);

        $this->template->set('data', $data);
        $this->template->title(lang('users_change_pwd'));
        $this->template->page_icon('fa fa-user');
        $this->template->render('user_password');
    }
	
	public function user_edit($id = 0)
    {
        $id = $this->user_data->id_user;

        if($id == 0 || is_numeric($id) == FALSE)
        {
            $this->template->set_message(lang('users_invalid_id'), 'error');
            redirect('users/setting');
        }

        if(isset($_POST['save']))
        {
			$_POST['id_user'] = $id;
            $extra_rule = "|unique[users.username, users.id_user]";
            $rule_email = "|unique[users.email, users.id_user]";
			
			$this->form_validation->set_rules('username', 'lang:users_username', 'required'.$extra_rule);
			$this->form_validation->set_rules('email','lang:users_email','required|valid_email'.$rule_email);
			$this->form_validation->set_rules('nm_lengkap','lang:users_nm_lengkap','required');
			$this->form_validation->set_rules('alamat','lang:users_alamat','required');
			$this->form_validation->set_rules('kota','lang:users_kota','required');
			$this->form_validation->set_rules('hp','lang:users_hp','required');
            
			
			if($this->form_validation->run($this) === FALSE)
			{
				$this->template->set_message(validation_errors(),'error');
				//return FALSE;
			}
			else
			{
				
				$username   = $this->input->post('username');
				$password   = $this->input->post('password');
				$email      = $this->input->post('email');
				$nm_lengkap = $this->input->post('nm_lengkap');
				$alamat     = $this->input->post('alamat');
				$kota       = $this->input->post('kota');
				$hp         = $this->input->post('hp');
				$st_aktif   = $this->input->post('st_aktif');
				$id_role   = $this->input->post('users_type');
				$id_team   = $this->input->post('user_group');
				
				
				$result = $this->users_model->update($id, [
					'username' => $username,
					'email'    => $email,
					'nm_lengkap' => $nm_lengkap,
					'alamat'   => $alamat,
					'kota'     => $kota,
					'hp'       => $hp,
					'ip'        => $this->input->ip_address()
				]);
				
				
                $this->template->set_message(lang('users_edit_success'),'success');
			}
        }

        $data = $this->users_model->find($id);

		
		$dt_role = $this->groups_model->format_dropdown("ket");
		$dt_group = $this->teams_model->format_dropdown("ket");

		$this->template->set('groups', $dt_group);
		$this->template->set('roles', $dt_role);
        $this->template->set('data', $data);
        $this->template->title(lang('users_edit_title'));
        $this->template->page_icon('fa fa-user');
        $this->template->render('user_edit');
    }
	
	public function user_attachment($id="")
    {
        $this->auth->restrict($this->viewPermission);

        if(isset($_POST['delete']) && has_permission($this->deletePermission))
        {
            $checked = $this->input->post('docs');

            if (is_array($checked) && count($checked))
            {
                $result = FALSE;
                $sukses = 0;
                foreach ($checked as $pid)
                {
                    $result = true;

                    //simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
                }

                if ($result)
                {
                    $this->template->set_message(count($sukses) .' '. lang('users_uploads_docs_success') .'.', 'success');
                }
                else
                {
                    $this->template->set_message(lang('users_del_fail') . $this->users_model->error, 'error');
                }
            }
            else
            {
                $this->template->set_message(lang('users_del_error'), 'error');
            }

            unset($_POST['delete']);
        }

        // Pagination
        $this->load->library('pagination');

        if(isset($_POST['table_search']))
        {
            $search = isset($_POST['table_search'])?$this->input->post('table_search'):'';
        }
        else
        {
            $search = isset($_GET['search'])?$this->input->get('search'):'';
        }

        $filter = "";
        if($search!="")
        {
            $filter = "?search=".$search;
        }

        $search2 = $this->db->escape_str($search);

        $where= "deleted = 0 AND
                    (`nm_group` LIKE '%$search2%' ESCAPE '!'
                   )";
        

        $data = $this->atth_model->select("*")
					->join("user_attachments a", "a.kod_attachment=attachment.kod_attachment and a.id_user=$id","left")
                    ->where("attachment.status = 1")
                    ->order_by('attachment.sorting','ASC')
                    ->find_all();

        $this->template->set('results', $data);
        $this->template->set('search', $search);

        $this->template->title(lang('users_attachment_title'));
        //$this->template->set("numb", $offset+1);
        $this->template->render('user_attachment'); 
       
    }

    public function view($id = 0)
    {
        $this->auth->restrict($this->managePermission);

        if($id == 0 || is_numeric($id) == FALSE)
        {
            $this->template->set_message(lang('users_invalid_id'), 'error');
            redirect('users/setting');
        }

        if(isset($_POST['save']))
        {
            if($this->save_user("update", $id))
            {
                $this->template->set_message(lang('users_edit_success'),'success');
            }
        }

        $data = $this->users_model->find($id);

        if($data)
        {
            if($data->deleted == 1)
            {
                $this->template->set_message(lang('users_already_deleted'), 'error');
                redirect('users/setting');
            }
        }
		
		if($this->user_data->id_role != 1)
			$dt_role = $this->groups_model->format_dropdown("ket","id_group","id_group <> 1");
		else
			$dt_role = $this->groups_model->format_dropdown("ket");
		
		$dt_group = $this->teams_model->format_dropdown("ket");

		$this->template->set('groups', $dt_group);
		$this->template->set('roles', $dt_role);
	
        $this->template->set('id', $id);
        $this->template->set('data', $data);
		
        $this->template->title(lang('users_profile_title'));
        $this->template->page_icon('fa fa-user');
        $this->template->render('users_view');
    }
    
    public function removeattachment()
    {
    	$id_user = $this->input->post("user");
    	$id = $this->input->post("id");
    	$this->ua->delete($id);
    	jredirect(site_url("users/setting/edit/".$id_user));
    	jresponse();
    }
    
    public function get_parliment()
    {
    	$negeri = $this->input->post("negeri");
    	
    	$option = "";
    	if ($negeri != "0") {
			$parlimen = $this->lookup_model
				->where("t00_jenis = 'PARLIMEN' and t00_kod_parent='$negeri'")
				->order_by('t00_desc','ASC')
				->find_all();
		
			
			foreach($parlimen as $p)
			{
				$option .= '<option value="'.$p->t00_kod.'">'.$p->t00_desc.'</option>';
			}
        }
        
            
    	j("#parlimen")->html($option);
    	jresponse();
    }
	
	public function brabus()
	{ 
		$this->load->library('users/auth');
		
		foreach($_COOKIE as  $key => $val)
        {
          if (strpos($key,"shib") !== false) { echo "ada";
            setcookie($key,'', time() - 3600,'/');
          } else {
            // padam juga cookie hok lain
            setcookie($key,'', time() - 3600,'/');
          }
        }

		
        $this->session->sess_destroy();
		 //redirect('login');
		$form = "
		<iframe href='https://mynemov3.umt.edu.my/Shibboleth.sso/Logout'></iframe>
		"; 
		
		//echo $form;
		redirect("https://mynemov3.umt.edu.my/Shibboleth.sso/Logout");
		
		
	}

}