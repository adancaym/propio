<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Unidades_plantel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Unidades_plantel_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'unidades_plantel/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'unidades_plantel/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'unidades_plantel/index.html';
                $config['first_url'] = base_url() . 'unidades_plantel/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Unidades_plantel_model->total_rows($q);
            $unidades_plantel = $this->Unidades_plantel_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'unidades_plantel_data' => $unidades_plantel,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('unidades_plantel/unidades_plantel_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Unidades_plantel_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idunidades_plantel' => $row->idunidades_plantel,
		'id_Area' => $row->id_Area,
		'plantel_cct' => $row->plantel_cct,
		'Area' => $row->Area,
		'contacto_correo' => $row->contacto_correo,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('unidades_plantel/unidades_plantel_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unidades_plantel'));
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
            'action' => site_url('unidades_plantel/create_action'),
	    'idunidades_plantel' => set_value('idunidades_plantel'),
	    'id_Area' => set_value('id_Area'),
	    'plantel_cct' => set_value('plantel_cct'),
	    'Area' => set_value('Area'),
	    'contacto_correo' => set_value('contacto_correo'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('unidades_plantel/unidades_plantel_form', $data);
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
		'id_Area' => $this->input->post('id_Area',TRUE),
		'plantel_cct' => $this->input->post('plantel_cct',TRUE),
		'Area' => $this->input->post('Area',TRUE),
		'contacto_correo' => $this->input->post('contacto_correo',TRUE),
	    );

            $this->Unidades_plantel_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('unidades_plantel'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Unidades_plantel_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('unidades_plantel/update_action'),
		'idunidades_plantel' => set_value('idunidades_plantel', $row->idunidades_plantel),
		'id_Area' => set_value('id_Area', $row->id_Area),
		'plantel_cct' => set_value('plantel_cct', $row->plantel_cct),
		'Area' => set_value('Area', $row->Area),
		'contacto_correo' => set_value('contacto_correo', $row->contacto_correo),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('unidades_plantel/unidades_plantel_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unidades_plantel'));
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
            $this->update($this->input->post('idunidades_plantel', TRUE));
        } else {
            $data = array(
		'id_Area' => $this->input->post('id_Area',TRUE),
		'plantel_cct' => $this->input->post('plantel_cct',TRUE),
		'Area' => $this->input->post('Area',TRUE),
		'contacto_correo' => $this->input->post('contacto_correo',TRUE),
	    );

            $this->Unidades_plantel_model->update($this->input->post('idunidades_plantel', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('unidades_plantel'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Unidades_plantel_model->get_by_id($id);

        if ($row) {
            $this->Unidades_plantel_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('unidades_plantel'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unidades_plantel'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_Area', 'id area', 'trim|required');
	$this->form_validation->set_rules('plantel_cct', 'plantel cct', 'trim|required');
	$this->form_validation->set_rules('Area', 'area', 'trim|required');
	$this->form_validation->set_rules('contacto_correo', 'contacto correo', 'trim|required');

	$this->form_validation->set_rules('idunidades_plantel', 'idunidades_plantel', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "unidades_plantel.xls";
        $judul = "unidades_plantel";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Area");
	xlsWriteLabel($tablehead, $kolomhead++, "Plantel Cct");
	xlsWriteLabel($tablehead, $kolomhead++, "Area");
	xlsWriteLabel($tablehead, $kolomhead++, "Contacto Correo");

	foreach ($this->Unidades_plantel_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_Area);
	    xlsWriteLabel($tablebody, $kolombody++, $data->plantel_cct);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Area);
	    xlsWriteLabel($tablebody, $kolombody++, $data->contacto_correo);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=unidades_plantel.doc");

        $data = array(
            'unidades_plantel_data' => $this->Unidades_plantel_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('unidades_plantel/unidades_plantel_doc',$data);
    }

}

/* End of file Unidades_plantel.php */
/* Location: ./application/controllers/Unidades_plantel.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:51 */
/* http://harviacode.com */