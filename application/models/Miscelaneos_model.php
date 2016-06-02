<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Miscelaneos_model extends CI_Model {

	function get_tablas(){

	return $this->db->list_tables();
	}

}

/* End of file Miscelaneos.php */
/* Location: ./application/models/Miscelaneos.php */