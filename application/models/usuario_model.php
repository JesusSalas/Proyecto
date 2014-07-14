<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function getAll(){
		$query = $this->db->get('usuarios');
		return $query->result_array();
	}

	function save(){
		$datos = array(
			'nombre'=>$this->security->xss_clean($this->input->post('nombre')),
			'apellido'=>$this->security->xss_clean($this->input->post('apellido')),
			'username'=>$this->security->xss_clean($this->input->post('username')),
			'dojo'=>$this->security->xss_clean($this->input->post('dojo')),
			'password'=>md5($this->security->xss_clean($this->input->post('username'))),
			'is_admin'=>$this->security->xss_clean($this->input->post('isadmin'))
		);
		if($id = $this->security->xss_clean($this->input->post('id'))){
			$this->db->where('id',$id);
			$this->db->update('usuarios',$datos);
		}else{
			$this->db->insert('usuarios',$datos);
		}
		return true;
	}

	function search($id){
		$this->db->where('id',$id);
		$query = $this->db->get('usuarios');
		return $query->result_array();
	}
}