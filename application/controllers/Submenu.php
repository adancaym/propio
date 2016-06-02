<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Submenu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Submenu_model');
        $this->load->library('form_validation');

   }

    
public function index()
    {   
        if($this->session->userdata(md5('admin'))) {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'submenu/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'submenu/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'submenu/index.html';
                $config['first_url'] = base_url() . 'submenu/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Submenu_model->total_rows($q);
            $submenu = $this->Submenu_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'submenu_data' => $submenu,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->load->view('partial/header');
            $this->load->view('submenu/submenu_list', $data);
            $this->load->view('partial/footer');
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function read($id) 
    {
        if($this->session->userdata(md5('admin'))) {
        $row = $this->Submenu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idsubmenu' => $row->idsubmenu,
		'descripcion' => $row->descripcion,
		'menu_idmenu' => $row->menu_idmenu,
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('submenu/submenu_form', $data);
            $this->load->view('partial/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('submenu'));
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
            'action' => site_url('submenu/create_action'),
	    'idsubmenu' => set_value('idsubmenu'),
	    'descripcion' => set_value('descripcion'),
	    'menu_idmenu' => set_value('menu_idmenu'),
	);
$this->load->view('partial/header',$data);
        $this->load->view('submenu/submenu_form', $data);
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
		'menu_idmenu' => $this->input->post('menu_idmenu',TRUE),
	    );

            $this->Submenu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('submenu'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function update($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Submenu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('submenu/update_action'),
		'idsubmenu' => set_value('idsubmenu', $row->idsubmenu),
		'descripcion' => set_value('descripcion', $row->descripcion),
		'menu_idmenu' => set_value('menu_idmenu', $row->menu_idmenu),
	    );
    $this->load->view('partial/header',$data);
            $this->load->view('submenu/submenu_form', $data);
            $this->load->view('partial/footer');        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('submenu'));
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
            $this->update($this->input->post('idsubmenu', TRUE));
        } else {
            $data = array(
		'descripcion' => $this->input->post('descripcion',TRUE),
		'menu_idmenu' => $this->input->post('menu_idmenu',TRUE),
	    );

            $this->Submenu_model->update($this->input->post('idsubmenu', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('submenu'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }
    
    public function delete($id) 
    {   if($this->session->userdata(md5('admin'))) {
        $row = $this->Submenu_model->get_by_id($id);

        if ($row) {
            $this->Submenu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('submenu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('submenu'));
        }
        }
        else {
            redirect('Welcome','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('descripcion', 'descripcion', 'trim|required');
	$this->form_validation->set_rules('menu_idmenu', 'menu idmenu', 'trim|required');

	$this->form_validation->set_rules('idsubmenu', 'idsubmenu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "submenu.xls";
        $judul = "submenu";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Menu Idmenu");

	foreach ($this->Submenu_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->descripcion);
	    xlsWriteNumber($tablebody, $kolombody++, $data->menu_idmenu);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=submenu.doc");

        $data = array(
            'submenu_data' => $this->Submenu_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('submenu/submenu_doc',$data);
    }

}

/* End of file Submenu.php */
/* Location: ./application/controllers/Submenu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */