<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
        	'wrong_login_error' 	=> '',
        	'form_email'			=> '',
        	'form_email_error'		=> '',
        	'form_password'			=> '',
        	'form_password_error'	=> '',
        	'form_back_to'			=> '',
        	'page_title'			=> 'login',
        	'page_content'			=> '',
        	'page_left_menu'		=> '',
        	'page_footer'			=> $this->load->view('footer_view', '', TRUE)
        );
    	
    	// Form validation
        $this->form_validation->set_error_delimiters('<span class="validation_error">', '</span>');
        
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		
		// Sets the "back to" input based on where the user comes from, if different from homepage
		if ($this->session->flashdata('back_to'))
		{
			$view_data['form_back_to'] = $this->session->flashdata('back_to');
		}
		
        // Validation failed / first page load
        if ($this->form_validation->run() == FALSE)
		{
   			$view_data['form_email']			= $this->input->post('email');
   			$view_data['form_email_error']		= form_error('email');
   			$view_data['form_password'] 		= $this->input->post('password');
   			$view_data['form_password_error']	= form_error('password');
		}
		// Validation passed
		else
		{
			// Loads user model and checks if the email is registered (= user is registered)
			$this->load->model('user_model');
			$user_data = array(
				'email' 	=> $this->input->post('email'),
				'password'	=> $this->input->post('password'),
			);
			
			// Tries to login user
			if ($this->user_model->login_user($user_data)){
				if ($this->input->post('back_to') != '')
				{
					redirect($this->input->post('back_to'));
				}
				redirect('home');
			}
			
			// Sets error for wrong login
			$view_data['wrong_login_error'] = '<div class="error_message">email or password is wrong</div>';
		}
		
		// Parses page view and main view
		$view_data['page_content'] = $this->parser->parse('login_view', $view_data, TRUE);
    	$this->parser->parse('main_view', $view_data);
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */