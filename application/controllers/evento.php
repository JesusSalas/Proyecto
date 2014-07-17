<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evento extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('evento_model');
		$this->check_isvalidated();
		!($this->session->userdata('isadmin')==1)? die('Acceso restringido') : '';
	}

	public function index(){
		$data['eventos'] = $this->evento_model->getAll();
		$this->layout->view('evento/index_view',$data);
	}

	public function registro(){
		$this->layout->view('evento/new_view');
	}

	public function registrar(){
		if($e = $this->evento_model->save()){
			$this->load->model('combate_model');
			$this->load->model('categoria_model');
			$this->load->model('resultados_model');

			$combates = $this->combate_model->get();
			foreach ($combates as $c) {
				$this->resultados_model->genera($e,$c->combate);
			}
			$data['msg'] = "<div class='alert alert-success' role='alert'>Datos registrados con éxito</div>";
			$data['eventos'] = $this->evento_model->getAll();
			$this->layout->view('evento/index_view',$data);
		}
	}

	public function editar($id){
		$data['evento'] = $this->evento_model->search($id);
		$this->layout->view('evento/new_view',$data);
	}

	public function autoriza(){
		$this->load->model('participante_model');
		$this->load->model('combate_participante_model');

		$data['participantes'] = $this->participante_model->getDisponibles();
		
		$data['evento'] = $this->evento_model->get();
		$this->layout->view('evento/autoriza_view',$data);
	}

	public function autorizar($data=null){
		if($p = $this->evento_model->autorizar()){
			$this->load->model('participante_model');
			$this->load->model('combate_model');
			$this->load->model('combate_participante_model');

			$data['evento'] = $this->evento_model->get();
			$data['participante'] = $this->participante_model->search($p);
			$data['competidor'] = $this->combate_participante_model->getCompetidor($p,$this->evento_model->get()->evento);
			$sexo = $this->participante_model->getSexo($p);
			if($dif=$this->participante_model->getDiferente($p) == 1)
				$data['combates'] = $this->combate_model->getBySexo($sexo,$dif);
			else
				$data['combates'] = $this->combate_model->getBySexo($sexo);
			$data['asignados'] = $this->combate_participante_model->get($p,$this->evento_model->get()->evento);
		}
		$this->layout->view('evento/asigna_combate_view',$data);
	}

	public function asigna(){
		$this->load->model('combate_participante_model');

		if($this->combate_participante_model->asignar()){
			$data['msg'] = "<div class='alert alert-success' role='alert'>Combate registrado</div>";
			
			$this->autorizar($data);
		}
	}

	private function check_isvalidated(){
    	if(! $this->session->userdata('islogged') && $this->session->userdata('isadmin') != 1)
    		redirect('login');
    }
}