<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacto extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contacto_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'contacto/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'contacto/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'contacto/index.html';
                $config['first_url'] = base_url() . 'contacto/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Contacto_model->total_rows($q);
            $contacto = $this->Contacto_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'contacto_data' => $contacto,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('contacto/contacto_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Contacto_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idcontacto' => $row->idcontacto,
		'correo' => $row->correo,
		'telefono' => $row->telefono,
		'ext' => $row->ext,
		'cargos_idcargos' => $row->cargos_idcargos,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('contacto/contacto_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contacto'));
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
            'action' => site_url('contacto/create_action'),
	    'idcontacto' => set_value('idcontacto'),
	    'correo' => set_value('correo'),
	    'telefono' => set_value('telefono'),
	    'ext' => set_value('ext'),
	    'cargos_idcargos' => set_value('cargos_idcargos'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('contacto/contacto_form', $data);
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
		'correo' => $this->input->post('correo',TRUE),
		'telefono' => $this->input->post('telefono',TRUE),
		'ext' => $this->input->post('ext',TRUE),
		'cargos_idcargos' => $this->input->post('cargos_idcargos',TRUE),
	    );

            $this->Contacto_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('contacto'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Contacto_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('contacto/update_action'),
		'idcontacto' => set_value('idcontacto', $row->idcontacto),
		'correo' => set_value('correo', $row->correo),
		'telefono' => set_value('telefono', $row->telefono),
		'ext' => set_value('ext', $row->ext),
		'cargos_idcargos' => set_value('cargos_idcargos', $row->cargos_idcargos),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('contacto/contacto_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contacto'));
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
            $this->update($this->input->post('idcontacto', TRUE));
        } else {
            $data = array(
		'correo' => $this->input->post('correo',TRUE),
		'telefono' => $this->input->post('telefono',TRUE),
		'ext' => $this->input->post('ext',TRUE),
		'cargos_idcargos' => $this->input->post('cargos_idcargos',TRUE),
	    );

            $this->Contacto_model->update($this->input->post('idcontacto', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('contacto'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Contacto_model->get_by_id($id);

        if ($row) {
            $this->Contacto_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('contacto'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contacto'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('correo', 'correo', 'trim|required');
	$this->form_validation->set_rules('telefono', 'telefono', 'trim|required');
	$this->form_validation->set_rules('ext', 'ext', 'trim|required');
	$this->form_validation->set_rules('cargos_idcargos', 'cargos idcargos', 'trim|required');

	$this->form_validation->set_rules('idcontacto', 'idcontacto', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "contacto.xls";
        $judul = "contacto";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Correo");
	xlsWriteLabel($tablehead, $kolomhead++, "Telefono");
	xlsWriteLabel($tablehead, $kolomhead++, "Ext");
	xlsWriteLabel($tablehead, $kolomhead++, "Cargos Idcargos");

	foreach ($this->Contacto_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->correo);
	    xlsWriteLabel($tablebody, $kolombody++, $data->telefono);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ext);
	    xlsWriteNumber($tablebody, $kolombody++, $data->cargos_idcargos);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=contacto.doc");

        $data = array(
            'contacto_data' => $this->Contacto_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('contacto/contacto_doc',$data);
    }

}

/* End of file Contacto.php */
/* Location: ./application/controllers/Contacto.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */