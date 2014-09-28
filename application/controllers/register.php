<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

    public function index()
    {
    	// Global site check: redirects to home if user's already logged in
    	$this->site_authorization->redirect_if_logged();
		
		// Loads helpers and libraries
        $this->load->helper('form');
        $this->load->library(array('form_validation', 'input_validation'));
        
        // Sets to empty or default values all the datas necessary to the fill the views
        // !! All the possible properties must be listed here as reference
        $view_data = array(
        	'user_already_registered_error'	=> '',
        	'form_email'					=> '',
        	'form_email_error'				=> '',
        	'form_confirm_email'			=> '',
        	'form_confirm_email_error'		=> '',
        	'form_password'					=> '',
        	'form_password_error'			=> '',
        	'form_confirm_password'			=> '',
        	'form_confirm_password_error'	=> '',
        	'form_first_name'				=> '',
        	'form_first_name_error'			=> '',
        	'form_last_name'				=> '',
        	'form_last_name_error'			=> '',
        	'page_title'					=> 'register',
        	'page_content'					=> '',
        	'page_left_menu'				=> '',
        	'page_footer'					=> $this->load->view('footer_view', '', TRUE)
        );
                
        // Form validation
        $this->form_validation->set_error_delimiters('<span class="validation_error">', '</span>');
        
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('confirm_email', 'email confirmation', 'trim|required|valid_email|matches[email]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|callback_valid_password');
		$this->form_validation->set_rules('confirm_password', 'password confirmation', 'trim|required|matches[password]');

        $this->form_validation->set_rules('first_name', 'first name', 'trim|callback_valid_name');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|callback_valid_name');
        
        // Validation failed / first page load
        if ($this->form_validation->run() == FALSE)
		{
			$view_data['form_email'] 					= $this->input->post('email');
			$view_data['form_email_error'] 				= form_error('email');
			$view_data['form_confirm_email'] 			= $this->input->post('confirm_email');
			$view_data['form_confirm_email_error'] 		= form_error('confirm_email');
			$view_data['form_password'] 				= $this->input->post('password');
			$view_data['form_password_error'] 			= form_error('password');
			$view_data['form_confirm_password'] 		= $this->input->post('confirm_password');
			$view_data['form_confirm_password_error'] 	= form_error('confirm_password');
			$view_data['form_first_name'] 				= $this->input->post('first_name');
			$view_data['form_first_name_error'] 		= form_error('first_name');
			$view_data['form_last_name'] 				= $this->input->post('last_name');
			$view_data['form_last_name_error'] 			= form_error('last_name');
		}
		// Validation passed
		else
		{
			// Loads user model and checks if the email is already registered
			$this->load->model('user_model');
			$user_data = array(
				'email' 		=> $this->input->post('email'),
				'password'		=> $this->input->post('password'),
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name')
			);
			
			// Creates user
			if ($this->user_model->create_user($user_data))
			{
				$this->session->set_flashdata('just_registered', TRUE);
				
				// Logs in user after registration to improve UX
				$this->user_model->login_user($user_data);
				redirect('home');
			}
   			
   			// Sets error for email already registered
   			$view_data['form_email'] 					= $this->input->post('email');
			$view_data['form_confirm_email'] 			= $this->input->post('confirm_email');
			$view_data['form_password'] 				= $this->input->post('password');
			$view_data['form_confirm_password'] 		= $this->input->post('confirm_password');
			$view_data['form_first_name'] 				= $this->input->post('first_name');
			$view_data['form_last_name'] 				= $this->input->post('last_name');
   			$view_data['user_already_registered_error'] = '<div class="error_message">' . $user_data['email'] . ' is already registered. Is it you? <a href="login">Log in</a></div>';   			
		}
		
		$view_data['page_content'] = $this->parser->parse('register_view', $view_data, TRUE);
		$this->parser->parse('main_view', $view_data);
    }
    
    public function valid_password($password)
    {
    	if ($this->input_validation->valid_password($password))
    	{
    		return TRUE;
    	}
    	$this->form_validation->set_message('valid_password', '%s contains characters not allowed.');
		return FALSE;
    }
    
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

/* End of file register.php */
/* Location: ./application/controllers/register.php */