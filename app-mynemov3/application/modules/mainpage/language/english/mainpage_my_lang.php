<?php defined('BASEPATH') || exit('No direct script access allowed');

$lang['fav'] 	= 'Aplikasi Kegemaran';
$lang['fav_sub'] 	= 'Anda boleh mengurus aplikasi kegemaran anda dengan memilih/nyahpilih ikon bintang';
$lang['dashboard'] 	= 'Papan Pemuka';
$lang['dashboard_ct'] 	= 'Baki Cuti';
$lang['dashboard_lat'] 	= 'Hadir Latihan';
$lang['dashboard_kpanel'] 	= 'Baki Caj Rawatan';
$lang['dashboard_gg'] 	= 'Baki Caj Pergigian';
$lang['info'] 	= 'Info Penting';
$lang['welcome'] 	= 'Selamat kembali ke MyNemo. Sila log masuk kerja untuk memulakan hari anda. Terima kasih.';
$lang['welcome_clocked'] 	= 'Anda telah log masuk kerja hari ini pada';
$lang['welcome_clock_at'] 	= 'Sila log keluar kerja pada';
$lang['welcome_tq'] 	= 'Terima kasih';
$lang['suggestion'] 	= 'Adakah anda mempunyai sebarang cadangan kepada kami?';
$lang['suggestion_sub'] 	= 'Pengalaman pengguna adalah keutamaan kami. Kami amat menghargai semua komen dan cadangan untuk menambah baik perkhidmatan kami.';
$lang['suggestion_button'] 	= 'Hantar komen/cadangan';
$lang['search_button'] 	= 'Carian Aplikasi';

$lang['but_home'] 	= 'Utama';

$ci =& get_instance();
$ci->load->model(array('mainpage/t01_model'=>'t01m') );
$t01 = $ci->t01m->t01_group();
if ($t01)
{	$i=0;
	foreach ($t01->result() as $t01) 
	{
		
		$lang['cate_'.$i] 	= $t01->T01_NAMA;
		$i++;
	}
}