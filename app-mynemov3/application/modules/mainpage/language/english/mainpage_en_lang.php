<?php defined('BASEPATH') || exit('No direct script access allowed');

$lang['fav'] 	= 'Favourite Apps';
$lang['fav_sub'] 	= 'You can manage your favourite apps by selecting/unselect the star icon';
$lang['dashboard'] 	= 'Dashboard';
$lang['dashboard_ct'] 	= 'Leave Balance';
$lang['dashboard_lat'] 	= 'Attend Training';
$lang['dashboard_kpanel'] 	= 'Treatment Charges';
$lang['dashboard_gg'] 	= 'Dental Charges';
$lang['info'] 	= 'Important Info';
$lang['welcome'] 	= 'Welcome back to MyNemo. Please clock in to start your day. Thank you.';
$lang['welcome_clocked'] 	= 'You had clocked in today at';
$lang['welcome_clock_at'] 	= 'Please clock out at';
$lang['welcome_tq'] 	= 'Thank you';
$lang['suggestion'] 	= 'Do you have any suggestion to us?';
$lang['suggestion_sub'] 	= 'User experience is our top priority. We highly appreciate all comments and suggestions to improve our services.';
$lang['suggestion_button'] 	= 'Submit a comment/suggestion';
$lang['search_button'] 	= 'Search for application';

$lang['but_home'] 	= 'Home';

$ci =& get_instance();
$ci->load->model(array('mainpage/t01_model'=>'t01m') );
$t01 = $ci->t01m->t01_group();
if ($t01)
{	$i=0;
	foreach ($t01->result() as $t01) 
	{
		
		$lang['cate_'.$i] 	= $t01->T01_NAMA_BI;
		$i++;
	}
}


