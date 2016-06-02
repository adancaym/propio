<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Area extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Area_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'area/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'area/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'area/index.html';
                $config['first_url'] = base_url() . 'area/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Area_model->total_rows($q);
            $area = $this->Area_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'area_data' => $area,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('area/area_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Area_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idarea' => $row->idarea,
		'plantel_idplantel' => $row->plantel_idplantel,
		'nombre' => $row->nombre,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('area/area_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('area'));
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
            'action' => site_url('area/create_action'),
	    'idarea' => set_value('idarea'),
	    'plantel_idplantel' => set_value('plantel_idplantel'),
	    'nombre' => set_value('nombre'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('area/area_form', $data);
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
		'plantel_idplantel' => $this->input->post('plantel_idplantel',TRUE),
		'nombre' => $this->input->post('nombre',TRUE),
	    );

            $this->Area_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('area'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Area_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('area/update_action'),
		'idarea' => set_value('idarea', $row->idarea),
		'plantel_idplantel' => set_value('plantel_idplantel', $row->plantel_idplantel),
		'nombre' => set_value('nombre', $row->nombre),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('area/area_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('area'));
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
            $this->update($this->input->post('idarea', TRUE));
        } else {
            $data = array(
		'plantel_idplantel' => $this->input->post('plantel_idplantel',TRUE),
		'nombre' => $this->input->post('nombre',TRUE),
	    );

            $this->Area_model->update($this->input->post('idarea', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('area'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Area_model->get_by_id($id);

        if ($row) {
            $this->Area_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('area'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('area'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('plantel_idplantel', 'plantel idplantel', 'trim|required');
	$this->form_validation->set_rules('nombre', 'nombre', 'trim|required');

	$this->form_validation->set_rules('idarea', 'idarea', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "area.xls";
        $judul = "area";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Plantel Idplantel");
	xlsWriteLabel($tablehead, $kolomhead++, "Nombre");

	foreach ($this->Area_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->plantel_idplantel);
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
        header("Content-Disposition: attachment;Filename=area.doc");

        $data = array(
            'area_data' => $this->Area_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('area/area_doc',$data);
    }

}

/* End of file Area.php */
/* Location: ./application/controllers/Area.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */