<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_authorization {
	
	protected $CI;
	
	public function __construct($rules = array())
	{
		$this->CI =& get_instance();
	}
	
	public function redirect_if_not_logged($url = array('redirect' => 'home', 'back_to' => null))
	{
		if (!$this->CI->session->userdata('logged'))
		{
			if ($url['back_to'] != null)
			{
				$this->CI->session->set_flashdata('back_to', $url['back_to']);
			}
    		redirect($url['redirect']);
		}
	}
	
	public function redirect_if_logged($redirect_url = 'home')
	{
		if ($this->CI->session->userdata('logged'))
		{
    		redirect($redirect_url);
		}
	}
	
	public function redirect_if_not_from_registration($redirect_url = 'home')
	{
		if (!$this->CI->session->flashdata('just_registered'))
		{
			redirect($redirect_url);
		}
	}
	
	public function redirect_if_not_admin($url = array('redirect' => 'login', 'back_to' => 'admin'))
	{
		if (!$this->CI->session->userdata('logged'))
		{
			if ($url['back_to'] != null)
			{
				$this->CI->session->set_flashdata('back_to', $url['back_to']);
			}
    		redirect($url['redirect']);
		} 
		else
		{
			$user_data = $this->CI->user_model->get_user_data_by_id();
    		$user_role = $this->CI->db->get_where('user_roles', array('id' => $user_data['role']))->row();
    		if (!$user_role->manage_other_users)
    		{
    			redirect($url['redirect']);
    		}
		}
	}

}

/* End of file Site_authorization.php */
/* Location: ./application/libraries/Site_authorization.php */