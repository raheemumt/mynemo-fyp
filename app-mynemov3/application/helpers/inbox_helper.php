<?php 

function send_messages($type="Messages")
{
	$CI  =& get_instance();

	$CI->load->model("inbox/inbox_model");


	$msg = $CI->db
		->where(["t05_kod" => $type])
		->get("t05_messages_type")
		->row();

	$args = func_get_args();
	$item = $args[1];

	$row = array(
		"t04_messages" 	=> $item["message"],
		"t04_id_user" 	=> $item["id_user"],
		"t04_type" 		=> $msg->t05_id,
		"t04_from" 		=> $msg->t05_default_from
	);
	
	if(isset($args[2]))
	{
		$row["t04_messages"] = jana_tpl_trip($msg->t05_default_template, $args[2]);
	}

	if(isset($item["id_customer"]))
	{
		$row["t04_id_customer"] = $item["id_customer"];
	}

	$CI->db->reset_query();
	$CI->inbox_model->insert($row);
}

function jana_tpl_trip($str, $cust)
{
	$str = str_replace(
		["{customer}","{trip}","{package}","{site_url}","{id_customer}"],
		[$cust->nm_customer, $cust->notes, $cust->nama_package, site_url(), $cust->id_customer],
		$str
	);
	
	return $str;
}
