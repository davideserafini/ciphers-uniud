<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller for account page
 *
 * This controller provides basic functionality for editing user data
 */
class Account extends CI_Controller {

    public function index()
    {
    	// Loads user model
    	$this->load->model('user_model');
    	
    	// Global site check: redirects to login if user's already logged in
    	$this->site_authorization->redirect_if_not_logged(array('redirect' => 'login', 'back_to' => uri_string()));
		
        $this->load->helper('form');
        $this->load->library(array('form_validation', 'input_validation', 'parser'));
        
        // View datas for the main page
        $view_data = array(
        	'page_title'					=> '',
        	'is_admin'						=> '',
        	'page_left_menu'				=> '',
        	'page_content'					=> '',
        	'page_footer'					=> ''
        );
        
        // Content view datas for the content pages
        $content_view_data = array(
        	'user_update_message'			=> '',
        	'user_email'					=> '',
        	'form_password'					=> '',
        	'form_password_error'			=> '',
        	'form_confirm_password'			=> '',
        	'form_confirm_password_error'	=> '',
        	'form_first_name'				=> '',
        	'form_first_name_error'			=> '',
        	'form_last_name'				=> '',
        	'form_last_name_error'			=> '',
        	'form_original_first_name'		=> '',
        	'form_original_last_name'		=> ''
        );
        
        $this->form_validation->set_error_delimiters('<span class="validation_error">', '</span>');
        
        $this->form_validation->set_rules('password', 'password', 'trim|callback_valid_password|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password', 'password confirmation', 'trim|matches[password]');
        $this->form_validation->set_rules('first_name', 'first name', 'trim|callback_valid_name');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|callback_valid_name');
        
        // Retrieves user info
        $user_info = $this->user_model->get_user_data_by_id();
        
        // Sets the retrieved user info for the content view datas
        $content_view_data['user_email']			= $user_info['email'];
        $content_view_data['form_first_name']		= $user_info['first_name'];
		$content_view_data['form_last_name']		= $user_info['last_name'];
		$content_view_data['form_saved_first_name']	= $user_info['first_name'];
		$content_view_data['form_saved_last_name']	= $user_info['last_name'];
				
        if ($this->form_validation->run() == FALSE)
		{	
			// If account is being updated, resets fields values and errors
			if($this->input->post('update_account'))
			{
				$content_view_data['form_password']					= $this->input->post('password');
				$content_view_data['form_password_error']			= form_error('password');
				$content_view_data['form_confirm_password']			= $this->input->post('confirm_password');
				$content_view_data['form_confirm_password_error']	= form_error('confirm_password');
				$content_view_data['form_first_name']				= $this->input->post('first_name');
				$content_view_data['form_first_name_error']			= form_error('first_name');
				$content_view_data['form_last_name']				= $this->input->post('last_name');
				$content_view_data['form_last_name_error']			= form_error('last_name');
			}
		}
		else
		{
			// Checks if some fields have been really changed
			if ($this->input->post('password') != '' || $this->input->post('first_name') != $this->input->post('saved_first_name') || $this->input->post('last_name') != $this->input->post('saved_last_name'))
			{
				$user_data = array(
					'first_name'	=> $this->input->post('first_name'),
					'last_name'		=> $this->input->post('last_name')
				);
			
				if ($this->input->post('password') != '')
				{
					$user_data['password']	= $this->input->post('password');
				}
				
				// Updates user datas
				if ($this->user_model->update_user($user_data))
				{
					$content_view_data['user_update_message']	= '<div class="success_message">Profile successfully updated</div>';
					$content_view_data['form_first_name']		= $this->input->post('first_name');
					$content_view_data['form_last_name']		= $this->input->post('last_name');
				}
   			}
   			else
   			{
   				$content_view_data['user_update_message']	= '<div class="neutral_message">Nothing changed, nothing to update</div>';
   			}
		}
		
		$view_data['page_title']		= 'account';
        $view_data['is_admin']			= $this->user_model->is_admin();
        $view_data['page_left_menu']	= $this->load->view('left_menu_view', $view_data, TRUE);
        $view_data['page_footer']		= $this->load->view('footer_view', '', TRUE);
        $view_data['page_content'] 		= $this->parser->parse('account_view', $content_view_data, TRUE);
		
		$this->parser->parse('main_view', $view_data);
    }
    
    /**
     * Checks if the password is valid using the input_validation library
     *
     * @access public
     * @param string
     * @return boolean
     */
    public function valid_password($password)
    {
    	if ($this->input_validation->valid_password($password))
    	{
    		return TRUE;
    	}
    	$this->form_validation->set_message('valid_password', '%s contains characters not allowed.');
		return FALSE;
    }
    
    /**
     * Checks if the password is valid using the input_validation library
     *
     * @access public
     * @param string
     * @return boolean
     */
    public function valid_name($name)
    {
    	if ($this->input_validation->valid_name($name))
    	{
    		return TRUE;
    	}
    	$this->form_validation->set_message('valid_name', '%s contains characters not allowed');
    	return FALSE;
    }
        
}

/* End of file account.php */
/* Location: ./application/controllers/account.php */