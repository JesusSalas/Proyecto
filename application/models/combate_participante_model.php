<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Combate_participante_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function info_part($e,$p,$c){
		$this->db->select('p.participante,cp.competidor,p.nombre,p.app,p.apm,p.estatura,p.foto,cp.combate');
		$this->db->from('Combates_Participantes as cp');
		$this->db->join('Participantes as p','cp.participante = p.participante');
		$this->db->where('cp.combate',$c);
		$this->db->where('cp.evento',$e);
		$this->db->where('cp.participante',$p);
		$query=$this->db->get();
		return $query->result();
	}

	function asignar(){
		$datos = array(
			'participante'=>$this->security->xss_clean($this->input->post('participante')),
			'evento'=>$this->security->xss_clean($this->input->post('evento')),
			'competidor'=>$this->security->xss_clean($this->input->post('competidor')),
			'combate'=>$this->security->xss_clean($this->input->post('combate'))
		);
		$this->db->insert('Combates_Participantes',$datos);
		return true;
	}

	function getCombates($e,$s){
		$this->db->select('cp.combate,cp.descanso,cp.competidor,p.participante,p.nombre,p.app,p.apm,p.fecha_nac');
		$this->db->select('p.estatura,p.foto,c.tipo_combate,cat.categoria categoria,cat.nombre nombre_categoria,d.nombre dojo');
		$this->db->where('evento',$e);
		$this->db->where('c.sexo',$s);
		$this->db->from('Combates_Participantes as cp');
		$this->db->join('Combates as c','cp.combate = c.combate');
		$this->db->join('Participantes as p','cp.participante = p.participante');
		$this->db->join('Categorias as cat','p.categoria = cat.categoria');
		$this->db->join('Dojos as d','p.dojo = d.dojo');
		$this->db->order_by('combate,participante');
		$query = $this->db->get();
		return $query->result();
	}

	function getCompetidor($p,$e){
		$this->db->select('competidor');
		$this->db->where('evento',$e);
		$this->db->where('participante',$p);
		$this->db->from('Combates_Participantes');
		$query = $this->db->get();
		if($query->num_rows()>0)
			return $query->row()->competidor;
	}

	function get($p,$e){
		$this->db->where('participante',$p);
		$this->db->where('evento',$e);
		$query = $this->db->get('Combates_Participantes');
		return $query->result_array();
	}

	function searchByEvento($e){
		$this->db->select('cp.combate,cp.evento,cp.participante,p.nombre,p.app,p.apm,p.fecha_nac,p.sexo,p.estatura');
		$this->db->select('p.foto,p.diferente,c.nombre categoria,d.nombre dojo,co.tipo_combate');
		$this->db->from('Combates_Participantes as cp');
		$this->db->join('Participantes as p','cp.participante = p.participante');
		$this->db->join('Categorias as c','p.categoria = c.categoria');
		$this->db->join('Dojos as d','p.dojo = d.dojo');
		$this->db->join('Combates as co','cp.combate = co.combate');
		$this->db->where('cp.evento',$e);
		$this->db->order_by(' p.sexo,p.fecha_nac','asc');
		$query = $this->db->get();
		return $query->result();
	}

	function registraDescanso($id_p,$combate){
		$datos = array(
			'descanso' => 1
		);
		$this->db->where('participante',$id_p);
		$this->db->where('combate',$combate);
		if($this->db->update('Combates_Participantes',$datos))
			return true;
	}

	function getRonda($combate,$id_p = ''){
		$this->db->where('combate',$combate);
		$this->db->where('cp.participante !=',$id_p);
		$this->db->select('cp.participante, p.estatura, p.categoria');
		$this->db->from('Combates_Participantes as cp');
		$this->db->join('Participantes as p','cp.participante = p.participante');
		$query = $this->db->get();
		return $query->result();
	}

	function tieneDescanso($id_p,$evento){
		$this->db->where('participante',$id_p);
		$this->db->where('evento',$evento);
		$this->db->where('descanso',1);
		$query = $this->db->get('Combates_Participantes');
		if($query->num_rows()>0)
			return true;
		else
			return false;
	}

	function searchByP($id_p,$combate){
		$this->db->select('p.participante,cp.descanso,p.nombre,p.app,p.apm,p.estatura,p.foto,cat.nombre categoria,d.nombre dojo,d.pais,d.estado');
		$this->db->where('cp.participante',$id_p);
		$this->db->where('cp.combate',$combate);
		$this->db->from('Combates_Participantes as cp');
		$this->db->join('Participantes as p','cp.participante = p.participante');
		$this->db->join('Categorias as cat','p.categoria = cat.categoria');
		$this->db->join('Dojos as d','p.dojo = d.dojo');
		$query = $this->db->get();
		return $query->row();
	}
}