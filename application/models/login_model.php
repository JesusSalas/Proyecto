<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    public function validate()
    {
    	$username = $this->security->xss_clean($this->input->post('username'));
    	$password = md5($this->security->xss_clean($this->input->post('password')));

    	$this->db->where('username',$username);
    	$this->db->where('password',$password);

    	$query = $this->db->get('usuarios');

    	if($query->num_rows() == 1){
    		$row = $query->row();
    		$data = array(
    			'userid' => $row->id,
    			'nombre' => $row->nombre,
    			'apellido' => $row->apellido,
    			'username' => $row->username,
    			'islogged' => true,
                'isadmin' => $row->is_admin,
                'dojo' => $row->dojo
    			);
    		$this->session->set_userdata($data);
    		return true;
    	}
    	return false;
    }

}