<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Personas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Personas_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'personas/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'personas/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'personas/index.html';
                $config['first_url'] = base_url() . 'personas/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Personas_model->total_rows($q);
            $personas = $this->Personas_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'personas_data' => $personas,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('personas/personas_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Personas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idpersonas' => $row->idpersonas,
		'nombre' => $row->nombre,
		'apellido_paterno' => $row->apellido_paterno,
		'apellido_materno' => $row->apellido_materno,
		'contacto_correo' => $row->contacto_correo,
		'titulo_academico_idtitulo_academico' => $row->titulo_academico_idtitulo_academico,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('personas/personas_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('personas'));
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
            'action' => site_url('personas/create_action'),
	    'idpersonas' => set_value('idpersonas'),
	    'nombre' => set_value('nombre'),
	    'apellido_paterno' => set_value('apellido_paterno'),
	    'apellido_materno' => set_value('apellido_materno'),
	    'contacto_correo' => set_value('contacto_correo'),
	    'titulo_academico_idtitulo_academico' => set_value('titulo_academico_idtitulo_academico'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('personas/personas_form', $data);
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
		'nombre' => $this->input->post('nombre',TRUE),
		'apellido_paterno' => $this->input->post('apellido_paterno',TRUE),
		'apellido_materno' => $this->input->post('apellido_materno',TRUE),
		'contacto_correo' => $this->input->post('contacto_correo',TRUE),
		'titulo_academico_idtitulo_academico' => $this->input->post('titulo_academico_idtitulo_academico',TRUE),
	    );

            $this->Personas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('personas'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Personas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('personas/update_action'),
		'idpersonas' => set_value('idpersonas', $row->idpersonas),
		'nombre' => set_value('nombre', $row->nombre),
		'apellido_paterno' => set_value('apellido_paterno', $row->apellido_paterno),
		'apellido_materno' => set_value('apellido_materno', $row->apellido_materno),
		'contacto_correo' => set_value('contacto_correo', $row->contacto_correo),
		'titulo_academico_idtitulo_academico' => set_value('titulo_academico_idtitulo_academico', $row->titulo_academico_idtitulo_academico),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('personas/personas_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('personas'));
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
            $this->update($this->input->post('idpersonas', TRUE));
        } else {
            $data = array(
		'nombre' => $this->input->post('nombre',TRUE),
		'apellido_paterno' => $this->input->post('apellido_paterno',TRUE),
		'apellido_materno' => $this->input->post('apellido_materno',TRUE),
		'contacto_correo' => $this->input->post('contacto_correo',TRUE),
		'titulo_academico_idtitulo_academico' => $this->input->post('titulo_academico_idtitulo_academico',TRUE),
	    );

            $this->Personas_model->update($this->input->post('idpersonas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('personas'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Personas_model->get_by_id($id);

        if ($row) {
            $this->Personas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('personas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('personas'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
	$this->form_validation->set_rules('apellido_paterno', 'apellido paterno', 'trim|required');
	$this->form_validation->set_rules('apellido_materno', 'apellido materno', 'trim|required');
	$this->form_validation->set_rules('contacto_correo', 'contacto correo', 'trim|required');
	$this->form_validation->set_rules('titulo_academico_idtitulo_academico', 'titulo academico idtitulo academico', 'trim|required');

	$this->form_validation->set_rules('idpersonas', 'idpersonas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "personas.xls";
        $judul = "personas";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nombre");
	xlsWriteLabel($tablehead, $kolomhead++, "Apellido Paterno");
	xlsWriteLabel($tablehead, $kolomhead++, "Apellido Materno");
	xlsWriteLabel($tablehead, $kolomhead++, "Contacto Correo");
	xlsWriteLabel($tablehead, $kolomhead++, "Titulo Academico Idtitulo Academico");

	foreach ($this->Personas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nombre);
	    xlsWriteLabel($tablebody, $kolombody++, $data->apellido_paterno);
	    xlsWriteLabel($tablebody, $kolombody++, $data->apellido_materno);
	    xlsWriteLabel($tablebody, $kolombody++, $data->contacto_correo);
	    xlsWriteNumber($tablebody, $kolombody++, $data->titulo_academico_idtitulo_academico);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=personas.doc");

        $data = array(
            'personas_data' => $this->Personas_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('personas/personas_doc',$data);
    }

}

/* End of file Personas.php */
/* Location: ./application/controllers/Personas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */