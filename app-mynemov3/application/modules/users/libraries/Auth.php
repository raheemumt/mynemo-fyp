<?php 


//if (!defined('BASEPATH')) exit('No direct script access allowed');
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
		$this->ci->load->database();
        $this->ci->load->library('session');
        $this->ci->lang->load('users/users');
		$this->ci->load->model(array('users/countlogin_model',
					['users/personel_model' => 'p'],
					// ['users/pku_model' => 'pku'],
					['mainpage/t02_model' => 't02m']));
		//$this->ci->load->helper( 'url' );
		$this->ci->load->helper(array('form', 'url'));
		//include(APPPATH.'libraries/Jwt.php');
		$this->ci->load->library('jwt');
		
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
       
	    $userdata = $this->ci->p->personel( $_SESSION['icno'] );
        return $userdata;
    }
	
	public function fedlogin($displayName,$uid,$umtAffiliation,$umtICNumber,$umtMatricNumber,$umtmail)
	{ 	
			
			if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
			 {
			  $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			 }
			 else
			 {
			  $ip = $_SERVER["REMOTE_ADDR"];
			 }
			 $ip_array = explode(",", $ip);
			 $ipx = $ip_array[0];
			 $ipsvr = $_SERVER['SERVER_ADDR'];
		
			$affiliationList = explode(";",$umtAffiliation);
			if(in_array('sambilan',$affiliationList)){
				$affiliation = 'Sambilan';
			} else if (in_array("staff",$affiliationList)){
				$affiliation = 'Staff';
			} else if (in_array("undergraduates",$affiliationList)){
				$affiliation = 'Undergraduates';
			} else if (in_array("graduates",$affiliationList)){
				$affiliation = 'Graduates';
			}
			else if (in_array("lpu",$affiliationList)){
				$affiliation = 'LPU';
			}
			
			switch($affiliation)
			{
				case "Staff" : 
				
					$nama = $displayName;
					$id = strtolower($uid);
					$ic = $umtICNumber;
					
					$profile = $this->ci->p->Create_User_Profile( $ic );

					if ($ic==$profile->NOKP_BARU) {
						$_SESSION['ptj']=array();
						$_SESSION['idle']=date("H:i:s", strtotime("+10 minutes"));
						$_SESSION['UID']=strtolower($id);
						$_SESSION['STAFF']=$profile->NAMA;
						$_SESSION['icno']=$profile->NOKP_BARU;
						$_SESSION['gred']=$profile->GRED;
						$_SESSION['ptj']=$profile->TEMPAT_KERJA;
						$_SESSION['jab']=$profile->KOD_BAH;
						$_SESSION['kump_staf']=$profile->STAF_KUMP;
						$_SESSION['USER_TYPE']='S';
						$_SESSION['gaji_hakiki']=$profile->GAJI_HAKIKI;
						$_SESSION['kategori']=$profile->KATEGORI;
						$_SESSION['stafgred']=$profile->STAF_GRED; ///gune utk bakat
						$_SESSION['klasifikasi']=$profile->KLASIFIKASI;
						redirect(site_url("mainpage/main"));
					} 
					break;
					
				case "Undergraduates" : 
				
					$nama = $displayName;
					$id = $umtMatricNumber;
					$ic = $umtICNumber;
					
					$profile = $this->ci->p->Create_User_Profile_pelajar( $id );
					if ($id==$profile->PEL_NO_MATRIK) {
					$issuedAt   = new DateTimeImmutable();
					$expire     = $issuedAt->modify('+120 seconds')->getTimestamp();      // Add 60 seconds
					$serverName = "pelajar.mynemo.umt.edu.my";
					$payloadArray = [
						'iat'  => $issuedAt,         // Issued at: time when the token was generated
						'iss'  => $serverName,                       // Issuer
						'nbf'  => $issuedAt->modify('-60 seconds')->getTimestamp(),         // Not before
						'exp'  => $expire,                           // Expire
						'userName' => $id,                     // User name
						// 'userName' => 'P4585',                     // User name
					];	
					$serverKey = 'xxx5f2b5cdbe5194f10b3241568fe4e2b24yyy';	
					$token = JWT::encode(
							$payloadArray,
							$serverKey,
							'HS512'
						);
						$_SESSION['MATRIK']=$profile->PEL_NO_MATRIK;
						$_SESSION['STATUS']=$profile->PEL_STATUS_PELAJAR;
						$_SESSION['EMAIL']=$profile->STATUS_EMAIL;
						$_SESSION['NOKP']=$profile->PEL_NO_KAD_PENGENALAN;
						$_SESSION['SESI_MASUK']=$profile->PEL_SESI_MASUK;

					$d = array (
					   "T11_NOKP"=> $_SESSION['NOKP'],
					   "T11_KEYSESSION"=>$token,
					   "T11_UID"=>$_SESSION['MATRIK']);	
						$this->ci->t02m->add_t11($d);
						
						header("Location:  https://pelajar.mynemo.umt.edu.my/portal_login_pelajar.php?t=".$token);
						exit;
					} 
					
					break;
					
				case "Graduates" : 
				
					$nama = $displayName;
					$id = $umtMatricNumber;
					$ic = $umtICNumber;
					
					$issuedAt   = new DateTimeImmutable();
					$expire     = $issuedAt->modify('+120 seconds')->getTimestamp();      // Add 60 seconds
					$serverName = "gssp.umt.edu.my";
					$payloadArray = [
						'iat'  => $issuedAt,         // Issued at: time when the token was generated
						'iss'  => $serverName,                       // Issuer
						'nbf'  => $issuedAt->modify('-60 seconds')->getTimestamp(),         // Not before
						'exp'  => $expire,                           // Expire
						'userName' => $id,                     // User name
						// 'userName' => 'P4585',                     // User name
					];
					$serverKey = 'xxx5f2b5cdbe5194f10b3241568fe4e2b24yyy';	
					$token = JWT::encode(
							$payloadArray,
							$serverKey,
							'HS512'
						);
						header("Location: http://gssp.umt.edu.my/StudentPortal/sso.php?gsk=$token");
					//} 
					
					break;
					
				case "Sambilan" : 
				
					$nama = $displayName;
					$id = strtolower($uid);
					$ic = $umtICNumber;
					
					$profile = $this->ci->p->Create_User_Profile_Sambilan($id);
					if ($profile->SL_USERNAME == $id) {
						$_SESSION["PS"] = "PS";
						$_SESSION['UID'] = $id;
						$_SESSION['icno'] = $profile->SL_NOKP;
						$_SESSION["aff"] = "sambilan";
						//$_SESSION['USERPWD'] = $profile->SL_KATALALUAN;
					//header("Location: https://mynemo.umt.edu.my/pkuweb/index.php/kaunter/main_menu");
					}
					header("Location: /mynemov3/loginlain/opensys_xloginother");
					
				
				break;
				case "LPU" : 
				
					$nama = $displayName;
					$id = strtolower($uid);
					$ic = $umtICNumber;
					//die("sini".$ic);exit;
					$profile = $this->ci->p->Create_User_Profile_Meeting($umtmail);
					if ($profile->EMAIL == $umtmail) {
						$_SESSION['icno'] = $profile->ID;
						$_SESSION['UID']=$id;
						$_SESSION['XSTAF'] = "1";
						//die("sini");exit;
						header("Location: /mynemov3/loginlain/opensys_xlogin/147/lpu");
						//header("Location: /mynemov3/mainpage/redirect/147");
					}
					//header("Location:  /spm");
					
				
				break;
				default :  NULL; 
			}
		
	}
	
	public function login($username = "", $password = "")
	{
		
		
	}
	
	function ldaplog_all($pid, $credential)
	{		
		
		
		
	}
	public function login_bkp($username = "", $password = "")
	{
		
		
	}
	
    public function logout()
    {
        //setcookie("_shibsession_64656661756c7468747470733a2f2f6d796e656d6f76332e756d742e6564752e6d792f73686962626f6c657468", "", time()-3600);
		// $this->ci->session->sess_regenerate();
		$this->ci->session->sess_destroy();
		//session_regenerate_id(true);
		
		
		//$url = "/login";
        redirect("/");
                // Commented by Muhammad Farhan Sjaugi <farhan@sifulan.my>
		//redirect("https://mynemov3.umt.edu.my/Shibboleth.sso/Logout?return=https://idp3.umt.edu.my/idp/profile/Logout");
                //redirect("https://mynemov3.umt.edu.my/Shibboleth.sso/Logout?return=https://mynemov3.umt.edu.my/");
                //redirect("https://".$_SERVER["SERVER_NAME"]."/Shibboleth.sso/Logout?return=https://mynemov3.umt.edu.my/");
                //redirect("https://".$_SERVER["SERVER_NAME"]."/Shibboleth.sso/Logout");
    }
	
	public function logout2()
    {
        $this->ci->session->sess_regenerate();
		$this->ci->session->sess_destroy();
		
		//session_regenerate_id(true);
        //redirect('login');
                // Commented by Muhammad Farhan Sjaugi <farhan@sifulan.my>
		//redirect("https://mynemov3.umt.edu.my/Shibboleth.sso/Logout?return=https://idp3.umt.edu.my/idp/profile/Logout");
		//redirect("https://mynemov3.umt.edu.my/Shibboleth.sso/Logout?return=https://mynemov3.umt.edu.my/");
		redirect("https://".$_SERVER["SERVER_NAME"]."/Shibboleth.sso/Logout?return=https://mynemov3.umt.edu.my/");
                //redirect("https://".$_SERVER["SERVER_NAME"]."/Shibboleth.sso/Logout");
    }
    
    public function has_permission($nm_permission = "")
    {
        if($nm_permission == "")
        {
            return FALSE;
        }

       

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

	public function login_table($username = "", $password = "")
	{
		date_default_timezone_set('Asia/Kuala_Lumpur');	
		$log = $this->ci->p->check_profile($username, $password); 	
		
		if ($log){ 	
			
			if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
			 {
			  $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			 }
			 else
			 {
			  $ip = $_SERVER["REMOTE_ADDR"];
			 }
			 $ip_array = explode(",", $ip);
			 $ipx = $ip_array[0];
			 $ipsvr = $_SERVER['SERVER_ADDR'];
			 //$payloadArray['nokp'] = $profile->NOKP_BARU;
			//$serverKey = 'x5f2b5cdbe5194f10b3241568fe4e2b24';
			
			/*$serverKey = 'x5f2b5cdbe5194f10b3241568fe4e2b24';
			$payloadArray = array();
			//$payloadArray['nokp'] = $profile->NOKP_BARU;
			$payloadArray['hostname'] = gethostname();
			$payloadArray['ipserver'] = $ipsvr;
			$payloadArray['ippc'] = $ipx;
			$payloadArray = time().$_SESSION['MATRIK'];
			//if (isset($nbf)) {$payloadArray['nbf'] = $nbf;}
			//if (isset($exp)) {$payloadArray['exp'] = $exp;}
			$token = JWT::encode($payloadArray, $serverKey);
			$_SESSION['tokenx']=$token;*/
			
			// $principal = $log[0]['dn']; 
				
			// $dn = explode(",", $principal)[1];
			
			// if (strrpos($dn, '=' ) == false)  die ("error");

			// $ou =  trim(substr($dn, strrpos($dn, '=' )+1));
			$ou =  "Staff";
		
			
			switch($ou)
			{
				case "Staff" : 
				
					// $nama = $log[0]['displayname'][0];
					 $id = strtolower($username); //$log[0]['uidnumber'][0];
					// $ic = $log[0]['umticnumber'][0];
					$ic = $username;
					
					$profile = $this->ci->p->Create_User_Profile( $ic );

					if ($ic==$profile->ID_WARGA) {
						$_SESSION['ptj']=array();
						$_SESSION['idle']=date("H:i:s", strtotime("+10 minutes"));
						$_SESSION['UID']=strtolower($id);
						$_SESSION['STAFF']=$profile->NAMA;
						$_SESSION['icno']=$profile->NOKP_BARU;
						$_SESSION['gred']=$profile->GRED;
						$_SESSION['ptj']=$profile->TEMPAT_KERJA;
						// $_SESSION['jab']=$profile->KOD_BAH;
						// $_SESSION['kump_staf']=$profile->STAF_KUMP;
						// // $_SESSION['USERPWD']=$credential;
						// $_SESSION['USER_TYPE']='S';
						// $_SESSION['gaji_hakiki']=$profile->GAJI_HAKIKI;
						// $_SESSION['kategori']=$profile->KATEGORI;
						// $_SESSION['stafgred']=$profile->STAF_GRED; ///gune utk bakat
						// $_SESSION['klasifikasi']=$profile->KLASIFIKASI;
						
						redirect(site_url("mainpage/main"));
					} 
					break;
					
				case "Undergraduates" : 
				
					$nama = $log[0]['displayname'][0];
					$id = $log[0]['umtmatricnumber'][0];
					$ic = $log[0]['umticnumber'][0];
					
					$profile = $this->ci->p->Create_User_Profile_pelajar( $id );
					if ($id==$profile->PEL_NO_MATRIK) {
					
					$issuedAt   = new DateTimeImmutable();
					$expire     = $issuedAt->modify('+120 seconds')->getTimestamp();      // Add 60 seconds
					$serverName = "pelajar.mynemo.umt.edu.my";
					$payloadArray = [
						'iat'  => $issuedAt,         // Issued at: time when the token was generated
						'iss'  => $serverName,                       // Issuer
						'nbf'  => $issuedAt->modify('-60 seconds')->getTimestamp(),         // Not before
						'exp'  => $expire,                           // Expire
						'userName' => $id,                     // User name
						// 'userName' => 'P4585',                     // User name
					];
					$serverKey = 'xxx5f2b5cdbe5194f10b3241568fe4e2b24yyy';	
					$token = JWT::encode(
							$payloadArray,
							$serverKey,
							'HS512'
						);
						$_SESSION['MATRIK']=$profile->PEL_NO_MATRIK;
						$_SESSION['STATUS']=$profile->PEL_STATUS_PELAJAR;
						$_SESSION['EMAIL']=$profile->STATUS_EMAIL;
						$_SESSION['NOKP']=$profile->PEL_NO_KAD_PENGENALAN;
						$_SESSION['SESI_MASUK']=$profile->PEL_SESI_MASUK;

					$d = array (
					   "T11_NOKP"=> $_SESSION['NOKP'],
					   "T11_KEYSESSION"=>$token,
					   "T11_UID"=>$_SESSION['MATRIK']);	
						$this->ci->t02m->add_t11($d);
						//header("Location: https://gssp.umt.edu.my/StudentPortal/sso.php?gsk=$token");
						
						header("Location:  https://pelajar.mynemo.umt.edu.my/portal_login_pelajar.php?t=".$token);
						exit;
						//header("Location:  https://pelajar.umt.edu.my/appumt/portal/integ/token/vtoken/".$token);
						//redirect("https://pelajar.umt.edu.my/appumt/portal/integ/token/vtoken/".$token);
					} 
					
					break;
					
				case "Graduates" : 
				
					$nama = $log[0]['displayname'][0];
					$id = $log[0]['umtmatricnumber'][0];
					$ic = $log[0]['umticnumber'][0];
					
					$issuedAt   = new DateTimeImmutable();
					$expire     = $issuedAt->modify('+120 seconds')->getTimestamp();      // Add 60 seconds
					$serverName = "gssp.umt.edu.my";
					$payloadArray = [
						'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
						'iss'  => $serverName,                       // Issuer
						'nbf'  => $issuedAt->modify('-60 seconds')->getTimestamp(),         // Not before
						'exp'  => $expire,                           // Expire
						'userName' => $id,                     // User name
						// 'userName' => 'P4585',                     // User name
					];
					$serverKey = 'xxx5f2b5cdbe5194f10b3241568fe4e2b24yyy';	
					$token = JWT::encode(
							$payloadArray,
							$serverKey,
							'HS512'
						);
					/*$profile = $this->ci->p->Create_User_Profile_Siswazah( $id );
					if ($id==$profile->MATRIK) {

						$_SESSION['MATRIK']=$profile->MATRIK;
						$_SESSION['STATUS']=$profile->STATUS;*/
						//header("Location: http://gssp.umt.edu.my/StudentPortal/index.php?gsk=$pid");
						header("Location: http://gssp.umt.edu.my/StudentPortal/sso.php?gsk=$token");
					//} 
					
					break;
					
				case "Sambilan" : 
				
					$nama = $log[0]['displayname'][0];
					$id = strtolower($username); // $log[0]['uidnumber'][0];
					$ic = $log[0]['umticnumber'][0];
					
					$profile = $this->ci->p->Create_User_Profile_Sambilan($id);
					if ($profile->SL_USERNAME == $id) {
						$_SESSION["PS"] = "PS";
						$_SESSION['UID'] = $id;
						$_SESSION['icno'] = $profile->SL_NOKP;		
						//$_SESSION['USERPWD'] = $profile->SL_KATALALUAN;
					//header("Location: https://mynemo.umt.edu.my/pkuweb/index.php/kaunter/main_menu");
					}
					//header("Location:  /index.php");
					header("Location: /mynemov3/loginlain/opensys_xloginother");
					
				
				break;
				default :  NULL; 
			}
			//echo $ic;
	
		}
		else 
		{ 
			$credential = $password;
			$pid=$username;
			$ceklogin = $this->ci->p->cek_flaglogin( $pid,$credential );	
		 	$cekpkulogin = $this->ci->pku->cek_pkuflaglogin( $pid,$credential ); // untuk PKU
			
			if (!empty($ceklogin->FLAG))
			{
				$pid = $username;
				if ($ceklogin->FLAG=='lapor')
				{
						$profile = $this->ci->p->Create_User_Profile_Lapordiri( $pid,$credential);
						if ($profile->SL_USERNAME == $pid) {
							$_SESSION["LD"] = "LD";
							$_SESSION['UID'] = $pid;
							$_SESSION['icno'] = $profile->SL_NOKP;
							
						}
						header("Location: /mynemov3/loginlain/opensys_xloginother");
				}
				if ($ceklogin->FLAG=='kaunseling')
				{
					$profile = $this->ci->p->Create_User_Profile_Kaunseling( $pid,$credential);
					if ($profile->SL_USERNAME == $pid) {
						$_SESSION["KL"] = "KL";
						$_SESSION['UID'] = $pid;
						$_SESSION['icno'] = $profile->SL_NOKP;		
					}
					header("Location: /mynemov3/loginlain/opensys_xloginother");
				}
			} else if (!empty($cekpkulogin->FLAG)){
				if ($cekpkulogin->FLAG=='locum')
				{
					$profile = $this->ci->pku->Create_User_Profile_Locum( $pid,$credential);
					if ($profile->NOKP == $pid) {
						$_SESSION['icno'] = $profile->NOKP;		
					}
					header("Location: /mynemov3/loginlain/opensys_xlogin/139/locum");
				} 
			} else {
				//$this->ci->template->set_message("Login Gagal", 'error');
				//return false;
				$msg="The user provided invalid credentials or is not authorized.";
				$this->ci->template->set_message($msg, 'warning');
			}
		}
		
	}
	
}
