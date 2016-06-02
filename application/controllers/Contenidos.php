<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contenidos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contenidos_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'contenidos/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'contenidos/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'contenidos/index.html';
                $config['first_url'] = base_url() . 'contenidos/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Contenidos_model->total_rows($q);
            $contenidos = $this->Contenidos_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'contenidos_data' => $contenidos,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('contenidos/contenidos_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Contenidos_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idcontenidos' => $row->idcontenidos,
		'titulo' => $row->titulo,
		'contenido' => $row->contenido,
		'auxiliar_idauxiliar' => $row->auxiliar_idauxiliar,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('contenidos/contenidos_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contenidos'));
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
            'action' => site_url('contenidos/create_action'),
	    'idcontenidos' => set_value('idcontenidos'),
	    'titulo' => set_value('titulo'),
	    'contenido' => set_value('contenido'),
	    'auxiliar_idauxiliar' => set_value('auxiliar_idauxiliar'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('contenidos/contenidos_form', $data);
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
		'titulo' => $this->input->post('titulo',TRUE),
		'contenido' => $this->input->post('contenido',TRUE),
		'auxiliar_idauxiliar' => $this->input->post('auxiliar_idauxiliar',TRUE),
	    );

            $this->Contenidos_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('contenidos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Contenidos_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('contenidos/update_action'),
		'idcontenidos' => set_value('idcontenidos', $row->idcontenidos),
		'titulo' => set_value('titulo', $row->titulo),
		'contenido' => set_value('contenido', $row->contenido),
		'auxiliar_idauxiliar' => set_value('auxiliar_idauxiliar', $row->auxiliar_idauxiliar),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('contenidos/contenidos_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contenidos'));
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
            $this->update($this->input->post('idcontenidos', TRUE));
        } else {
            $data = array(
		'titulo' => $this->input->post('titulo',TRUE),
		'contenido' => $this->input->post('contenido',TRUE),
		'auxiliar_idauxiliar' => $this->input->post('auxiliar_idauxiliar',TRUE),
	    );

            $this->Contenidos_model->update($this->input->post('idcontenidos', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('contenidos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Contenidos_model->get_by_id($id);

        if ($row) {
            $this->Contenidos_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('contenidos'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contenidos'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('titulo', 'titulo', 'trim|required');
	$this->form_validation->set_rules('contenido', 'contenido', 'trim|required');
	$this->form_validation->set_rules('auxiliar_idauxiliar', 'auxiliar idauxiliar', 'trim|required');

	$this->form_validation->set_rules('idcontenidos', 'idcontenidos', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "contenidos.xls";
        $judul = "contenidos";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Titulo");
	xlsWriteLabel($tablehead, $kolomhead++, "Contenido");
	xlsWriteLabel($tablehead, $kolomhead++, "Auxiliar Idauxiliar");

	foreach ($this->Contenidos_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->titulo);
	    xlsWriteLabel($tablebody, $kolombody++, $data->contenido);
	    xlsWriteNumber($tablebody, $kolombody++, $data->auxiliar_idauxiliar);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=contenidos.doc");

        $data = array(
            'contenidos_data' => $this->Contenidos_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('contenidos/contenidos_doc',$data);
    }

}

/* End of file Contenidos.php */
/* Location: ./application/controllers/Contenidos.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */