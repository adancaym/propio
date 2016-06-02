<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->load->view('partial/header');
		$this->load->view('partial/login');
		$this->load->view('partial/footer');
	}
}
