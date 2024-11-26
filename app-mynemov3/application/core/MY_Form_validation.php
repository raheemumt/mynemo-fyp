<?php
class MY_Form_validation extends CI_Form_validation 
{
	function alpha_numeric_space($str)
	{
	return ( ! preg_match("/^([a-z0-9 ])+$/i", $str)) ? FALSE : TRUE;
	}
	
	function alpha_dash_space($fullname){
    if (! preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
        return FALSE;
    } else {
        return TRUE;
    }
	}
}
