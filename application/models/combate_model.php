<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Combate_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get(){
		return $this->db->get('Combates')->result();
	}

	function getBySexo($sexo,$dif = '0'){
		$this->db->where('sexo',$sexo);
		$this->db->where('diferente',$dif);
		$this->db->from('Combates');
		$query = $this->db->get();
		return $query->result_array();
	}
}