<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*
* Helpers functions used to create the url for css/image/javascript files
*
*/

if (!function_exists('css_file'))
{
	function css_file($filename)
	{
		echo base_url() . 'css/' . $filename . '.css';
	}
}

if (!function_exists('image_file'))
{
	function image_file($filename)
	{
		echo base_url() . 'image/' . $filename;
	}
}

if (!function_exists('js_file'))
{
	function js_file($filename)
	{
		echo base_url() . 'js/' . $filename . '.js';
	}
}