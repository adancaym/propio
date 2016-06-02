<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Submenu_has_contenidos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Submenu_has_contenidos_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'submenu_has_contenidos/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'submenu_has_contenidos/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'submenu_has_contenidos/index.html';
                $config['first_url'] = base_url() . 'submenu_has_contenidos/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Submenu_has_contenidos_model->total_rows($q);
            $submenu_has_contenidos = $this->Submenu_has_contenidos_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'submenu_has_contenidos_data' => $submenu_has_contenidos,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('submenu_has_contenidos/submenu_has_contenidos_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Submenu_has_contenidos_model->get_by_id($id);
        if ($row) {
            $data = array(
		'submenu_has_contenidos' => $row->submenu_has_contenidos,
		'submenu_idsubmenu' => $row->submenu_idsubmenu,
		'contenidos_idcontenidos' => $row->contenidos_idcontenidos,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('submenu_has_contenidos/submenu_has_contenidos_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('submenu_has_contenidos'));
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
            'action' => site_url('submenu_has_contenidos/create_action'),
	    'submenu_has_contenidos' => set_value('submenu_has_contenidos'),
	    'submenu_idsubmenu' => set_value('submenu_idsubmenu'),
	    'contenidos_idcontenidos' => set_value('contenidos_idcontenidos'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('submenu_has_contenidos/submenu_has_contenidos_form', $data);
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
		'submenu_idsubmenu' => $this->input->post('submenu_idsubmenu',TRUE),
		'contenidos_idcontenidos' => $this->input->post('contenidos_idcontenidos',TRUE),
	    );

            $this->Submenu_has_contenidos_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('submenu_has_contenidos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Submenu_has_contenidos_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('submenu_has_contenidos/update_action'),
		'submenu_has_contenidos' => set_value('submenu_has_contenidos', $row->submenu_has_contenidos),
		'submenu_idsubmenu' => set_value('submenu_idsubmenu', $row->submenu_idsubmenu),
		'contenidos_idcontenidos' => set_value('contenidos_idcontenidos', $row->contenidos_idcontenidos),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('submenu_has_contenidos/submenu_has_contenidos_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('submenu_has_contenidos'));
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
            $this->update($this->input->post('submenu_has_contenidos', TRUE));
        } else {
            $data = array(
		'submenu_idsubmenu' => $this->input->post('submenu_idsubmenu',TRUE),
		'contenidos_idcontenidos' => $this->input->post('contenidos_idcontenidos',TRUE),
	    );

            $this->Submenu_has_contenidos_model->update($this->input->post('submenu_has_contenidos', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('submenu_has_contenidos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Submenu_has_contenidos_model->get_by_id($id);

        if ($row) {
            $this->Submenu_has_contenidos_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('submenu_has_contenidos'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('submenu_has_contenidos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('submenu_idsubmenu', 'submenu idsubmenu', 'trim|required');
	$this->form_validation->set_rules('contenidos_idcontenidos', 'contenidos idcontenidos', 'trim|required');

	$this->form_validation->set_rules('submenu_has_contenidos', 'submenu_has_contenidos', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "submenu_has_contenidos.xls";
        $judul = "submenu_has_contenidos";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Submenu Idsubmenu");
	xlsWriteLabel($tablehead, $kolomhead++, "Contenidos Idcontenidos");

	foreach ($this->Submenu_has_contenidos_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->submenu_idsubmenu);
	    xlsWriteNumber($tablebody, $kolombody++, $data->contenidos_idcontenidos);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=submenu_has_contenidos.doc");

        $data = array(
            'submenu_has_contenidos_data' => $this->Submenu_has_contenidos_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('submenu_has_contenidos/submenu_has_contenidos_doc',$data);
    }

}

/* End of file Submenu_has_contenidos.php */
/* Location: ./application/controllers/Submenu_has_contenidos.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */