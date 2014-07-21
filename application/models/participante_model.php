<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Participante_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function getNames(){
		$this->db->select('participante,nombre,app,apm');
		$this->db->where('estatus',1);
		if($this->session->userdata('isadmin')!=1)
			$this->db->where('dojo',$this->session->userdata('dojo'));
		$query = $this->db->get('Participantes');
		return $query->result_array();
	}

	function getDisponibles(){
		$add="";
		if($this->session->userdata('isadmin')!=1)
			$this->db->where('p.dojo',$this->session->userdata('dojo'));
		$this->db->select('p.participante,p.nombre,p.app,p.apm');
		$this->db->from('Participantes as p');
		$this->db->join('Asistencias as a','p.participante = a.participante');
		$this->db->where('p.estatus',1);
		$query = $this->db->get();
		return $query->result_array();
	}

	function getIdAsignados(){
		$add="";
		if($this->session->userdata('isadmin')!=1)
			$add = " and p.dojo = ".$this->session->userdata('dojo');
		
		$this->db->select('p.participante');
		$this->db->from('Participantes as p');
		$this->db->join('Asistencias as a','p.participante = a.participante');
		$this->db->where('p.estatus',1);
		$this->db->where('a.autoriza is not null');
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->db->where('estatus',1);
		if($this->session->userdata('isadmin') != 1)
			$this->db->where('dojo',$this->session->userdata('dojo'));
		$query = $this->db->get('Participantes');
		return $query->result_array();
	}

	function getSexo($id){
		$this->db->select('sexo');
		$this->db->where('participante',$id);
		$query = $this->db->get('Participantes');
		return $query->row()->sexo;
	}

	function getDiferente($id){
		$this->db->select('diferente');
		$this->db->where('participante',$id);
		$this->db->from('Participantes');
		$query = $this->db->get();
		return $query->row()->diferente;
	}

	function search($id){
		$this->db->where('participante',$id);
		$query = $this->db->get('Participantes');
		return $query->result_array();
	}

	function asignar(){
		$datos = array(
			'participante'=>$this->security->xss_clean($this->input->post('participante')),
			'evento'=>$this->security->xss_clean($this->input->post('evento'))
		);
		if($this->db->insert('Asistencias',$datos));
			return true;
	}

	function save(){
		$datos = array(
			'nombre'=>$this->security->xss_clean($this->input->post('nombre')),
			'correo'=>$this->security->xss_clean($this->input->post('correo')),
			'app'=>$this->security->xss_clean($this->input->post('app')),
			'apm'=>$this->security->xss_clean($this->input->post('apm')),
			'categoria'=>$this->security->xss_clean($this->input->post('categoria')),
			'fecha_nac'=>$this->security->xss_clean($this->input->post('fecha_nac')),
			'sexo'=>$this->security->xss_clean($this->input->post('sexo')),
			'estatus'=>1,
			'diferente'=>$this->security->xss_clean($this->input->post('diferente')),
			'isclinica'=>$this->security->xss_clean($this->input->post('isclinica')),
			'numero'=>$this->security->xss_clean($this->input->post('numero')),
			'estatura'=>$this->security->xss_clean($this->input->post('estatura'))
		);
                $dojo = $this->security->xss_clean($this->input->post('dojo'));
                if($dojo)
                         $datos['dojo']=$dojo;
                else $datos['dojo']=$this->session->userdata('dojo');
		if($id = $this->security->xss_clean($this->input->post('id'))){
			$this->db->where('participante',$id);
			$this->db->update('Participantes',$datos);
		}else{
			$this->db->insert('Participantes',$datos);
			$this->db->where('nombre',$datos['nombre']);
			$this->db->where('app',$datos['app']);
			$this->db->where('categoria',$datos['categoria']);
			$this->db->where('fecha_nac',$datos['fecha_nac']);
			$this->db->where('sexo',$datos['sexo']);
			$this->db->where('dojo',$datos['dojo']);
			$this->db->select('participante');
			$id = $this->db->get('Participantes')->first_row()->participante;
		}
		if($_FILES)
			$this->uploadFoto($id);
		return true;
	}

	function uploadFoto($id){
		$path = $_FILES['file']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);

		$config['upload_path'] = './fotos/';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $config['file_name'] = 'foto_'.$id.'.'.$ext;
	    $this->load->library('upload', $config);

		if(!$this->upload->do_upload('file')){
        	echo $this->upload->display_errors('<div class="alert alert-danger" role="alert">', '</div>');
            return false;
        } else {
            $w = $this->upload->data();
            $data = array(
                'foto' => 'foto_'.$id.'.'.$ext,
                );
            $this->db->where('participante',$id);
            $this->db->update('Participantes', $data); 
            return true;
        }
        return false;
	}
}
