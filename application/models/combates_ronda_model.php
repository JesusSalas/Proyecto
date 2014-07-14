<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Combates_ronda_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function getByTipo($t,$e,$c){
		$this->db->select('participante1,participante2');
		$this->db->where('tipo',$t);
		$this->db->where('evento',$e);
		$this->db->where('combate',$c);
		$query = $this->db->get('Combates_Ronda');
		return $query->row();
	}

	function rondasGeneradas($e){
		$this->db->where('evento',$e);
		$query = $this->db->get('Combates_Ronda');
		if($query->num_rows() > 0)
			return true;
	}

	function updateRonda($p,$p1,$categoria){
		$datos = array(
			'participante2'=>$p,
			'categoria2'=>$categoria
		);
		$this->db->where('participante1',$p1);
		if($this->db->update('Combates_Ronda',$datos))
			return true;
	}

	function registra($p,$combate,$evento,$categoria,$tipo){
		$datos = array(
			'participante1'=>$p,
			'combate'=>$combate,
			'evento'=>$evento,
			'tipo'=>$tipo,
			'categoria1'=>$categoria
		);
		if($this->db->insert('Combates_Ronda',$datos)){
			$this->db->where('participante1',$p);
			$this->db->where('evento',$evento);
			$this->db->where('combate',$combate);
			$this->db->where('participante2');
			$this->db->select('ronda');
			$query = $this->db->get('Combates_Ronda');
			return $p;
			//return $query->row()->ronda;
		}
	}

	function getByEvento($evento){
		$this->db->distinct();
		$this->db->select('cr.combate, c.tipo_combate');
		$this->db->where('evento',$evento);
		$this->db->where('ganador');
		$this->db->where('participante2 is not null');
		$this->db->from('Combates_Ronda as cr');
		$this->db->join('Combates as c','cr.combate = c.combate');
		$query = $this->db->get();
		return $query->result_array();
	}

	function search($id){
		$this->db->select('ronda,combate,participante1,participante2');
		$this->db->where('ronda',$id);
		$query = $this->db->get('Combates_Ronda');
		return $query->row();
	}

	function getByCombate($evento,$combate){
		$this->db->distinct();
		$this->db->select('tipo,nombre');
		$this->db->from('Combates_Ronda as cr');
		$this->db->join('Tipos as t','cr.tipo = t.id');
		$this->db->where('cr.evento',$evento);
		$this->db->where('combate',$combate);
		$this->db->where('participante2 is not null');
		$this->db->order_by('tipo');
		$query = $this->db->get();
		return $query->result();
	}
}