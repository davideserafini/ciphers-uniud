<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index()
    {
    	// Loads user model
    	$this->load->model('user_model');
    	
    	// Global site check: redirects to login if user's already logged in or is not an admin user
    	$this->site_authorization->redirect_if_not_admin(array('redirect' => 'login', 'back_to' => 'admin'));
		
		// Loads form helper
        $this->load->helper('form');
        
        // Loads libraries for form and input validations, and parsing templates
        $this->load->library(array('form_validation', 'input_validation', 'parser'));
        
        
        // View datas for the main view
        $view_data = array(
        	'page_title'				=> 'admin',
        	'is_admin'					=> TRUE,
        	'page_left_menu'			=> '',
        	'page_content'				=> '',
        	'page_footer'				=> ''
        );
    	
    	// View datas for the content pages
    	$content_view_data = array(
    		'form_user_email' 			=> '',
        	'form_user_email_error'		=> '',
        	'user_not_found_error'		=> '',
        	'user_update_form'			=> '',
		);
    	
        if ($this->input->post('update'))
        {
        	// Handle the second step - user update
        	$this->_update_user($content_view_data);
        } 
        else
        {
        	// Handle the first step - user search
        	$this->_search($content_view_data);
        }
        
        $view_data['page_footer']		= $this->load->view('footer_view', '', TRUE);        
        $view_data['page_left_menu']	= $this->load->view('left_menu_view', $view_data, TRUE);
        $view_data['page_content']		= $this->parser->parse('admin_view', $content_view_data, TRUE);
        
        $this->parser->parse('main_view', $view_data);
    }
    
    /**
     * Manages search feature
     *
     * @access private
     * @param array
     * @return void
     */
    private function _search(&$content_view_data)
    {
    	$this->form_validation->set_error_delimiters('<div class="validation_error spacerT10 width45">', '</div>');
    	
    	$content_view_data['form_user_email'] = $this->input->post('user_email');
    	
        $this->form_validation->set_rules('user_email', 'email', 'trim|required|valid_email');
        
        if ($this->form_validation->run() == FALSE)
        {
        	$content_view_data['form_user_email_error'] = form_error('user_email');
        }
        else
        {
        	// Retrieves user datas using the email
	        $user_data = $this->user_model->get_user_data_by_email($this->input->post('user_email'));
	        
	        if ($user_data)
	        {
	        	// After a successfull submit, passes the control over to the _update_user function
	        	$this->_update_user($content_view_data, $user_data);
	        }
	        else
	        {
	        	$content_view_data['user_not_found_error']	= '<div class="error_message">User not found</div>';
	        }
   		}

    }
    
    /**
     * Manages search feature
     *
     * @access private
     * @param array, array
     * @return void
     */
    private function _update_user(&$content_view_data, $user_data = array())
    {
    	// Fields of the view
    	$content_view_data['form_email']					= '';
    	$content_view_data['form_email_error'] 				= '';
    	$content_view_data['form_confirm_email']			= '';
    	$content_view_data['form_confirm_email_error'] 		= '';
    	$content_view_data['form_password']			 		= '';
    	$content_view_data['form_password_error'] 			= '';
    	$content_view_data['form_confirm_password'] 		= '';
    	$content_view_data['form_confirm_password_error'] 	= '';
    	$content_view_data['form_first_name'] 				= '';
    	$content_view_data['form_first_name_error'] 		= '';
    	$content_view_data['form_last_name'] 				= '';
    	$content_view_data['form_last_name_error'] 			= '';
    	$content_view_data['form_id'] 						= '';
    	$content_view_data['email_already_exists_error']	= '';
    	$content_view_data['user_update_message']			= '';
    	
    
    	if($this->input->post('update'))
    	{
    		$this->form_validation->set_error_delimiters('<span class="validation_error">', '</span>');
    		
    		$update_email = FALSE;
    		$update_password = FALSE;
    		$update_first_name = FALSE;
    		$update_last_name = FALSE;
    		
    		// Retrieve user datas using the id
    		$user_data = $this->user_model->get_user_data_by_id($this->input->post('id'));
    		
    		if(!$user_data)
    		{
    			redirect('admin');
    		}
    		
    		$content_view_data['form_user_email'] = $user_data['email'];
    		
    		$this->form_validation->set_rules('email', 'email', 'trim');
	        $this->form_validation->set_rules('confirm_email', 'email confirmation', 'trim');
	        $this->form_validation->set_rules('password', 'password', 'trim');
			$this->form_validation->set_rules('confirm_password', 'password confirmation', 'trim');
			$this->form_validation->set_rules('first_name', 'first name', 'trim');
			$this->form_validation->set_rules('last_name', 'last name', 'trim');
    		
    		// Set validation rules only for changed fields
    		
    		if (trim($this->input->post('email')) != '' || trim($this->input->post('confirm_email')) != '')
    		{
    			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
	        	$this->form_validation->set_rules('confirm_email', 'email confirmation', 'trim|required|valid_email|matches[email]');
	        	$update_email = TRUE; // Set email for update
    		}
    	
    		if (trim($this->input->post('password')) != '' || trim($this->input->post('confirm_password')) != '')
    		{
    			$this->form_validation->set_rules('password', 'password', 'trim|required|callback_valid_password');
				$this->form_validation->set_rules('confirm_password', 'password confirmation', 'trim|required|matches[password]');
				$update_password = TRUE; // Set password for update
    		}
    		
    		if(trim($this->input->post('first_name')) != $user_data['first_name'])
    		{
    			$this->form_validation->set_rules('first_name', 'first name', 'trim|callback_valid_name');
    			$update_first_name = TRUE; // Set first name for update
    		}
    		
    		if(trim($this->input->post('first_name')) != $user_data['first_name'])
    		{
    			$this->form_validation->set_rules('last_name', 'last name', 'trim|callback_valid_name');
    			$update_last_name = TRUE; // Set last name for update
    		}

        	if ($this->form_validation->run() == FALSE)
        	{
        		$content_view_data['form_id'] 						= $this->input->post('id');
        		$content_view_data['form_email'] 					= $this->input->post('email');
        		$content_view_data['form_email_error'] 				= form_error('email');
        		$content_view_data['form_confirm_email'] 			= $this->input->post('confirm_email');
        		$content_view_data['form_confirm_email_error'] 		= form_error('confirm_email');
        		$content_view_data['form_password'] 				= $this->input->post('password');
        		$content_view_data['form_password_error'] 			= form_error('password');
        		$content_view_data['form_confirm_password'] 		= $this->input->post('confirm_password');
        		$content_view_data['form_confirm_password_error']	= form_error('confirm_password');
	    	    $content_view_data['form_first_name'] 				= $this->input->post('first_name');
	    	    $content_view_data['form_first_name_error']			= form_error('first_name');
	    	    $content_view_data['form_last_name'] 				= $this->input->post('last_name');
	    	    $content_view_data['form_last_name_error']			= form_error('last_name');
        	}
        	else
        	{
				$user_already_exists = false;
				
				// Fields to be updated
				$updated_user_data = array();
				
				// Needed to find the user in the database
				$updated_user_data['id'] = $this->input->post('id');
				
				// Sets fields to be updated
				
				if ($update_email)
				{
					$updated_user_data['email'] = $this->input->post('email');
				}
				if ($update_password)
				{
					$updated_user_data['password'] = $this->input->post('password');
				}
				if ($update_first_name)
				{
					$updated_user_data['first_name'] = $this->input->post('first_name');
				}
				if ($update_last_name)
				{
					$updated_user_data['last_name'] = $this->input->post('last_name');
				}
				
				// If email is changed, checks if an user with the same email already exists to avoid overwriting users
				if ($update_email)
				{
					$user_already_exists = $this->user_model->check_if_user_exists($updated_user_data['email']);
				}
				
				if ($update_email && $user_already_exists)
				{
					$content_view_data['email_already_exists_error'] = '<div class="error_message">An user with this email already exists, please choose a different one</div>';
				}
				else if (count($updated_user_data) > 1)
				{
					$this->user_model->update_user($updated_user_data);	
					$content_view_data['user_update_message'] = '<div class="success_message">User successfully updated</div>';
				}
				else
				{
					$content_view_data['user_update_message'] = '<div class="neutral_message">Nothing changed, nothing to update</div>';
				}
				
				$content_view_data['form_id'] 						= $this->input->post('id');
				$content_view_data['form_email']					= $this->input->post('email');
				$content_view_data['form_first_name'] 				= $this->input->post('first_name');
				$content_view_data['form_last_name']				= $this->input->post('last_name');
				$content_view_data['form_user_email']				= $this->input->post('email') != '' ? $this->input->post('email') : $user_data['email'];
	   		}	
    	}
    	else
    	{
    		$content_view_data['form_id']				= $user_data['id'];
	    	$content_view_data['form_first_name'] 		= $user_data['first_name'];
	    	$content_view_data['form_last_name'] 		= $user_data['last_name'];
	    	$content_view_data['form_user_email'] 		= $user_data['email'];
	    }
	    
	    $content_view_data['user_update_form'] = $this->parser->parse('admin_update_user_view.php', $content_view_data, TRUE);
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

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */