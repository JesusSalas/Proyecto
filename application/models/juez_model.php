<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Juez_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function getAll(){
		$query = $this->db->get('Jueces');
		return $query->result_array();
	}

	function save(){
		$datos = array(
			'nombre'=>$this->security->xss_clean($this->input->post('nombre')),
			'app'=>$this->security->xss_clean($this->input->post('app')),
			'apm'=>$this->security->xss_clean($this->input->post('apm')),
			'dojo'=>$this->security->xss_clean($this->input->post('dojo'))
		);
		if($id = $this->security->xss_clean($this->input->post('id'))){
			$this->db->where('juez',$id);
			$this->db->update('Jueces',$datos);
		}else{
			$this->db->insert('Jueces',$datos);
		}
		return true;
	}

	function search($id){
		$this->db->where('juez',$id);
		$query = $this->db->get('Jueces');
		return $query->result_array();
	}
}