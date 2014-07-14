<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resultados_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function genera($e,$c){
		$datos = array(
			'evento'=>$e,
			'combate'=>$c
		);
		if($this->db->insert('Resultados_Combates',$datos))
			return true;
	}
}