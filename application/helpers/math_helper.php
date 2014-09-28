<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('real_mod'))
{
	function real_mod($number, $mod) {
		return ($mod + ($number % $mod)) % $mod;
	}
}