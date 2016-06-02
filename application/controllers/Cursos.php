<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cursos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cursos_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'cursos/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'cursos/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'cursos/index.html';
                $config['first_url'] = base_url() . 'cursos/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Cursos_model->total_rows($q);
            $cursos = $this->Cursos_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'cursos_data' => $cursos,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('cursos/cursos_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Cursos_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idcursos' => $row->idcursos,
		'nombre' => $row->nombre,
		'duracion' => $row->duracion,
		'especialidades_idespecialidades' => $row->especialidades_idespecialidades,
		'clv_curso' => $row->clv_curso,
		'ficha_tecnica' => $row->ficha_tecnica,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('cursos/cursos_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cursos'));
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
            'action' => site_url('cursos/create_action'),
	    'idcursos' => set_value('idcursos'),
	    'nombre' => set_value('nombre'),
	    'duracion' => set_value('duracion'),
	    'especialidades_idespecialidades' => set_value('especialidades_idespecialidades'),
	    'clv_curso' => set_value('clv_curso'),
	    'ficha_tecnica' => set_value('ficha_tecnica'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('cursos/cursos_form', $data);
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
		'duracion' => $this->input->post('duracion',TRUE),
		'especialidades_idespecialidades' => $this->input->post('especialidades_idespecialidades',TRUE),
		'clv_curso' => $this->input->post('clv_curso',TRUE),
		'ficha_tecnica' => $this->input->post('ficha_tecnica',TRUE),
	    );

            $this->Cursos_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('cursos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Cursos_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cursos/update_action'),
		'idcursos' => set_value('idcursos', $row->idcursos),
		'nombre' => set_value('nombre', $row->nombre),
		'duracion' => set_value('duracion', $row->duracion),
		'especialidades_idespecialidades' => set_value('especialidades_idespecialidades', $row->especialidades_idespecialidades),
		'clv_curso' => set_value('clv_curso', $row->clv_curso),
		'ficha_tecnica' => set_value('ficha_tecnica', $row->ficha_tecnica),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('cursos/cursos_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cursos'));
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
            $this->update($this->input->post('idcursos', TRUE));
        } else {
            $data = array(
		'nombre' => $this->input->post('nombre',TRUE),
		'duracion' => $this->input->post('duracion',TRUE),
		'especialidades_idespecialidades' => $this->input->post('especialidades_idespecialidades',TRUE),
		'clv_curso' => $this->input->post('clv_curso',TRUE),
		'ficha_tecnica' => $this->input->post('ficha_tecnica',TRUE),
	    );

            $this->Cursos_model->update($this->input->post('idcursos', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('cursos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Cursos_model->get_by_id($id);

        if ($row) {
            $this->Cursos_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('cursos'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cursos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
	$this->form_validation->set_rules('duracion', 'duracion', 'trim|required');
	$this->form_validation->set_rules('especialidades_idespecialidades', 'especialidades idespecialidades', 'trim|required');
	$this->form_validation->set_rules('clv_curso', 'clv curso', 'trim|required');
	$this->form_validation->set_rules('ficha_tecnica', 'ficha tecnica', 'trim|required');

	$this->form_validation->set_rules('idcursos', 'idcursos', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "cursos.xls";
        $judul = "cursos";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Duracion");
	xlsWriteLabel($tablehead, $kolomhead++, "Especialidades Idespecialidades");
	xlsWriteLabel($tablehead, $kolomhead++, "Clv Curso");
	xlsWriteLabel($tablehead, $kolomhead++, "Ficha Tecnica");

	foreach ($this->Cursos_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nombre);
	    xlsWriteLabel($tablebody, $kolombody++, $data->duracion);
	    xlsWriteNumber($tablebody, $kolombody++, $data->especialidades_idespecialidades);
	    xlsWriteLabel($tablebody, $kolombody++, $data->clv_curso);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ficha_tecnica);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=cursos.doc");

        $data = array(
            'cursos_data' => $this->Cursos_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('cursos/cursos_doc',$data);
    }

}

/* End of file Cursos.php */
/* Location: ./application/controllers/Cursos.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */