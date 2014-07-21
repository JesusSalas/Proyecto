<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evento_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get(){
		$this->db->select('evento, nombre, descripcion, fecha, duracion');
		$this->db->where('fecha >=',date('Y-m-d'));
		$this->db->where('estatus',1);
		$this->db->order_by('fecha','asc');
		$query = $this->db->get('Eventos');
		return $query->first_row();
	}

	function getAll(){
		$this->db->where('fecha >=',date('Y-m-d'));
		$this->db->order_by('fecha','asc');
		$query = $this->db->get('Eventos');
		return $query->result_array();
	}

	function autorizar(){
		$this->db->where('evento',$this->security->xss_clean($this->input->post('evento')));
		$this->db->where('participante',$this->security->xss_clean($this->input->post('participante')));
		$datos = array(
			'autoriza'=>$this->session->userdata('userid')
		);
		if($this->db->update('Asistencias',$datos))
			return $this->security->xss_clean($this->input->post('participante'));
	}

	function save(){
		$datos = array(
			'nombre'=>$this->security->xss_clean($this->input->post('nombre')),
			'descripcion'=>$this->security->xss_clean($this->input->post('descripcion')),
			'fecha'=>$this->security->xss_clean($this->input->post('fecha')),
			'estatus'=>$this->security->xss_clean($this->input->post('estatus')),
			'duracion'=>$this->security->xss_clean($this->input->post('duracion'))
		);
		if($id = $this->security->xss_clean($this->input->post('id'))){
			$this->db->where('evento',$id);
			$this->db->update('Eventos',$datos);
		}else{
			$this->db->insert('Eventos',$datos);
			$this->db->where('nombre',$this->security->xss_clean($this->input->post('nombre')));
			$this->db->where('descripcion',$this->security->xss_clean($this->input->post('descripcion')));
			$this->db->where('fecha',$this->security->xss_clean($this->input->post('fecha')));
			$this->db->select('evento');
			$id = $this->db->get('Eventos')->row()->evento;
		}
		return $id;
	}

	function search($id){
		$this->db->where('evento',$id);
		$query = $this->db->get('Eventos');
		return $query->result_array();
	}

	function getNext(){
		$this->db->where('estatus',1);
		$this->db->where('fecha >=',date('Y-m-d'));
		$this->db->order_by('fecha','asc');
		$query = $this->db->get('Eventos');
		return $query->first_row();
	}
}
