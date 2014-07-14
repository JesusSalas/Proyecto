<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipo_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function registra($e,$n){
		$datos=array(
			'evento'=>$e,
			'nombre'=>$n
		);
		$this->db->insert('Tipos',$datos);
		return $this->db->insert_id();
	}
}