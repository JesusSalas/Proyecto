<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Juez extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('juez_model');
		$this->check_isvalidated();
	}

	public function index(){
		$data['jueces'] = $this->juez_model->getAll();
		$this->layout->view('juez/index_view',$data);
	}

	public function registro(){
		$this->load->model('dojo_model');
		$data['dojos'] = $this->dojo_model->getNames();
		$this->layout->view('juez/new_view',$data);
	}

	public function registrar(){
		if($this->juez_model->save()){
			$data['msg'] = "<div class='alert alert-success' role='alert'>Datos registrados con éxito</div>";
			$data['jueces'] = $this->juez_model->getAll();
			$this->layout->view('juez/index_view',$data);
		}
	}

	public function editar($id){
		$this->load->model('dojo_model');
		$data['dojos'] = $this->dojo_model->getNames();
		$data['juez'] = $this->juez_model->search($id);
		$this->layout->view('juez/new_view',$data);
	}

	private function check_isvalidated(){
    	if(! $this->session->userdata('islogged') && $this->session->userdata('isadmin') != 1)
    		redirect('login');
    }
}