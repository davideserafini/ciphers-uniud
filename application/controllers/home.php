<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
    	// Loads user model
    	$this->load->model('user_model');
    	
    	// Global site check: redirects to login if user's already logged in
    	$this->site_authorization->redirect_if_not_logged(array('redirect' => 'login', 'back_to' => uri_string()));
    	
    	// Loads libraries for parsing templates
    	$this->load->library(array('parser'));
		
        $view_data = array(
        	'registration_success'	=> '',
        	'page_title'			=> 'home',
        	'page_content'			=> '',
        	'is_admin'				=> '',
        	'page_left_menu'		=> '',
        	'page_footer'			=> ''
        );
        
        // Show "just registered" message if needed
        if ($this->session->flashdata('just_registered') == TRUE)
        {
        	$view_data['registration_success'] = '<div class="success_message">You have successfully registered! Start discovering the site right from the menu on the left and have fun</div>';
        }
        
        $view_data['is_admin']			= $this->user_model->is_admin();
        $view_data['page_left_menu']	= $this->load->view('left_menu_view', $view_data, TRUE);
        $view_data['page_footer'] 		= $this->load->view('footer_view', '', TRUE);
        $view_data['page_content']		= $this->parser->parse('home_view', $view_data, TRUE);
        
        $this->parser->parse('main_view', $view_data);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */