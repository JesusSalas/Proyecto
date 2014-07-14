<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Participante extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('participante_model');
		$this->check_isvalidated();
	}

	public function index(){

		$this->load->model('categoria_model');
		$this->load->model('dojo_model');

		$data['categorias'] = $this->categoria_model->getAll();
		$data['dojos'] = $this->dojo_model->getNames();
		$data['participantes'] = $this->participante_model->getAll();
		$this->layout->view('participante/index_view',$data);
	}

	public function registro(){
		$this->load->model('categoria_model');
		$this->load->model('dojo_model');

		$data['categorias'] = $this->categoria_model->getAll();
		$data['dojos'] = $this->dojo_model->getNames();
		$this->layout->view('participante/new_view',$data);
	}

	public function editar($id){
		$this->load->model('categoria_model');
		$this->load->model('dojo_model');

		$data['categorias'] = $this->categoria_model->getAll();
		$data['dojos'] = $this->dojo_model->getNames();
		$data['participante'] = $this->participante_model->search($id);
		$this->layout->view('participante/new_view',$data);
	}

	public function registrar(){
		if($this->participante_model->save()){
			$this->load->model('categoria_model');
			$this->load->model('dojo_model');

			$data['categorias'] = $this->categoria_model->getAll();
			$data['dojos'] = $this->dojo_model->getNames();
			$data['participantes'] = $this->participante_model->getAll();
			$data['msg'] = "<div class='alert alert-success' role='alert'>Datos registrados con éxito</div>";
			$this->layout->view('participante/index_view',$data);
		}
	}

	public function evento(){
		$this->load->model('evento_model');

		$data['evento'] = $this->evento_model->get();
		$data['participantes'] = $this->participante_model->getNames();
		$data['asignados'] = $this->participante_model->getDisponibles();
		$this->layout->view('evento/asigna_view',$data);
	}

	public function asignar(){
		if($this->participante_model->asignar()){
			$this->load->model('evento_model');

			$data['evento'] = $this->evento_model->get();
			$data['participantes'] = $this->participante_model->getNames();
			$data['asignados'] = $this->participante_model->getDisponibles();
			$data['msg'] = "<div class='alert alert-success' role='alert'>Asignado con éxito</div>";
			$this->layout->view('evento/asigna_view',$data);
		}
	}

	private function check_isvalidated(){
    	if(! $this->session->userdata('islogged'))
    		redirect('login');
    }
}