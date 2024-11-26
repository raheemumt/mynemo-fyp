<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author CokesHome
 * @copyright Copyright (c) 2015, CokesHome
 * 
 * This is controller for Users Management
 */

class Team extends Admin_Controller {
    
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
        $this->lang->load('teams');
        $this->load->model(array('users/users_model',
                                ['users/teams_model' =>'groups_model'],
                                'users/user_groups_model',
                                'users/permissions_model',
                                'users/user_permissions_model'
                                ));

        $this->template->page_icon('fa fa-users');
        
    }

    public function index()
    {
        $this->auth->restrict($this->viewPermission);

        if(isset($_POST['delete']) && has_permission($this->deletePermission))
        {
            $checked = $this->input->post('checked');

            if (is_array($checked) && count($checked))
            {
                $result = FALSE;
                $sukses = 0;
                foreach ($checked as $pid)
                {
                    $result      = $this->groups_model->delete($pid);

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

        $where= "deleted = 0 AND
                    (`ket` LIKE '%$search2%' ESCAPE '!'
                   )";
        
        $total = $this->groups_model
                    ->where($where)
                    ->count_all();

        $offset = $this->input->get('per_page');

        $limit = $this->config->item('list_limit');

        $this->pager['base_url']            = current_url().$filter;
        $this->pager['total_rows']          = $total;
        $this->pager['per_page']            = $limit;
        $this->pager['page_query_string']   = TRUE;

        $this->pagination->initialize($this->pager);

        $data = $this->groups_model->select("teams.*")
                    ->where($where)
                    ->order_by('nm_group','ASC')
                    ->limit($limit, $offset)->find_all();

        $this->template->set('results', $data);
        $this->template->set('search', $search);

        $this->template->title(lang('teams_manage_title'));
        $this->template->set("numb", $offset+1);
        $this->template->render('team_index'); 
       
    }

    public function create()
    {
        $this->auth->restrict($this->addPermission);

        if(isset($_POST['save']))
        {
            if($this->save_group())
            {
                $this->template->set_message(lang('users_create_success'),'success');
                redirect('users/team/');
            }
        }

        $this->template->title(lang('teams_new_title'));
        $this->template->page_icon('fa fa-user');
        $this->template->render('team_form');
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
            if($this->save_group("update", $id))
            {
                $this->template->set_message(lang('users_edit_success'),'success');
            }
        }

        $data = $this->groups_model->find($id);

        if($data)
        {
            if($data->deleted == 1)
            {
                $this->template->set_message(lang('users_already_deleted'), 'error');
                redirect('users/setting');
            }
        }

        $this->template->set('data', $data);
        $this->template->title(lang('teams_edit_title'));
        $this->template->page_icon('fa fa-user');
        $this->template->render('team_form');
    }

    protected function save_group($type = 'insert', $id = 0)
    {
        if($type == "insert")
        {
            
            $extra_rule = "|unique[groups.nm_group]";
        }
        else
        {
            $_POST['id_group'] = $id;
            $extra_rule = "|unique[groups.nm_group, groups.id_group]";
        }

        $this->form_validation->set_rules('nm_group', 'lang:teams_nmgroup', 'required'.$extra_rule);
        

        $this->form_validation->set_rules('ket','lang:teams_ket','required');

        if($this->form_validation->run($this) === FALSE)
        {
            $this->template->set_message(validation_errors(),'error');
            return FALSE;
        }

        $nm_group   = $this->input->post('nm_group');
        $ket   = $this->input->post('ket');
        $email      = $this->input->post('email');
        $nm_lengkap = $this->input->post('nm_lengkap');
        $alamat     = $this->input->post('alamat');
        $kota       = $this->input->post('kota');
        $hp         = $this->input->post('hp');
        $st_aktif   = $this->input->post('st_aktif');



        if($type=='insert')
        {
            $data_insert = array(
                        'nm_group' => $nm_group,
                        'ket' => $ket,
                        'st_aktif' => $st_aktif
                        );

            $result = $this->groups_model->insert($data_insert);

            if($result)
            {
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
            $data_insert = array(
                        'nm_group' => $nm_group,
                        'ket'    => $ket,
                        'st_aktif' => $st_aktif
                        );
            
            
            $result = $this->groups_model->update($id, $data_insert);

            if($result)
            {
                return TRUE;
            }
            else
            {
                $this->template->set_message(lang('users_edit_fail').$this->users_model->error,'error');
                return FALSE;
            }
        }    
    }

    public function ahli($id_team)
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
                    $result      = $this->users_model->update($pid,["id_team"=>NULL]);

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

        $where="users.deleted = 0 AND users.id_team = $id_team
		AND (`username` LIKE '%$search2%' ESCAPE '!'
                    OR `nm_lengkap` LIKE '%$search2%' ESCAPE '!'
                    OR `users`.`alamat` LIKE '%$search2%' ESCAPE '!'
                    OR `users`.`kota` LIKE '%$search2%' ESCAPE '!'
                    OR `users`.`hp` LIKE '%$search2%' ESCAPE '!')
                   ";
        
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

        $data = $this->users_model->select("users.*,groups.ket as nama_role")
					->join("groups","groups.id_group=users.id_role", "LEFT")
					//->join("teams a","a.id_group=users.id_team", "LEFT")
                    ->where($where)
                    ->order_by('nm_lengkap','ASC')
                    ->limit($limit, $offset)->find_all();
					

        $this->template->set('results', $data);
        $this->template->set('search', $search);
        $this->template->set('id_team', $id_team);
		$this->template->set('isadmin', ($role==1)?true:false);
		
        $this->template->title(lang('agent_list'));
        $this->template->set("numb", $offset+1);
        $this->template->render('team_ahli'); 
       
    }
	
	public function listagent($id_team='')
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
                    $result      = $this->users_model->update($pid,["id_team"=>$id_team]);

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
                    $this->template->set_message(lang('agent_add_success') .'.', 'success');
					redirect(site_url("users/team/ahli/".$id_team));
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

        $where="users.deleted = 0 and users.id_role in (4)
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
                    ->order_by('id_role, nm_lengkap','ASC')
                    ->limit($limit, $offset)->find_all();
					

        $this->template->set('results', $data);
        $this->template->set('search', $search);
		$this->template->set('isadmin', ($role==1)?true:false);
		
        $this->template->title(lang('agent_directory'));
        $this->template->set("numb", $offset+1);
        $this->template->render('team_listagent'); 
       
    }


}