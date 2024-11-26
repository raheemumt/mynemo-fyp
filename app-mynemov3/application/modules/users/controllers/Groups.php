<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author CokesHome
 * @copyright Copyright (c) 2015, CokesHome
 * 
 * This is controller for Users Management
 */

class Groups extends Admin_Controller {
    
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
        $this->lang->load(['teams','groups']);
        $this->load->model(array('users/users_model',
                                'users/groups_model',
                                'users/user_groups_model',
                                'users/permissions_model',
                                'users/user_permissions_model',
                                'users/groups_permissions_model'
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

                    simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
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
                    (`nm_group` LIKE '%$search2%' ESCAPE '!'
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

        $data = $this->groups_model->select("groups.*")
                    ->where($where)
                    ->order_by('nm_group','ASC')
                    ->limit($limit, $offset)->find_all();

        $this->template->set('results', $data);
        $this->template->set('search', $search);

        $this->template->title(lang('groups_manage_title'));
        $this->template->set("numb", $offset+1);
        $this->template->render('group_index'); 
       
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

    public function default_select($val)
    {
        return $val == "" ? FALSE : TRUE;
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
                $this->template->set_message(lang('groups_permission_edit_success'), 'success');
            }
        }

        //User data
        $data = $this->groups_model->find($id);

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
        $this->template->render('group_permissions');
    }
	
	protected function save_permission($id_group = 0)
    {
        if($id_group == 0 || $id_group == "")
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
                                'id_group' => $id_group,
                                'id_permission' => $idp
                                );
            }
        }

        //Delete Fisrt All Previous user permission
        $result = $this->groups_permissions_model->delete_where(array('id_group' => $id_group));

        //Insert New one
        if($insert_data)
        {
            $result = $this->groups_permissions_model->insert_batch($insert_data);
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
        $role_permissions = $this->groups_permissions_model->select("permissions.*")
                                            //->join("user_groups","users.id_user = user_groups.id_user")
                                            //->join("group_permissions","user_groups.id_group = group_permissions.id_group")
                                            ->join("permissions","group_permissions.id_permission = permissions.id_permission")
                                            ->where("id_group", $id)
                                            ->find_all();

        // $user_permissions = $this->users_model->select("permissions.*")
                                            // ->join("user_permissions","users.id_user = user_permissions.id_user")
                                            // ->join("permissions","user_permissions.id_permission = permissions.id_permission")
                                            // ->where("users.id_user", $id)
                                            // ->find_all();

        $merge = array();
        if($role_permissions)
        {
            foreach ($role_permissions as $key => $rp) {
                if(!isset($merge[$rp->id_permission]))
                {
                    // $rp->is_role_permission = 1;
                    $merge[$rp->id_permission] = $rp;
                }
            }
        }

        // if($user_permissions)
        // {
            // foreach ($user_permissions as $key => $up) {
                // if(!isset($merge[$up->id_permission]))
                // {
                    // $up->is_role_permission = 0;
                    // $merge[$up->id_permission] = $up;
                // }
            // }
        // }

        return $merge;
    }
}