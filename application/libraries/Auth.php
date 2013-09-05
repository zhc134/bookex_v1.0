<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth {

	var $CI;

	public function __construct()
	{
		// Set the super object to a local variable for use later
		$this->CI =& get_instance();
		$this->CI->load->model('user_model');
		$this->CI->load->model('book_model');
	}

	function is_admin() {
		return $this->CI->user_model->is_admin();
	}

	function is_uploader($book_id) {
		return $this->CI->book_model->is_uploader($book_id);
	}

	function is_subscriber($book_id) {
		return $this->CI->book_model->is_subscriber($book_id);
	}

	function auth_denied() {
		redirect('login');
	}

	function admin() {
		if (!$this->is_admin()) $this->auth_denied();
	}

	function uploader($book_id) {
		if (!$this->is_uploader($book_id) && !$this->is_admin()) $this->auth_denied();
	}

	function subscriber($book_id) {
		if (!$this->is_subscriber($book_id) && !$this->is_admin()) $this->auth_denied();
	}

	function uploader_or_subscriber($book_id) {
		if (!$this->is_subscriber($book_id) && !$this->is_uploader($book_id) && !$this->is_admin()) $this->auth_denied();
	}
}