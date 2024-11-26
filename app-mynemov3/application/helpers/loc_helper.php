<?php defined('BASEPATH') || exit('No direct script access allowed');

function get_lang_sis()
{
	$ci =& get_instance();
	$ci->userData = $ci->session->userdata( "app_session" );
		
	if( isset( $ci->userData['rslt_lang'] ) && $ci->userData['rslt_lang'] != null){
		
		$lang = $ci->userData['rslt_lang'];
		return $lang;
	
	}else{
		
		$lang = "EN";
		return $lang;
		
	}
	
	
}

function get_all_bank()
{
    $data = require("item/bank.php");
    
    $d[""] = "Please Choose";
    
    foreach ($items as $i => $val){
        $d[$items[$i]["bank_code"]] = $items[$i]["name"];
    }
    
    return $d;
}

function get_all_parlimen()
{
    $data = require("item/parlimen.php");
    
    //$d[""] = "Please Choose";
    
    $i = 0;
    
    foreach ($items as $i => $val){
        $d[$i]["negeri"] = $items[$i]["state_id"];
        $d[$i]["kod"] = $items[$i]["id"];
        $d[$i]["name"] = $items[$i]["name"];
        
        $i++;
    }
    
    return $d;
}

function get_all_negeri()
{
    $data = require("item/negeri.php");
    
    //$d[""] = "Please Choose";
    
    foreach ($items as $i => $val){
        $d[$items[$i]["id"]] = $items[$i]["name"];
       // $d[$items[$i]["kod"]] = $items[$i]["id"];
    }
    //var_dump($d);
    return $d;
}

function get_negeri($kod_negeri) {
    $data = require("item/negeri.php");
    
    foreach ($items as $i => $val){
        if ($items[$i]["id"] == $kod_negeri)
            return $items[$i]["name"];
    }
    return null;
}

function get_negeri_by_daerah($kod_daerah)
{
    $data = require("item/daerah.php");
    
    $negeri = "";
    foreach ($items as $i => $val){
        if ($items[$i]["id"] == $kod_daerah)
            $negeri =  $items[$i]["state_id"];
    }
    
    return get_negeri($negeri);
}


function get_all_daerah($negeri)
{
    $data = require("item/daerah.php");
    $d = array();
    
    foreach ($items as $i => $val){
        if ($items[$i]["state_id"] == $negeri)
            $d[$items[$i]["id"]] = $items[$i]["name"];
    }
    return $d;
    //return get_items($items);
   
}

function get_daerah($kod_daerah) {
    $data = require("item/daerah.php");
    
    foreach ($items as $i => $val){
        if ($items[$i]["id"] == $kod_daerah)
            return $items[$i]["name"];
    }
    return null;
}

function get_all_negera()
{
    $data = require("item/negara.php");
    
    $d[""] = "Please Choose";
    
    foreach ($items as $i => $val){
        $d[$items[$i]["id"]] = $items[$i]["name"];
    }
    
    return $d;
}

function get_negara($kod_negera) {
    $data = require("item/negara.php");
    
    foreach ($items as $i => $val){
        if ($items[$i]["id"] == $kod_negera)
            return $items[$i]["name"];
    }
    return null;
}

