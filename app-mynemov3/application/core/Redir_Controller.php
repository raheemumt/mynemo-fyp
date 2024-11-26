<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Redir_Controller extends Base_Controller
{

    //--------------------------------------------------------------------

    /**
     * Class constructor
     *
     */
    public function __construct()
    {
        //$this->autoload['libraries'][] = 'users/auth';
		parent::__construct();
		
        $this->load->library(array('form_validation','template'));

       // $this->load->model('identitas_model');

        $this->form_validation->set_error_delimiters('', '');
		//$this->user_data = $this->auth->userdata();

        //$idt = $this->identitas_model->find(1);
		$this->pager = array(
            'full_tag_open'     => '<ul class="pagination pull-right" style="margin: 0 0 0;">',
            'full_tag_close'    => '</ul>',
            'next_link'         => '&rarr;',
            'prev_link'         => '&larr;',
            'next_tag_open'     => '<li>',
            'next_tag_close'    => '</li>',
            'prev_tag_open'     => '<li>',
            'prev_tag_close'    => '</li>',
            'first_tag_open'    => '<li>',
            'first_tag_close'   => '</li>',
            'last_tag_open'     => '<li>',
            'last_tag_close'    => '</li>',
            'cur_tag_open'      => '<li class="active"><a href="#">',
            'cur_tag_close'     => '</a></li>',
            'num_tag_open'      => '<li>',
            'num_tag_close'     => '</li>',
        );

        //$this->template->set('idt', $idt);
		//$this->template->set('userData', $this->user_data);
        //$this->template->set('todo', $total);
        //$this->template->set('inbox', $total_msg);
        //$this->template->set_theme('web');
		$this->template->set_theme('redir');
        $this->template->set_layout('index');
        //Overwrite if the request is ajax
        if($this->input->is_ajax_request())
        {
            $this->template->set_layout('ajax');
        }
    }//end __construct()

    //--------------------------------------------------------------------
	/*public function render($data = null)
	{
		$view_ext = ".tpl.php";
		
		
		$this->template->render($this->controller_name."/".$this->action_name.$view_ext);
		//$this->template->render($this->action_name);
	}	*/
}
/*End of Front Controller*/