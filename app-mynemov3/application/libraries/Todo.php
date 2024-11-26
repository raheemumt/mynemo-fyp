<?php
class Todo
{
    protected $ci;
	protected $user;
    
    function __construct() 
    {
		$this->ci =& get_instance();
    	$this->ci->load->model(array(
            'manage/package_model',
			'manage/package_trip_model',
			'customer/customer_trip_model',
			'customer/customer_model',
			'users/user_groups_model',
			'users/permissions_model',
			'users/user_permissions_model',
			['users/attachment_model' => 'atth_model'],
			['customer/dbcustomer_model'=>'cust'],
			['customer/docs_model'=>'doc'],
			['customer/customer_docs_model'=>'atc'],
			['inbox/inbox_model'=>'inb'],
        ));
        
        $this->user = $this->ci->auth->userdata();
    }
    
    public function jana()
    {
    	$where= "customer.deleted = 0 and customer.id_customer in (select id_customer from customer_payment where st_approval = 0 and deleted=0)";
        
        $total = $this->ci->customer_model
                ->where($where)
                ->count_all();
                
        return $total;        
    }
    
    public function jana_msg()
    {
    	$where= "t04_status is null and t04_id_user = ".$this->user->id_user;
        
        $total = $this->ci->inb
                ->where($where)
                ->count_all();
                
        return $total;        
    }
}
