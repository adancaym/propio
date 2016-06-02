<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Titulo_academico extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Titulo_academico_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'titulo_academico/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'titulo_academico/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'titulo_academico/index.html';
                $config['first_url'] = base_url() . 'titulo_academico/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Titulo_academico_model->total_rows($q);
            $titulo_academico = $this->Titulo_academico_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'titulo_academico_data' => $titulo_academico,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('titulo_academico/titulo_academico_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Titulo_academico_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idtitulo_academico' => $row->idtitulo_academico,
		'abreviatura' => $row->abreviatura,
		'titulo' => $row->titulo,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('titulo_academico/titulo_academico_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('titulo_academico'));
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
            'action' => site_url('titulo_academico/create_action'),
	    'idtitulo_academico' => set_value('idtitulo_academico'),
	    'abreviatura' => set_value('abreviatura'),
	    'titulo' => set_value('titulo'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('titulo_academico/titulo_academico_form', $data);
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
		'abreviatura' => $this->input->post('abreviatura',TRUE),
		'titulo' => $this->input->post('titulo',TRUE),
	    );

            $this->Titulo_academico_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('titulo_academico'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Titulo_academico_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('titulo_academico/update_action'),
		'idtitulo_academico' => set_value('idtitulo_academico', $row->idtitulo_academico),
		'abreviatura' => set_value('abreviatura', $row->abreviatura),
		'titulo' => set_value('titulo', $row->titulo),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('titulo_academico/titulo_academico_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('titulo_academico'));
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
            $this->update($this->input->post('idtitulo_academico', TRUE));
        } else {
            $data = array(
		'abreviatura' => $this->input->post('abreviatura',TRUE),
		'titulo' => $this->input->post('titulo',TRUE),
	    );

            $this->Titulo_academico_model->update($this->input->post('idtitulo_academico', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('titulo_academico'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Titulo_academico_model->get_by_id($id);

        if ($row) {
            $this->Titulo_academico_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('titulo_academico'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('titulo_academico'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('abreviatura', 'abreviatura', 'trim|required');
	$this->form_validation->set_rules('titulo', 'titulo', 'trim|required');

	$this->form_validation->set_rules('idtitulo_academico', 'idtitulo_academico', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "titulo_academico.xls";
        $judul = "titulo_academico";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Abreviatura");
	xlsWriteLabel($tablehead, $kolomhead++, "Titulo");

	foreach ($this->Titulo_academico_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->abreviatura);
	    xlsWriteLabel($tablebody, $kolombody++, $data->titulo);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=titulo_academico.doc");

        $data = array(
            'titulo_academico_data' => $this->Titulo_academico_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('titulo_academico/titulo_academico_doc',$data);
    }

}

/* End of file Titulo_academico.php */
/* Location: ./application/controllers/Titulo_academico.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:51 */
/* http://harviacode.com */