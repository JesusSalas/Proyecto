<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dojo_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get(){
		$this->db->select('nombre');
		$this->db->where('dojo',$this->session->userdata('dojo'));
		$query = $this->db->get('Dojos');
		return $query->row()->nombre;
	}

	function getNames(){
		$this->db->select('dojo, nombre');
		$query = $this->db->get('Dojos');
		return $query->result_array();
	}

	function getAll(){
		$query = $this->db->get('Dojos');
		return $query->result_array();
	}

	function save(){
		$datos = array(
			'nombre'=>$this->security->xss_clean($this->input->post('nombre')),
			'direccion'=>$this->security->xss_clean($this->input->post('direccion')),
			'sensei'=>$this->security->xss_clean($this->input->post('sensei')),
			'estado'=>$this->security->xss_clean($this->input->post('estado')),
			'pais'=>$this->security->xss_clean($this->input->post('pais'))
		);
		if($id = $this->security->xss_clean($this->input->post('id'))){
			$this->db->where('dojo',$id);
			$this->db->update('Dojos',$datos);
		}else{
			$this->db->insert('Dojos',$datos);
			$this->db->where('nombre',$datos['nombre']);
			$this->db->where('direccion',$datos['direccion']);
			$this->db->where('sensei',$datos['sensei']);
			$this->db->where('estado',$datos['estado']);
			$this->db->where('pais',$datos['pais']);
			$this->db->select('dojo');
			$id = $this->db->get('Dojos')->first_row()->dojo;
		}
		if($_FILES)
			$this->uploadLogo($id);
		return true;
	}
	
	function uploadLogo($id){
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
        

            $config['upload_path'] = './logos/';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $config['file_name'] = 'logo_'.$id.'.'.$ext;
            $this->load->library('upload', $config);

        if(!$this->upload->do_upload('file')){
            echo $this->upload->display_errors('<div class="alert alert-danger" role="alert">', '</div>');
            return false;
        } else {
            $w = $this->upload->data();
            $path = $_FILES['file']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
            $data = array(
                'logo' => 'logo_'.$id.'.'.$ext,
                );
            $this->db->where('dojo',$id);
            $this->db->update('Dojos', $data); 
            return true;
        }
	}

	function search($id){
		$this->db->where('dojo',$id);
		$query = $this->db->get('Dojos');
		return $query->result_array();
	}
}
