<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Login extends CI_Controller 
{
	public function __construct()
		{
			parent::__construct();
			//cargamos modelos
		}
	public function index()
		{
				
		}
	function login()
	{
		if( $this->input->post('usuario')=='a' && $this->input->post('contra')=='a')
			{					
				$this->session->set_userdata(md5('admin'),'admin' );
				redirect('welcome','refresh');
			}
		else
			{
		    	$this->session->set_flashdata('message', 'No se logró iniciar sesión');
		    	redirect('welcome','refresh');
			}	
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('welcome','refresh');
	}
}
	
	/* End of file Login.php */
	/* Location: ./application/controllers/Login.php */
 ?>