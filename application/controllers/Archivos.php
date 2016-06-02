<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Archivos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Archivos_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'archivos/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'archivos/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'archivos/index.html';
                $config['first_url'] = base_url() . 'archivos/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Archivos_model->total_rows($q);
            $archivos = $this->Archivos_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'archivos_data' => $archivos,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('archivos/archivos_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Archivos_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idarchivos' => $row->idarchivos,
		'nombre' => $row->nombre,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('archivos/archivos_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('archivos'));
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
            'action' => site_url('archivos/create_action'),
	    'idarchivos' => set_value('idarchivos'),
	    'nombre' => set_value('nombre'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('archivos/archivos_form', $data);
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
	    );

            $this->Archivos_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('archivos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Archivos_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('archivos/update_action'),
		'idarchivos' => set_value('idarchivos', $row->idarchivos),
		'nombre' => set_value('nombre', $row->nombre),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('archivos/archivos_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('archivos'));
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
            $this->update($this->input->post('idarchivos', TRUE));
        } else {
            $data = array(
		'nombre' => $this->input->post('nombre',TRUE),
	    );

            $this->Archivos_model->update($this->input->post('idarchivos', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('archivos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Archivos_model->get_by_id($id);

        if ($row) {
            $this->Archivos_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('archivos'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('archivos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nombre', 'nombre', 'trim|required');

	$this->form_validation->set_rules('idarchivos', 'idarchivos', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "archivos.xls";
        $judul = "archivos";
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

	foreach ($this->Archivos_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nombre);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=archivos.doc");

        $data = array(
            'archivos_data' => $this->Archivos_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('archivos/archivos_doc',$data);
    }

}

/* End of file Archivos.php */
/* Location: ./application/controllers/Archivos.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */