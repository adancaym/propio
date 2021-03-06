<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contenidos_has_archivos_model extends CI_Model
{

    public $table = 'contenidos_has_archivos';
    public $id = 'contenidos_has_archivos';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('contenidos_has_archivos', $q);
	$this->db->or_like('contenidos_idcontenidos', $q);
	$this->db->or_like('archivos_idarchivos', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('contenidos_has_archivos', $q);
	$this->db->or_like('contenidos_idcontenidos', $q);
	$this->db->or_like('archivos_idarchivos', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    //funcion generadora de select html con clase bootstrap
    //en campo se asigna el campo de la tabla que deseamos filtrar
    function get_dropdown($campo){
        $this->db->select('*');
        foreach ($this->db->get($this->table)->result_array() as $row ) {
            $options[$category['contenidos_has_archivos']] =  $category[$campo];
        }
        return form_dropdown('contenidos_has_archivos', $options, '','class="form-control"');
    }
    //funcion generadora de select html con clase bootstrap
    //campo e id que se desea filtrar pruebas
    function get_dropdown_especific($id,$campo){
        $this->db->select('*');
        $this->db->where($campo,$id);
        foreach ($this->db->get($this->table)->result_array() as $row ) {
            $options[$category['contenidos_has_archivos']] =  $category[$campo];
        }
        return form_dropdown('contenidos_has_archivos', $options, '','class="form-control"');
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Contenidos_has_archivos_model.php */
/* Location: ./application/models/Contenidos_has_archivos_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-02 12:23:50 */
/* http://harviacode.com */