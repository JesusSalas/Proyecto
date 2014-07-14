<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function getAll(){
		$query = $this->db->get('Categorias');
		return $query->result_array();
	}

	function get(){
		$query = $this->db->get('Categorias');
		return $query->result_array();
	}
}