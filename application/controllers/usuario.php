<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('usuario_model');
		$this->check_isvalidated();
		!($this->session->userdata('isadmin')==1)? die('Acceso restringido') : '';
	}

	public function index(){
		$this->load->model('dojo_model');
		$data['dojos'] = $this->dojo_model->getNames();

		$data['usuarios'] = $this->usuario_model->getAll();
		$this->layout->view('usuario/index_view',$data);
	}

	public function registro(){
		$this->load->model('dojo_model');
		$data['dojos'] = $this->dojo_model->getNames();
		$this->layout->view('usuario/new_view',$data);
	}

	public function registrar(){
		if($this->usuario_model->save()){
			$this->load->model('dojo_model');
			$data['dojos'] = $this->dojo_model->getNames();
			$data['msg'] = "<div class='alert alert-success' role='alert'>Datos registrados con éxito</div>";
			$data['usuarios'] = $this->usuario_model->getAll();
			$this->layout->view('usuario/index_view',$data);
		}
	}

	public function editar($id){
		$this->load->model('dojo_model');
		$data['dojos'] = $this->dojo_model->getNames();
		$data['usuario'] = $this->usuario_model->search($id);
		$this->layout->view('usuario/new_view',$data);
	}

	private function check_isvalidated(){
    	if(! $this->session->userdata('islogged') && $this->session->userdata('isadmin') != 1)
    		redirect('login');
    }
}