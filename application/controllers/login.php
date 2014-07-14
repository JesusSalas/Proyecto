<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session','form_validation'));
    }

	public function index($msg = NULL)
	{
		$data['msg'] = $msg;
		$this->layout->view('/login/index_view',$data);
	}

	public function process()
	{
		$this->load->model('login_model');
		$result = $this->login_model->validate();
		if(! $result){
			$msg = "<div class='alert alert-danger' role='alert'>Datos erróneos. Intenta nuevamente</div>";
			$this->index($msg);
		}
		else{
			redirect('home');
		}
	}
}