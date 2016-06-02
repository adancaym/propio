<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller {

	function index(){
		
		echo $this->input->post('editor1');
	}
}
