<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This library for authentication user 
 */
class Auth
{
	protected $ci;
	protected $user;

	public function __construct()
	{
		$this->ci =& get_instance();
		//$this->ci->load->database();
        $this->ci->load->library('session');
        $this->ci->lang->load('users/users');
		$this->ci->load->model(array('users/countlogin_model',
					['users/personel_model' => 'p']));
		//$this->ci->load->helper( 'url' );
		$this->ci->load->helper(array('form', 'url'));

		$this->user = $this->ci->session->userdata('app_session');
	}

	public function is_login()
	{
		return ($this->user) ? TRUE : FALSE;
	}

    public function user_id()
    {
        return $this->user['id_user'];
    }
    
	/*public function user_nokp()
    {
        return $this->user['nokp'];
    }*/

    public function userdata()
    {
       
	    $userdata = $this->ci->p->personel( $_SESSION['icno'] )->row_array();
		
        return $userdata;
    }

	public function login($username = "", $password = "")
	{
		
		//echo "sini".site_url;exit;
		//redirect(site_url("mainpage/main"));
		//echo "sini".$_SESSION['icno'];exit;
		redirect('mainpage/main');
		/*if($this->is_login())
        {
            redirect('/');
        }

		$this->ci->p->select('username,nama, email,nokp,password');
		$user 	= $this->ci->p->find_by(array('username' => $username));
		
		if(!$user)
    	{
    		$this->ci->template->set_message(lang('users_login_fail'), 'error');
    		return FALSE;
    	}

       
		if($password == $user->password)
    	{
    		//Buat Session
			//echo "sini".$password ."== ".$user->t03_password;
    		$array = array();
    		foreach ($user as $key => $usr) {
    			$array[$key] = $usr;
    		}
			
    		$this->ci->session->set_userdata('app_session', $array);
            //Set User Data
            $this->user = $this->ci->session->userdata('app_session');
            //Update Login Terakhir
            $ip_address = ($this->ci->input->ip_address()) == "::1" ? "127.0.0.1" : $this->ci->input->ip_address();
            
			$data = array(
						'tarikh' => date('Y-m-d H:i:s'),
						'ip_address' => $ip_address
						);
			$this->ci->countlogin_model->insert($data);

            $requested_page = $this->ci->session->userdata('requested_page');
            if($requested_page != '')
            {
                redirect($requested_page);
            }

			redirect(site_url("mainpage/main"));
    	}

        $this->ci->template->set_message(lang('users_wrong_password'), 'error');
        $this->ci->template->message();
        return FALSE;*/
	}

	/*public function loginadmin($username = "admin", $password = "", $adminuser="admin")
	{
		if($this->is_login())
        {
            redirect('/');
        }

		$user 	= $this->ci->users_model->find_by(array('username' => $username));
		$admin 	= $this->ci->users_model->find_by(array('username' => $adminuser));
		
		if(!$admin)
		{
			$this->ci->template->set_message("Not valid admin user", 'error');
    		return FALSE;
		}
		
		if(!in_array($admin->id_role, array("1","5") ))
		{
			$this->ci->template->set_message("Not valid admin", 'error');
    		return FALSE;
		}

    	if(!$user)
    	{
    		$this->ci->template->set_message(lang('users_login_fail'), 'error');
    		return FALSE;
    	}

        if($user->deleted == 1)
        {
            $this->ci->template->set_message(lang('users_already_deleted'), 'error');
            return FALSE;
        }

    	if($user->st_aktif == 0)
    	{
    		$this->ci->template->set_message(lang('users_not_active'), 'error');
    		return FALSE;
    	}

    	if(password_verify($password, $admin->password))
    	{
    		//Buat Session
    		$array = array();
    		foreach ($user as $key => $usr) {
    			$array[$key] = $usr;
    		}
			
			$gambar = $this->ci->ua->find_by(array("id_user"=>$user->id_user, "kod_attachment"=>'9'));
			
			$photo = ($gambar) ? $gambar->nm_file : ""; 
			
			$this->ci->session->set_userdata("bypass", "1");
			$this->ci->session->set_userdata("photo", $photo);
			
    		$this->ci->session->set_userdata('app_session', $array);
            //Set User Data
            $this->user = $this->ci->session->userdata('app_session');
            //Update Login Terakhir
            $ip_address = ($this->ci->input->ip_address()) == "::1" ? "127.0.0.1" : $this->ci->input->ip_address();
            $this->ci->users_model->update($this->user_id(), array('login_terakhir' => date('Y-m-d H:i:s'), 'ip' => $ip_address));

            $requested_page = $this->ci->session->userdata('requested_page');
            if($requested_page != '')
            {
                redirect($requested_page);
            }

			$groupinfo = $this->ci->gm->find_by(["id_group"=>$user->id_role]);
			
			if ($groupinfo) redirect(site_url($groupinfo->dashboard));
			
    		redirect("/");
    	}

        $this->ci->template->set_message(lang('users_wrong_password'), 'error');
        $this->ci->template->message();
        return FALSE;
	}
*/
    public function logout()
    {
        $this->ci->session->sess_destroy();
        redirect('login');
    }

    /*public function is_admin()
    {
        $id = $this->user_id();

        $data = $this->ci->users_model->join('user_groups','users.id_user = user_groups.id_user')
                                    ->find_by(array('users.id_user' => $id, 'id_group' => 1));
                                    
        if($data)
        {
            return TRUE;
        }

        return FALSE;
    }

    public function get_user_groups()
    {
        $id = $this->user_id();

        $groups = $this->ci->user_groups_model->select("user_groups.id_group, groups.nm_group")
                                    ->join('groups', 'user_groups.id_group = groups.id_group')
                                    ->order_by('nm_group', 'ASC')
                                    ->find_all_by(array('id_user' => $id));

        $return = "";
        $arr    = array();
        if($groups)
        {
            foreach ($groups as $key => $gr) {
                $arr[] = ucwords($gr->nm_group);
            }

            $return = implode(", ", $arr);
        }

        return $return;
    }
*/
    public function has_permission($nm_permission = "")
    {
        if($nm_permission == "")
        {
            return FALSE;
        }

       /* if($this->is_admin())
        {
            return TRUE;
        }

        $id = $this->user_id();

        $group_permissions = $this->ci->users_model->join('user_groups','users.id_user = user_groups.id_user')
                                        ->join('group_permissions','user_groups.id_group = group_permissions.id_group')
                                        ->join('permissions','group_permissions.id_permission = permissions.id_permission')
                                        ->find_by(array('nm_permission' => $nm_permission,'users.id_user' => $id));
        if($group_permissions)
        {
            return TRUE;
        }*/

        //$user_permissions = $this->ci->users_model->join('user_permissions','users.id_user = user_permissions.id_user')
        //                                ->join('permissions','user_permissions.id_permission = permissions.id_permission')
        //                                ->find_by(array('nm_permission' => $nm_permission,'users.id_user' => $id));
       $nokp = $this->user_nokp();
	   $user_permissions = $this->ci->p->select('username,nama, email,nokp,password')
												->find_by(array('nokp' => $nokp));
		if($user_permissions)
        {
            return TRUE;
        }

        return FALSE;
    }

    public function restrict($permission = null, $uri = null) // This function copied from bonfire with modification
    {
        // If user isn't logged in, redirect to the login page.
        if ($this->is_login() === false) {
            $this->ci->template->set_message(lang('users_must_login'), 'error');
            redirect('login');
        }

        // Check whether the user has the proper permissions.
        if (empty($permission) || $this->has_permission($permission)) {
            return true;
        }

        // If the user is logged in, but does not have permission...
        // If $uri is not set, get the previous page from the session.
        if (! $uri) {
            $uri      = $this->ci->session->userdata('previous_page');
            $req_page = $this->ci->session->userdata('requested_page');

            // If previous page and current page are the same, but the user no longer
            // has permission, redirect to site URL to prevent an infinite loop.
            if ($uri == $req_page) {
                $uri = site_url();
            }
        }

        // Inform the user of the lack of permission and redirect.
        $this->ci->template->set_message(lang('users_no_permission'), 'error');
        redirect($uri);
    }
}