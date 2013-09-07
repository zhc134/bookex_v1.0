<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$first = ($this->session->userdata('first') !== true);
		if (isMobile() && $first) {
			$data = array(
				'first' => true
			);
			$this->session->set_userdata($data);
			$this->load->view('mobile');
		}
		else {
			$data["first"] = false;
			if (!$this->session->userdata('is_logged_in')) {
				$data["first"] = true;
			}
			if (1>0) {
				$this->load->model('recommend_model');
				$data["recommend"]=$this->recommend_model->getResult();
			}
			$this->load->view('index', $data);
		}
	}

	function about() {
		$data['data']['title'] = '关于';
		$this->load->view('about');
	}

	function contact() {
		$data['data']['title'] = '联系我们';
		$this->load->view('contact');
	}

	function act_detail() {
		$this->load->view('act_detail');
	}

	function prize_user() {
		$this->load->view('prize_user');
	}

	function norespon() {
        $this->load->view("norespon");
    }

    function tips_for_internet_connection() {
        $this->load->view("tips_for_internet_connection");
    }

    function chrome_connection() {
        $this->load->view("chrome_connection");
    }

    function ie_connection() {
        $this->load->view("ie_connection");
    }

    function firefox_connection() {
        $this->load->view("firefox_connection");
    }

}
