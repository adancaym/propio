<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Persona extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Persona_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'persona/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'persona/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'persona/index.html';
                $config['first_url'] = base_url() . 'persona/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Persona_model->total_rows($q);
            $persona = $this->Persona_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'persona_data' => $persona,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('persona/persona_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Persona_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idpersona' => $row->idpersona,
		'correo' => $row->correo,
		'Nombre' => $row->Nombre,
		'paterno' => $row->paterno,
		'materno' => $row->materno,
		'grado_escolar' => $row->grado_escolar,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('persona/persona_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('persona'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function create() 
    {
        if($this->session->userdata(md5('admin'))) {
        $data = array(
            'button' => 'Create',
            'action' => site_url('persona/create_action'),
	    'idpersona' => set_value('idpersona'),
	    'correo' => set_value('correo'),
	    'Nombre' => set_value('Nombre'),
	    'paterno' => set_value('paterno'),
	    'materno' => set_value('materno'),
	    'grado_escolar' => set_value('grado_escolar'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('persona/persona_form', $data);
        $this->load->view('partial/footer');    
    }
        else {
            redirect('Welcome','refresh');
        }
}
    
    public function create_action() 
    {   if($this->session->userdata(md5('admin'))) {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'correo' => $this->input->post('correo',TRUE),
		'Nombre' => $this->input->post('Nombre',TRUE),
		'paterno' => $this->input->post('paterno',TRUE),
		'materno' => $this->input->post('materno',TRUE),
		'grado_escolar' => $this->input->post('grado_escolar',TRUE),
	    );

            $this->Persona_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('persona'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Persona_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('persona/update_action'),
		'idpersona' => set_value('idpersona', $row->idpersona),
		'correo' => set_value('correo', $row->correo),
		'Nombre' => set_value('Nombre', $row->Nombre),
		'paterno' => set_value('paterno', $row->paterno),
		'materno' => set_value('materno', $row->materno),
		'grado_escolar' => set_value('grado_escolar', $row->grado_escolar),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('persona/persona_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('persona'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update_action() 
    {   if($this->session->userdata(md5('admin'))) {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idpersona', TRUE));
        } else {
            $data = array(
		'correo' => $this->input->post('correo',TRUE),
		'Nombre' => $this->input->post('Nombre',TRUE),
		'paterno' => $this->input->post('paterno',TRUE),
		'materno' => $this->input->post('materno',TRUE),
		'grado_escolar' => $this->input->post('grado_escolar',TRUE),
	    );

            $this->Persona_model->update($this->input->post('idpersona', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('persona'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Persona_model->get_by_id($id);

        if ($row) {
            $this->Persona_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('persona'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('persona'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('correo', 'correo', 'trim|required');
	$this->form_validation->set_rules('Nombre', 'nombre', 'trim|required');
	$this->form_validation->set_rules('paterno', 'paterno', 'trim|required');
	$this->form_validation->set_rules('materno', 'materno', 'trim|required');
	$this->form_validation->set_rules('grado_escolar', 'grado escolar', 'trim|required');

	$this->form_validation->set_rules('idpersona', 'idpersona', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "persona.xls";
        $judul = "persona";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Correo");
	xlsWriteLabel($tablehead, $kolomhead++, "Nombre");
	xlsWriteLabel($tablehead, $kolomhead++, "Paterno");
	xlsWriteLabel($tablehead, $kolomhead++, "Materno");
	xlsWriteLabel($tablehead, $kolomhead++, "Grado Escolar");

	foreach ($this->Persona_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->correo);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nombre);
	    xlsWriteLabel($tablebody, $kolombody++, $data->paterno);
	    xlsWriteLabel($tablebody, $kolombody++, $data->materno);
	    xlsWriteLabel($tablebody, $kolombody++, $data->grado_escolar);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=persona.doc");

        $data = array(
            'persona_data' => $this->Persona_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('persona/persona_doc',$data);
    }

}

/* End of file Persona.php */
/* Location: ./application/controllers/Persona.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */