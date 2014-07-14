<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dojo extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('dojo_model');
		$this->check_isvalidated();
		!($this->session->userdata('isadmin')==1)? die('Acceso restringido') : '';
	}

	public function index(){
		$data['dojos'] = $this->dojo_model->getAll();
		$this->layout->view('dojo/index_view',$data);
	}

	public function registro(){
		$this->layout->view('dojo/new_view');
	}

	public function registrar(){
		if($this->dojo_model->save()){
			$data['msg'] = "<div class='alert alert-success' role='alert'>Datos registrados con éxito</div>";
			$data['dojos'] = $this->dojo_model->getAll();
			$this->layout->view('dojo/index_view',$data);
		}
	}

	public function editar($id){
		$data['dojo'] = $this->dojo_model->search($id);
		$this->layout->view('dojo/new_view',$data);
	}

	private function check_isvalidated(){
    	if($this->session->userdata('islogged')!=true)
    		redirect('login');
    }
}