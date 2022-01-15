<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {
	private $template_data = array();
	private $CI;

	function __construct(){
		$this->CI =& get_instance();		
	}

	public function load($template, $view, $view_data = array(), $target = 'contents', $return = FALSE){               
		$this->set($target, $this->CI->load->view($view, $view_data, TRUE));

		return $this->CI->load->view($template, $this->template_data, $return);
	}
	
	public function set($name, $value){
		if( isset($this->template_data[$name])){
			$this->template_data[$name] .= $value;
		} else {
			$this->template_data[$name] = $value;
		}
	}
}
