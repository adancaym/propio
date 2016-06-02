<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contenidos_has_archivos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contenidos_has_archivos_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'contenidos_has_archivos/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'contenidos_has_archivos/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'contenidos_has_archivos/index.html';
                $config['first_url'] = base_url() . 'contenidos_has_archivos/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Contenidos_has_archivos_model->total_rows($q);
            $contenidos_has_archivos = $this->Contenidos_has_archivos_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'contenidos_has_archivos_data' => $contenidos_has_archivos,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('contenidos_has_archivos/contenidos_has_archivos_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Contenidos_has_archivos_model->get_by_id($id);
        if ($row) {
            $data = array(
		'contenidos_has_archivos' => $row->contenidos_has_archivos,
		'contenidos_idcontenidos' => $row->contenidos_idcontenidos,
		'archivos_idarchivos' => $row->archivos_idarchivos,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('contenidos_has_archivos/contenidos_has_archivos_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contenidos_has_archivos'));
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
            'action' => site_url('contenidos_has_archivos/create_action'),
	    'contenidos_has_archivos' => set_value('contenidos_has_archivos'),
	    'contenidos_idcontenidos' => set_value('contenidos_idcontenidos'),
	    'archivos_idarchivos' => set_value('archivos_idarchivos'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('contenidos_has_archivos/contenidos_has_archivos_form', $data);
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
		'contenidos_idcontenidos' => $this->input->post('contenidos_idcontenidos',TRUE),
		'archivos_idarchivos' => $this->input->post('archivos_idarchivos',TRUE),
	    );

            $this->Contenidos_has_archivos_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('contenidos_has_archivos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Contenidos_has_archivos_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('contenidos_has_archivos/update_action'),
		'contenidos_has_archivos' => set_value('contenidos_has_archivos', $row->contenidos_has_archivos),
		'contenidos_idcontenidos' => set_value('contenidos_idcontenidos', $row->contenidos_idcontenidos),
		'archivos_idarchivos' => set_value('archivos_idarchivos', $row->archivos_idarchivos),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('contenidos_has_archivos/contenidos_has_archivos_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contenidos_has_archivos'));
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
            $this->update($this->input->post('contenidos_has_archivos', TRUE));
        } else {
            $data = array(
		'contenidos_idcontenidos' => $this->input->post('contenidos_idcontenidos',TRUE),
		'archivos_idarchivos' => $this->input->post('archivos_idarchivos',TRUE),
	    );

            $this->Contenidos_has_archivos_model->update($this->input->post('contenidos_has_archivos', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('contenidos_has_archivos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Contenidos_has_archivos_model->get_by_id($id);

        if ($row) {
            $this->Contenidos_has_archivos_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('contenidos_has_archivos'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contenidos_has_archivos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('contenidos_idcontenidos', 'contenidos idcontenidos', 'trim|required');
	$this->form_validation->set_rules('archivos_idarchivos', 'archivos idarchivos', 'trim|required');

	$this->form_validation->set_rules('contenidos_has_archivos', 'contenidos_has_archivos', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "contenidos_has_archivos.xls";
        $judul = "contenidos_has_archivos";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Contenidos Idcontenidos");
	xlsWriteLabel($tablehead, $kolomhead++, "Archivos Idarchivos");

	foreach ($this->Contenidos_has_archivos_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->contenidos_idcontenidos);
	    xlsWriteNumber($tablebody, $kolombody++, $data->archivos_idarchivos);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=contenidos_has_archivos.doc");

        $data = array(
            'contenidos_has_archivos_data' => $this->Contenidos_has_archivos_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('contenidos_has_archivos/contenidos_has_archivos_doc',$data);
    }

}

/* End of file Contenidos_has_archivos.php */
/* Location: ./application/controllers/Contenidos_has_archivos.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */