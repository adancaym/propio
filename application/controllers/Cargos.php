<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cargos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cargos_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'cargos/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'cargos/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'cargos/index.html';
                $config['first_url'] = base_url() . 'cargos/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Cargos_model->total_rows($q);
            $cargos = $this->Cargos_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'cargos_data' => $cargos,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('cargos/cargos_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Cargos_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idcargos' => $row->idcargos,
		'descripcion' => $row->descripcion,
		'unidad_idunidad' => $row->unidad_idunidad,
		'correo' => $row->correo,
		'unidad' => $row->unidad,
		'persona_idpersona' => $row->persona_idpersona,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('cargos/cargos_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cargos'));
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
            'action' => site_url('cargos/create_action'),
	    'idcargos' => set_value('idcargos'),
	    'descripcion' => set_value('descripcion'),
	    'unidad_idunidad' => set_value('unidad_idunidad'),
	    'correo' => set_value('correo'),
	    'unidad' => set_value('unidad'),
	    'persona_idpersona' => set_value('persona_idpersona'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('cargos/cargos_form', $data);
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
		'descripcion' => $this->input->post('descripcion',TRUE),
		'unidad_idunidad' => $this->input->post('unidad_idunidad',TRUE),
		'correo' => $this->input->post('correo',TRUE),
		'unidad' => $this->input->post('unidad',TRUE),
		'persona_idpersona' => $this->input->post('persona_idpersona',TRUE),
	    );

            $this->Cargos_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('cargos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Cargos_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cargos/update_action'),
		'idcargos' => set_value('idcargos', $row->idcargos),
		'descripcion' => set_value('descripcion', $row->descripcion),
		'unidad_idunidad' => set_value('unidad_idunidad', $row->unidad_idunidad),
		'correo' => set_value('correo', $row->correo),
		'unidad' => set_value('unidad', $row->unidad),
		'persona_idpersona' => set_value('persona_idpersona', $row->persona_idpersona),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('cargos/cargos_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cargos'));
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
            $this->update($this->input->post('idcargos', TRUE));
        } else {
            $data = array(
		'descripcion' => $this->input->post('descripcion',TRUE),
		'unidad_idunidad' => $this->input->post('unidad_idunidad',TRUE),
		'correo' => $this->input->post('correo',TRUE),
		'unidad' => $this->input->post('unidad',TRUE),
		'persona_idpersona' => $this->input->post('persona_idpersona',TRUE),
	    );

            $this->Cargos_model->update($this->input->post('idcargos', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('cargos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Cargos_model->get_by_id($id);

        if ($row) {
            $this->Cargos_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('cargos'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cargos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('descripcion', 'descripcion', 'trim|required');
	$this->form_validation->set_rules('unidad_idunidad', 'unidad idunidad', 'trim|required');
	$this->form_validation->set_rules('correo', 'correo', 'trim|required');
	$this->form_validation->set_rules('unidad', 'unidad', 'trim|required');
	$this->form_validation->set_rules('persona_idpersona', 'persona idpersona', 'trim|required');

	$this->form_validation->set_rules('idcargos', 'idcargos', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "cargos.xls";
        $judul = "cargos";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Descripcion");
	xlsWriteLabel($tablehead, $kolomhead++, "Unidad Idunidad");
	xlsWriteLabel($tablehead, $kolomhead++, "Correo");
	xlsWriteLabel($tablehead, $kolomhead++, "Unidad");
	xlsWriteLabel($tablehead, $kolomhead++, "Persona Idpersona");

	foreach ($this->Cargos_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->descripcion);
	    xlsWriteLabel($tablebody, $kolombody++, $data->unidad_idunidad);
	    xlsWriteLabel($tablebody, $kolombody++, $data->correo);
	    xlsWriteLabel($tablebody, $kolombody++, $data->unidad);
	    xlsWriteNumber($tablebody, $kolombody++, $data->persona_idpersona);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=cargos.doc");

        $data = array(
            'cargos_data' => $this->Cargos_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('cargos/cargos_doc',$data);
    }

}

/* End of file Cargos.php */
/* Location: ./application/controllers/Cargos.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */