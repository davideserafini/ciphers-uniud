<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ciphers extends CI_Controller {

    public function index()
    {
    	// Loads user model
    	$this->load->model('user_model');
    	
    	// Global site check: redirects to login if user's already logged in
    	$this->site_authorization->redirect_if_not_logged(array('redirect' => 'login', 'back_to' => uri_string()));
    	
    	// Loads libraries for parsing templates
    	$this->load->library(array('parser'));
		
        $view_data = array(
        	'page_title'			=> '',
        	'page_content'			=> '',
        	'is_admin'				=> '',
        	'page_left_menu'		=> '',
        	'page_footer'			=> ''
        );
        
        $view_data['is_admin']			= $this->user_model->is_admin();
        $view_data['page_left_menu']	= $this->load->view('left_menu_view', $view_data, TRUE);
        $view_data['page_footer'] 		= $this->load->view('footer_view', '', TRUE);
        $view_data['page_content']		= $this->parser->parse('ciphers_view', $view_data, TRUE);
        
        $this->parser->parse('main_view', $view_data);
    }
    
    public function railfence()
    {
    	// Loads user model
    	$this->load->model('user_model');
    	
    	// Global site check: redirects to login if user's already logged in
    	$this->site_authorization->redirect_if_not_logged(array('redirect' => 'login', 'back_to' => uri_string()));
    	
    	// Loads form helper
    	$this->load->helper('form');
    	
    	// Loads libraries for form validations and parsing templates
    	$this->load->library(array('parser', 'form_validation'));
		
        $view_data = array(
        	'page_title'			=> 'rail fence',
        	'page_content'			=> '',
        	'is_admin'				=> '',
        	'page_left_menu'		=> '',
        	'page_footer'			=> ''
        );
        
        $content_view_data = array(
        	'form_error'					=> '',
        	'form_key'						=> 3,
        	'form_plaintext'				=> '',
        	'form_encrypted_text'			=> ''
        );
        
        if(($this->input->post('crypt') || $this->input->post('decrypt')))
        {
        	$this->form_validation->set_rules('key', 'key', 'trim|required|numeric');
			
			// Rules for crypting
			if ($this->input->post('crypt'))
			{
				$this->form_validation->set_rules('plaintext', 'plaintext', 'trim|required');
				$content_view_data['form_plaintext'] = $this->input->post('plaintext');
			} 
			// Rules for decrypting
			else if ($this->input->post('decrypt'))
			{
				$this->form_validation->set_rules('encrypted_text', 'encrypted text', 'trim|required');
				$content_view_data['form_encrypted_text'] = $this->input->post('encrypted_text');
			}
		
        	if ($this->form_validation->run() == FALSE)
        	{
				$this->form_validation->set_error_delimiters('<div class="validation_error width100 spacerB5">', '</div>');
				
				$error_message = "";
				$error_message .= form_error('key');
				$error_message .= form_error('plaintext');
				$error_message .= form_error('encrypted_text');
				$content_view_data['form_error'] = $error_message;
			}
			else
			{	
				$key = $this->input->post('key');
				
				// Algorithm for crypting
				if ($this->input->post('crypt'))
				{
					$plaintext = preg_replace('/[^a-z]/', '', strtolower($this->input->post('plaintext')));
					$encryptedText = array();
					
					$line = 0;
					for ($line = 0; $line < $key - 1; $line++)
					{
						$jump = 2 * ($key - $line - 1);
						$j = 0;
						$i = $line;
						
						while ($i < strlen($plaintext))
						{
							$encryptedText[] = $plaintext[$i];
							if ($line == 0 || ($j % 2 == 0))
							{
								$i += $jump;
							}
							else
							{
								$i += 2 * ($key - 1) - $jump;
							}
							$j++;
						}
					}
					
					for ($i = $line; $i < strlen($plaintext); $i += 2 * ($key - 1))
					{
						$encryptedText[] = $plaintext[$i];	
					}
					
					$content_view_data['form_encrypted_text'] = implode($encryptedText);
				}
				// Algorithm for decrypting
				else
				{
					$encryptedText = preg_replace('/[^a-z]/', '', strtolower($this->input->post('encrypted_text')));
					$plaintext = array();
					
					$line = 0;
					$k = 0;
					for ($line = 0; $line < $key - 1; $line++)
					{
						$jump = 2 * ($key - $line - 1);
						$j = 0;
						$i = $line;
						
						while ($i < strlen($encryptedText))
						{
							$plaintext[$i] = $encryptedText[$k++];
							if ($line == 0 || ($j % 2 == 0))
							{
								$i += $jump;
							}
							else
							{
								$i += 2 * ($key - 1) - $jump;
							}
							$j++;
						}
					}
					
					for ($i = $line; $i < strlen($encryptedText); $i += 2 * ($key - 1))
					{
						$plaintext[$i] = $encryptedText[$k++];	
					}
					
					ksort($plaintext);
					
					$content_view_data['form_plaintext'] = implode($plaintext);
				}
			}
			$content_view_data['form_key'] = $this->input->post('key');
        }
        
        $view_data['is_admin']			= $this->user_model->is_admin();
        $view_data['page_left_menu']	= $this->load->view('left_menu_view', $view_data, TRUE);
        $view_data['page_footer'] 		= $this->load->view('footer_view', '', TRUE);
        $view_data['page_content']		= $this->parser->parse('ciphers/railfence_view', $content_view_data, TRUE);
        
        $this->parser->parse('main_view', $view_data);
    }
    
    public function caesar()
    {
    	// Loads user model
    	$this->load->model('user_model');
    	
    	// Global site check: redirects to login if user's already logged in
    	$this->site_authorization->redirect_if_not_logged(array('redirect' => 'login', 'back_to' => uri_string()));
    	
    	// Loads form and math helpers
    	$this->load->helper(array('form', 'math'));
    	
    	// Loads libraries for form validations and parsing templates
    	$this->load->library(array('parser', 'form_validation'));
		
        $view_data = array(
        	'page_title'			=> 'caesar',
        	'page_content'			=> '',
        	'is_admin'				=> '',
        	'page_left_menu'		=> '',
        	'page_footer'			=> ''
        );
        
        $content_view_data = array(
        	'form_error'					=> '',
        	'form_key'						=> '',
        	'form_plaintext'				=> '',
        	'form_encrypted_text'			=> ''
        );
        for ($i=1; $i<=26; $i++)
        {
        	$content_view_data['form_key_' . $i . '_selected'] = '';
        }
        
        if(($this->input->post('crypt') || $this->input->post('decrypt')))
        {
        	$this->form_validation->set_rules('key', 'key', 'trim|required|numeric');
			
			// Rules for crypting
			if ($this->input->post('crypt'))
			{
				$this->form_validation->set_rules('plaintext', 'plaintext', 'trim|required');
				$content_view_data['form_plaintext'] = $this->input->post('plaintext');
			} 
			// Rules for decrypting
			else if ($this->input->post('decrypt'))
			{
				$this->form_validation->set_rules('encrypted_text', 'encrypted text', 'trim|required');
				$content_view_data['form_encrypted_text'] = $this->input->post('encrypted_text');
			}
		
        	if ($this->form_validation->run() == FALSE)
        	{
				$this->form_validation->set_error_delimiters('<div class="validation_error width100 spacerB5">', '</div>');
				
				$error_message = "";
				$error_message .= form_error('key');
				$error_message .= form_error('plaintext');
				$error_message .= form_error('encrypted_text');
				$content_view_data['form_error'] = $error_message;
			}
			else
			{
				$alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
				
				// Algorithm for crypting
				if ($this->input->post('crypt'))
				{
					$plaintext = preg_replace('/[^a-z]/', '', strtolower($this->input->post('plaintext')));
					$encryptedTextArray = array();
					
					for ($i = 0; $i < strlen($plaintext); $i++)
					{
						$index = array_search($plaintext[$i], $alphabet);
						$encryptedTextArray[] = $alphabet[real_mod($index + $this->input->post('key'), 26)];
					}
					
					$content_view_data['form_encrypted_text'] = implode($encryptedTextArray);
				}
				// Algorithm for decrypting
				else
				{
					$encryptedText = preg_replace('/[^a-z]/', '', strtolower($this->input->post('encrypted_text')));
					$plaintextArray = array();
					
					for ($i = 0; $i < strlen($encryptedText); $i++)
					{
						$index = array_search($encryptedText[$i], $alphabet);
						$plaintextArray[] = $alphabet[real_mod($index - $this->input->post('key'), 26)];
					}
					
					$content_view_data['form_plaintext'] = implode($plaintextArray);
				}
			}
        }
        
        $content_view_data['form_key'] = $this->input->post('key');
        for ($i=1; $i<=26; $i++)
        {
        	$content_view_data['form_key_' . $i . '_selected'] = set_select('key', $i);
        }
        
        $view_data['is_admin']			= $this->user_model->is_admin();
        $view_data['page_left_menu']	= $this->load->view('left_menu_view', $view_data, TRUE);
        $view_data['page_footer'] 		= $this->load->view('footer_view', '', TRUE);
        $view_data['page_content']		= $this->parser->parse('ciphers/caesar_view', $content_view_data, TRUE);
        
        $this->parser->parse('main_view', $view_data);
    }
    
    public function vigenere()
    {
    	// Loads user model
    	$this->load->model('user_model');
    	
    	// Global site check: redirects to login if user's already logged in
    	$this->site_authorization->redirect_if_not_logged(array('redirect' => 'login', 'back_to' => uri_string()));
    	
    	// Loads form and math helpers
    	$this->load->helper(array('form', 'math'));
    	
    	// Loads libraries for form validations and parsing templates
    	$this->load->library(array('parser', 'form_validation'));
		
        $view_data = array(
        	'page_title'			=> 'vigenère',
        	'page_content'			=> '',
        	'is_admin'				=> '',
        	'page_left_menu'		=> '',
        	'page_footer'			=> ''
        );
        
        $content_view_data = array(
        	'form_error'					=> '',
        	'form_key'						=> '',
        	'form_plaintext'				=> '',
        	'form_encrypted_text'			=> ''
        );
        
        if(($this->input->post('crypt') || $this->input->post('decrypt')))
        {
        	$this->form_validation->set_rules('key', 'key', 'trim|required|alpha');
			
			// Rules for crypting
			if ($this->input->post('crypt'))
			{
				$this->form_validation->set_rules('plaintext', 'plaintext', 'trim|required');
				$content_view_data['form_plaintext'] = $this->input->post('plaintext');
			} 
			// Rules for decrypting
			else if ($this->input->post('decrypt'))
			{
				$this->form_validation->set_rules('encrypted_text', 'encrypted text', 'trim|required');
				$content_view_data['form_encrypted_text'] = $this->input->post('encrypted_text');
			}
		
        	if ($this->form_validation->run() == FALSE)
        	{
				$this->form_validation->set_error_delimiters('<div class="validation_error width100 spacerB5">', '</div>');
				
				$error_message = "";
				$error_message .= form_error('key');
				$error_message .= form_error('plaintext');
				$error_message .= form_error('encrypted_text');
				$content_view_data['form_error'] = $error_message;
			}
			else
			{
				$alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
				$key = $this->input->post('key');
	
				// Algorithm for crypting
				if ($this->input->post('crypt'))
				{
					$plaintext = preg_replace('/[^a-z]/', '', strtolower($this->input->post('plaintext')));
					$encryptedTextArray = array();
					
					for ($i = 0; $i < strlen($plaintext); $i++)
					{
						$positionInTheAlphabet = array_search($plaintext[$i], $alphabet);
						$keyPositionInTheAlphabet = array_search($key[real_mod($i, strlen($key))], $alphabet);
						$encryptedTextArray[] = $alphabet[real_mod($positionInTheAlphabet + $keyPositionInTheAlphabet, 26)];
					}
					
					$content_view_data['form_encrypted_text'] = implode($encryptedTextArray);
				}
				// Algorithm for decrypting
				else
				{
					$encryptedText = preg_replace('/[^a-z]/', '', strtolower($this->input->post('encrypted_text')));
					$plaintextArray = array();
					
					for ($i = 0; $i < strlen($encryptedText); $i++)
					{
						$positionInTheAlphabet = array_search($encryptedText[$i], $alphabet);
						$keyPositionInTheAlphabet = array_search($key[real_mod($i, strlen($key))], $alphabet);
						$plaintextArray[] = $alphabet[real_mod($positionInTheAlphabet - $keyPositionInTheAlphabet, 26)];
					}
					
					$content_view_data['form_plaintext'] = implode($plaintextArray);
				}
			}
        }
        
        $content_view_data['form_key'] = $this->input->post('key');
        
        $view_data['is_admin']			= $this->user_model->is_admin();
        $view_data['page_left_menu']	= $this->load->view('left_menu_view', $view_data, TRUE);
        $view_data['page_footer'] 		= $this->load->view('footer_view', '', TRUE);
        $view_data['page_content']		= $this->parser->parse('ciphers/vigenere_view', $content_view_data, TRUE);
        
        $this->parser->parse('main_view', $view_data);
    }
    
    public function aes()
    {
    	// Loads user model
    	$this->load->model('user_model');
    	
    	// Global site check: redirects to login if user's already logged in
    	$this->site_authorization->redirect_if_not_logged(array('redirect' => 'login', 'back_to' => uri_string()));
    	
    	// Loads form helper
    	$this->load->helper('form');
    	
    	// Loads libraries for form validations and parsing templates
    	$this->load->library(array('parser', 'form_validation'));
		
        $view_data = array(
        	'page_title'			=> 'AES',
        	'page_content'			=> '',
        	'is_admin'				=> '',
        	'page_left_menu'		=> '',
        	'page_footer'			=> ''
        );
        
        $content_view_data = array(
        	'form_error'					=> '',
        	'form_key'						=> '',
        	'form_enc_mode'					=> '',
        	'form_enc_mode_ecb_selected' 	=> '',
        	'form_enc_mode_cbc_selected' 	=> '',
        	'form_enc_mode_ctr_selected' 	=> '',
        	'form_plaintext'				=> '',
        	'form_encrypted_text'			=> ''
        );
                
        if(($this->input->post('crypt') || $this->input->post('decrypt')))
        {
        	$this->form_validation->set_rules('key', 'key', 'trim|required');
			$this->form_validation->set_rules('enc_mode', 'encryption mode', 'trim|required');
		
			// Rules for crypting
			if ($this->input->post('crypt'))
			{
				$this->form_validation->set_rules('plaintext', 'plaintext', 'trim|required');
				$content_view_data['form_plaintext'] = $this->input->post('plaintext');
			} 
			// Rules for decrypting
			else if ($this->input->post('decrypt'))
			{
				$this->form_validation->set_rules('encrypted_text', 'encrypted text', 'trim|required');
				$content_view_data['form_encrypted_text'] = $this->input->post('encrypted_text');
			}
		
        	if ($this->form_validation->run() == FALSE)
        	{
				$this->form_validation->set_error_delimiters('<div class="validation_error width100 spacerB5">', '</div>');
				
				$error_message = "";
				$error_message .= form_error('key');
				$error_message .= form_error('enc_mode');
				$error_message .= form_error('plaintext');
				$error_message .= form_error('encrypted_text');
				$content_view_data['form_error'] = $error_message;
			}
			else
			{
				// Include phpseclib library
				$path = explode(DIRECTORY_SEPARATOR, __DIR__);
				$path[count($path) - 1] = 'libraries';
				$path[count($path)] = 'phpseclib';
				ini_set('include_path', get_include_path(). PATH_SEPARATOR . join($path, DIRECTORY_SEPARATOR));
				include 'Crypt/AES.php';
				
				// Set the encoding mode
				$mode = '';
				switch($this->input->post('enc_mode'))
				{
					case "ecb":
						$mode = CRYPT_AES_MODE_ECB;
						break;
					case "cbc":
						$mode = CRYPT_AES_MODE_CBC;
						break;
					case "ctr":
						$mode = CRYPT_AES_MODE_CTR;
						break;
				}
				
				
				$aes = new Crypt_AES($mode);
				$aes->setKey($this->input->post('key'));
				
				// Crypt
				if ($this->input->post('crypt'))
				{
					$plaintext = $this->input->post('plaintext');
					$content_view_data['form_encrypted_text'] = base64_encode($aes->encrypt($plaintext));
				}
				// Decrypting
				else
				{
					$encryptedText = base64_decode($this->input->post('encrypted_text'));
					$content_view_data['form_plaintext'] = $aes->decrypt($encryptedText);
				}
				
			}
        }
        
        $content_view_data['form_key'] = $this->input->post('key');
        $content_view_data['form_enc_mode_ecb_selected'] = set_select('enc_mode', 'ecb');
        $content_view_data['form_enc_mode_cbc_selected'] = set_select('enc_mode', 'cbc');
        $content_view_data['form_enc_mode_ctr_selected'] = set_select('enc_mode', 'ctr');
        
        $view_data['is_admin']			= $this->user_model->is_admin();
        $view_data['page_left_menu']	= $this->load->view('left_menu_view', $view_data, TRUE);
        $view_data['page_footer'] 		= $this->load->view('footer_view', '', TRUE);
        $view_data['page_content']		= $this->parser->parse('ciphers/aes_view', $content_view_data, TRUE);
        
        $this->parser->parse('main_view', $view_data);
    }
    
    public function rsa()
    {
    	// Loads user model
    	$this->load->model('user_model');
    	
    	// Global site check: redirects to login if user's already logged in
    	$this->site_authorization->redirect_if_not_logged(array('redirect' => 'login', 'back_to' => uri_string()));
    	
    	// Loads form helper
    	$this->load->helper('form');
    	
    	// Loads libraries for form validations and parsing templates
    	$this->load->library(array('parser', 'form_validation'));
		
        $view_data = array(
        	'page_title'			=> 'RSA',
        	'page_content'			=> '',
        	'is_admin'				=> '',
        	'page_left_menu'		=> '',
        	'page_footer'			=> ''
        );
        
        $content_view_data = array(
        	'form_error'					=> '',
        	'form_key'						=> '',
        	'form_plaintext'				=> '',
        	'form_encrypted_text'			=> ''
        );
        
        $this->form_validation->set_rules('key', 'key', 'trim|required');
        
        // Rules for crypting
        if ($this->input->post('crypt'))
        {
        	$this->form_validation->set_rules('plaintext', 'plaintext', 'trim|required');
        	$content_view_data['form_plaintext'] = $this->input->post('plaintext');
        } 
        // Rules for decrypting
        else if ($this->input->post('decrypt'))
        {
        	$this->form_validation->set_rules('encrypted_text', 'encrypted text', 'trim|required');
        	$content_view_data['form_encrypted_text'] = $this->input->post('encrypted_text');
        }
                
        if(($this->input->post('crypt') || $this->input->post('decrypt')))
        {
        	if ($this->form_validation->run() == FALSE)
        	{
				$this->form_validation->set_error_delimiters('<div class="validation_error width100 spacerB5">', '</div>');
				
				$error_message = "";
				$error_message .= form_error('key');
				$error_message .= form_error('plaintext');
				$error_message .= form_error('encrypted_text');
				$content_view_data['form_error'] = $error_message;
			}
			else
			{
				// Include phpseclib library
				$path = explode(DIRECTORY_SEPARATOR, __DIR__);
				$path[count($path) - 1] = 'libraries';
				$path[count($path)] = 'phpseclib';
				ini_set('include_path', get_include_path(). PATH_SEPARATOR . join($path, DIRECTORY_SEPARATOR));
				include 'Crypt/RSA.php';
				
				$rsa = new Crypt_RSA();
				$rsa->loadKey($this->input->post('key'));
				
				// Crypt
				if ($this->input->post('crypt'))
				{
					$plaintext = $this->input->post('plaintext');
					$content_view_data['form_encrypted_text'] = base64_encode($rsa->encrypt($plaintext));
				}
				// Decrypt
				else
				{
					$encryptedText = base64_decode($this->input->post('encrypted_text'));
					$content_view_data['form_plaintext'] = $rsa->decrypt($encryptedText);
				}
				
			}
        }
        
        $content_view_data['form_key'] = $this->input->post('key');
        $content_view_data['form_iv'] = $this->input->post('iv');
        $content_view_data['form_enc_mode_ecb_selected'] = set_select('enc_mode', 'ecb');
        $content_view_data['form_enc_mode_cbc_selected'] = set_select('enc_mode', 'cbc');
        $content_view_data['form_enc_mode_ctr_selected'] = set_select('enc_mode', 'ctr');
        
        $view_data['is_admin']			= $this->user_model->is_admin();
        $view_data['page_left_menu']	= $this->load->view('left_menu_view', $view_data, TRUE);
        $view_data['page_footer'] 		= $this->load->view('footer_view', '', TRUE);
        $view_data['page_content']		= $this->parser->parse('ciphers/rsa_view', $content_view_data, TRUE);
        
        $this->parser->parse('main_view', $view_data);
    }

}

/* End of file ciphers.php */
/* Location: ./application/controllers/ciphers.php */