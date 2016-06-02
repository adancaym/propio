<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Plantel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Plantel_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'plantel/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'plantel/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'plantel/index.html';
                $config['first_url'] = base_url() . 'plantel/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Plantel_model->total_rows($q);
            $plantel = $this->Plantel_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'plantel_data' => $plantel,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('plantel/plantel_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Plantel_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idplantel' => $row->idplantel,
		'cct' => $row->cct,
		'Plantel' => $row->Plantel,
		'Ubicacion' => $row->Ubicacion,
		'directivo_iddirectivo' => $row->directivo_iddirectivo,
		'estado_idestado' => $row->estado_idestado,
		'del_mun' => $row->del_mun,
		'Colonia' => $row->Colonia,
		'Calle y Numero' => $row->Calle y Numero,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('plantel/plantel_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plantel'));
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
            'action' => site_url('plantel/create_action'),
	    'idplantel' => set_value('idplantel'),
	    'cct' => set_value('cct'),
	    'Plantel' => set_value('Plantel'),
	    'Ubicacion' => set_value('Ubicacion'),
	    'directivo_iddirectivo' => set_value('directivo_iddirectivo'),
	    'estado_idestado' => set_value('estado_idestado'),
	    'del_mun' => set_value('del_mun'),
	    'Colonia' => set_value('Colonia'),
	    'Calle y Numero' => set_value('Calle y Numero'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('plantel/plantel_form', $data);
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
		'Plantel' => $this->input->post('Plantel',TRUE),
		'Ubicacion' => $this->input->post('Ubicacion',TRUE),
		'directivo_iddirectivo' => $this->input->post('directivo_iddirectivo',TRUE),
		'estado_idestado' => $this->input->post('estado_idestado',TRUE),
		'del_mun' => $this->input->post('del_mun',TRUE),
		'Colonia' => $this->input->post('Colonia',TRUE),
		'Calle y Numero' => $this->input->post('Calle y Numero',TRUE),
	    );

            $this->Plantel_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('plantel'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Plantel_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('plantel/update_action'),
		'idplantel' => set_value('idplantel', $row->idplantel),
		'cct' => set_value('cct', $row->cct),
		'Plantel' => set_value('Plantel', $row->Plantel),
		'Ubicacion' => set_value('Ubicacion', $row->Ubicacion),
		'directivo_iddirectivo' => set_value('directivo_iddirectivo', $row->directivo_iddirectivo),
		'estado_idestado' => set_value('estado_idestado', $row->estado_idestado),
		'del_mun' => set_value('del_mun', $row->del_mun),
		'Colonia' => set_value('Colonia', $row->Colonia),
		'Calle y Numero' => set_value('Calle y Numero', $row->Calle y Numero),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('plantel/plantel_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plantel'));
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
            $this->update($this->input->post('idplantel', TRUE));
        } else {
            $data = array(
		'Plantel' => $this->input->post('Plantel',TRUE),
		'Ubicacion' => $this->input->post('Ubicacion',TRUE),
		'directivo_iddirectivo' => $this->input->post('directivo_iddirectivo',TRUE),
		'estado_idestado' => $this->input->post('estado_idestado',TRUE),
		'del_mun' => $this->input->post('del_mun',TRUE),
		'Colonia' => $this->input->post('Colonia',TRUE),
		'Calle y Numero' => $this->input->post('Calle y Numero',TRUE),
	    );

            $this->Plantel_model->update($this->input->post('idplantel', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('plantel'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Plantel_model->get_by_id($id);

        if ($row) {
            $this->Plantel_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('plantel'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plantel'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('Plantel', 'plantel', 'trim|required');
	$this->form_validation->set_rules('Ubicacion', 'ubicacion', 'trim|required');
	$this->form_validation->set_rules('directivo_iddirectivo', 'directivo iddirectivo', 'trim|required');
	$this->form_validation->set_rules('estado_idestado', 'estado idestado', 'trim|required');
	$this->form_validation->set_rules('del_mun', 'del mun', 'trim|required');
	$this->form_validation->set_rules('Colonia', 'colonia', 'trim|required');
	$this->form_validation->set_rules('Calle y Numero', 'calle y numero', 'trim|required');

	$this->form_validation->set_rules('idplantel', 'idplantel', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "plantel.xls";
        $judul = "plantel";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Plantel");
	xlsWriteLabel($tablehead, $kolomhead++, "Ubicacion");
	xlsWriteLabel($tablehead, $kolomhead++, "Directivo Iddirectivo");
	xlsWriteLabel($tablehead, $kolomhead++, "Estado Idestado");
	xlsWriteLabel($tablehead, $kolomhead++, "Del Mun");
	xlsWriteLabel($tablehead, $kolomhead++, "Colonia");
	xlsWriteLabel($tablehead, $kolomhead++, "Calle Y Numero");

	foreach ($this->Plantel_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Plantel);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Ubicacion);
	    xlsWriteNumber($tablebody, $kolombody++, $data->directivo_iddirectivo);
	    xlsWriteNumber($tablebody, $kolombody++, $data->estado_idestado);
	    xlsWriteLabel($tablebody, $kolombody++, $data->del_mun);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Colonia);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Calle y Numero);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=plantel.doc");

        $data = array(
            'plantel_data' => $this->Plantel_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('plantel/plantel_doc',$data);
    }

}

/* End of file Plantel.php */
/* Location: ./application/controllers/Plantel.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */