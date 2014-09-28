<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_validation {
	
	private function _check_valid_char_password($password)
	{
		$allowed_chars = "/^[a-zA-Z0-9@#!?\-_\[\]\£\$\%\&;,:.=\^()]*$/";
		return preg_match($allowed_chars, $password);
	}

	private function _check_valid_char_name($name)
	{
		$allowed_chars = "/^[a-zA-Z\s\-\.]*$/";
		return preg_match($allowed_chars, $name);
	}

	function valid_password($password)
	{
		if($this->_check_valid_char_password($password))
		{
			return TRUE;
		}
		return FALSE;
	}

	function valid_name($name)
	{
		if($this->_check_valid_char_name($name))
		{
			return TRUE;
		}
		return FALSE;
	}

}

/* End of file Input_validation.php */
/* Location: ./application/libraries/Input_validation.php */