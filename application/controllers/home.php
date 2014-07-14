<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->check_isvalidated();
    }

    public function index(){
        $this->load->model('evento_model');
        $this->load->model('combates_ronda_model');

        $data['evento'] = $this->evento_model->getNext();
        if($data['evento'])
            if($this->combates_ronda_model->rondasGeneradas($data['evento']->evento))
                $data['combates'] = true;

        $this->layout->view('/home/index_view',$data);
    }

    private function check_isvalidated(){
    	if(! $this->session->userdata('islogged'))
    		redirect('login');
    }
    public function do_logout(){
    	$this->session->sess_destroy();
    	redirect('login');
    }

}