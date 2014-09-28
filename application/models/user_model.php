<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Model, manages all the actions related to the user, including password hashing, login, data updates
 *
 * Even though fields in the database and in the array objects are the same, they are explicitely assigned. 
 * In this way the user model provides an interface hiding the structure of the database
 */
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database('projsicurezza');
    }
    
    /**
     * Hashes password for registration and login
     *
     * @access protected
     * @param string, int
     * @return string
     */
    protected function hash_password($password, $rounds = 7)
    {
    	$salt = "";
    	$salt_chars = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    	for($i=0; $i < 22; $i++) {
      		$salt .= $salt_chars[mt_rand(0, 63)];
    	}
    	
    	return crypt($password, sprintf('$2a$%02d$', $rounds) . $salt);
    }
    
    /**
     * Checks if the user exists, using the email passed as parameter
     * 
     * @access public
     * @param string
     * @return boolean
     */
    public function check_if_user_exists($email)
    {
    	$query = $this->db->get_where('users', array('email' => $email));
    	return $query->num_rows() > 0;
    }
    
    /**
     * Creates user with the provided data
     *
     * @access public
     * @param array
     * @return boolean
     */
    public function create_user($user_data)
    {
    	// Checks if the user alredy exists
    	if ($this->check_if_user_exists($user_data['email']))
    	{
    		return FALSE;
    	}
    	
    	// Gets id of default role
    	$this->db->select('id');
    	$default_role_id = $this->db->get_where('user_roles', array('is_default_role' => TRUE))->row()->id;
    	
    	// Creates the array with user data to insert in the database
    	$db_user_data = array(
    		'email'			=> $user_data['email'],
    		'password'		=> $this->hash_password($user_data['password']),
    		'first_name'	=> $user_data['first_name'],
    		'last_name'		=> $user_data['last_name'],
    		'role'			=> $default_role_id
    	);
    	
    	// Saves the user to the database
    	$this->db->insert('users', $db_user_data); 
    	
    	return TRUE;
    }
    
    /**
     * Updates user with the provided data
     *
     * @access public
     * @param array
     * @return boolean
     */
    public function update_user($user_data)
    {
    	$db_user_data = array();
    	
    	// Adds to the $db_user_data array only the changed parameters
    	
    	if (isset($user_data['email']))
    	{
    		$db_user_data['email'] = $user_data['email'];
    	}
    	
    	if (isset($user_data['password']))
    	{
    		$db_user_data['password'] = $this->hash_password($user_data['password']);
    	}
    	
    	if (isset($user_data['first_name']))
    	{
    		$db_user_data['first_name'] = $user_data['first_name'];
    	}
    	
    	if (isset($user_data['last_name']))
    	{
    		$db_user_data['last_name'] = $user_data['last_name'];
    	}
    	
    	// Gets the user id from the provided array or the session object
    	$id = isset($user_data['id']) ? $user_data['id'] : $this->session->userdata('user_id');
    	
    	$this->db->where('id', $id);
    	$this->db->update('users', $db_user_data); 
    	
    	return TRUE;
    }
    
    /**
     * Logs in the user with the provided data
     *
     * @access public
     * @param array
     * @return boolean
     */
    public function login_user($user_data)
    {
    	// Gets the user info and checks if the user exists
    	$user_query = $this->db->get_where('users', array('email' => $user_data['email']));
    	if ($user_query->num_rows() == 0)
    	{
    		return FALSE;
    	}
    	
    	$user = $user_query->row();

		// Checks if the password is correct
    	if (crypt($user_data['password'], $user->password) != $user->password)
    	{
    		return FALSE;
    	}
    	
    	// Sets logged variable and user id in the session object
    	$data_to_set = array(
    		'logged'	=> TRUE,
    		'user_id'	=> $user->id
    	);
		$this->session->set_userdata($data_to_set);
		
   		return TRUE;    	
    }
    
    /**
     * Gets user data with the provided id
     *
     * @access public
     * @param int
     * @return array
     */
    public function get_user_data_by_id($id = null)
    {
    	// Gets the user id from the session object if function argument is empty
    	$id = $id != null ? $id : $this->session->userdata('user_id');
    	
    	// Retrieves info if the user exists, returns otherwise
    	$user_query = $this->db->get_where('users', array('id' => $id));
    	if ($user_query->num_rows() == 0)
    	{
    		return FALSE;
    	}
    	
    	// Returns the info retrieved
    	$user = $user_query->row();
    	    	
    	return array(
    		'email' 		=> $user->email,
    		'first_name' 	=> $user->first_name,
    		'last_name' 	=> $user->last_name,
    		'role' 			=> $user->role
    	);
    }
    
    /**
     * Gets user data with the provided email
     *
     * @access public
     * @param string
     * @return array
     */
    public function get_user_data_by_email($email)
    {
    	// Retrieves info if the user exists, returns otherwise
    	$user_query = $this->db->select('users.id, users.email, users.first_name, users.last_name, user_roles.name AS role_name')
          ->from('users, user_roles')
          ->where('users.email', $email)
          ->where('users.role = user_roles.id')
          ->get();
          
    	if ($user_query->num_rows() == 0)
    	{
    		return FALSE;
    	}  	
        
        // Returns the info retrieved
        $user = $user_query->row();
    	    	
    	return array(
    		'id'			=> $user->id,
    		'email' 		=> $user->email,
    		'first_name' 	=> $user->first_name,
    		'last_name' 	=> $user->last_name,
    		'role' 			=> $user->role_name
    	);
    }
    
    /**
     * Checks if the user is an admin
     *
     * @access public
     * @return boolean
     */
    public function is_admin()
    {
    	$user_data = $this->user_model->get_user_data_by_id();
    	$user_role = $this->db->get_where('user_roles', array('id' => $user_data['role']))->row();
    	return $user_role->manage_other_users;
    }
    
}
