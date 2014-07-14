<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ronda extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('combates_ronda_model');
		$this->check_isvalidated();
		!($this->session->userdata('isadmin')==1)? die('Acceso restringido') : '';
	}

	public function ver($id){
		$this->load->model('combate_participante_model');

		$data['info_ronda'] = $this->combates_ronda_model->search($id);
		$combate = $data['info_ronda']->combate;
		$p1 = $data['info_ronda']->participante1;
		$p2 = $data['info_ronda']->participante2;
		$data['participante1'] = $this->combate_participante_model->searchByP($p1,$combate);
		$data['participante2'] = $this->combate_participante_model->searchByP($p2,$combate);
		$this->load->view('ronda/ver_view',$data);
	}

	public function index($data = null){
		$this->load->model('evento_model');

		$data['combates']=$this->combates_ronda_model->getByEvento($this->evento_model->getNext()->evento);
		$this->layout->view('ronda/index_view',$data);
	}

	function moreInfo(){
		$this->load->model('combate_participante_model');

		$combate = $this->input->post('combate');
		$this->load->model('evento_model');

		$evento = $this->evento_model->getNext()->evento;
		$datos=array();
		$tipos = $this->combates_ronda_model->getByCombate($evento,$combate);
		foreach ($tipos as $t) {
			$part=array();
			$participantes=$this->combates_ronda_model->getByTipo($t->tipo,$evento,$combate);
			foreach ($participantes as $p) {
				array_push($part, $this->combate_participante_model->info_part($evento,$p,$combate));
			}
			array_push($datos, $part);
			break;
		}
		$data['combates']=$tipos;
		$this->layout->view('ronda/ver_view',$data);
	}

	public function genera(){
		$this->load->model('combate_participante_model');
		$this->load->model('evento_model');
		$this->load->model('tipo_model');
		$evento = $this->evento_model->getNext()->evento;

		//hombres
		$sexos = array('0','1');
		//cuenta del tipo de combates a registrar
		$cuenta = 1;
		for ($i=0; $i < count($sexos); $i++) {
			$sexo = $sexos[$i];

			//obtiene info de los participantes segun el combate registrado
			$info_combates = $this->combate_participante_model->getCombates($evento,$sexo);
			//guardar en arreglos por categoria/cinta
			$cuatro=array();$cinco_b=array();$cinco_a=array();$siete_b=array();$siete_a=array();$siete_v_m=array();
			$nueve_b=array();$nueve_a=array();$nueve_v_m=array();$once_b=array();$once_a=array();$once_n=array();
			$once_v_m=array();$trece_b=array();$trece_a=array();$trece_c=array();$trece_n=array();$trece_v_m=array();
			$quince_b=array();$quince_a=array();$quince_c=array();$quince_n=array();$quince_v_m=array();
			$unosiete_b=array();$unosiete_a=array();$unosiete_c=array();$unosiete_n=array();$unosiete_v_m=array();
			$trescuatro_b=array();$trescuatro_a=array();$trescuatro_c=array();$trescuatro_n=array();$once_c;
			$trescuatro_v_m=array();$cuatrocuatro_b=array();$cuatrocuatro_a=array();$cuatrocuatro_c=array();
			$cuatrocuatro_n=array();$cuatrocuatro_v_m=array();$cuatrocinco_c_n=array();$cuatrocinco_b_a_v_m=array();
			//crea arreglos conforme a edad y cinta/categoria
			foreach ($info_combates as $info) {
				$edad = $this->CalculaEdad($info->fecha_nac);
				if ($edad <= 4 && $info->categoria == 1) {
					array_push($cuatro, $info);
				}elseif ($edad == 5 && ($info->categoria == 1 || $info->categoria == 2)) {
					switch ($info->categoria) {
						case 1:
							array_push($cinco_b, $info);
							break;
						default:
							array_push($cinco_a, $info);
							break;
					}
				}elseif ($edad <= 7 && ($info->categoria != 5 || $info->categoria != 6)) {
					switch ($info->categoria) {
						case 1:
							array_push($siete_b, $info);
							break;
						case 2:
							array_push($siete_a, $info);
							break;
						default:
							array_push($siete_v_m, $info);
							break;
					}
				}elseif ($edad <= 9 && ($info->categoria != 5 || $info->categoria != 6)) {
					switch ($info->categoria) {
						case 1:
							array_push($nueve_b, $info);
							break;
						case 2:
							array_push($nueve_a, $info);
							break;
						default:
							array_push($nueve_v_m, $info);
							break;
					}
				}elseif ($edad <= 11) {
					switch ($info->categoria) {
						case 1:
							array_push($once_b, $info);
							break;
						case 2:
							array_push($once_a, $info);
							break;
						case 5:
							array_push($once_c, $info);
							break;
						case 6:
							array_push($once_n, $info);
							break;
						default:
							array_push($once_v_m, $info);
							break;
					}
				}elseif ($edad <= 13) {
					switch ($info->categoria) {
						case 1:
							array_push($trece_b, $info);
							break;
						case 2:
							array_push($trece_a, $info);
							break;
						case 5:
							array_push($trece_c, $info);
							break;
						case 6:
							array_push($trece_n, $info);
							break;
						default:
							array_push($trece_v_m, $info);
							break;
					}
				}elseif ($edad <= 15) {
					switch ($info->categoria) {
						case 1:
							array_push($quince_b, $info);
							break;
						case 2:
							array_push($quince_a, $info);
							break;
						case 5:
							array_push($quince_c, $info);
							break;
						case 6:
							array_push($quince_n, $info);
							break;
						default:
							array_push($quince_v_m, $info);
							break;
					}
				}elseif ($edad <= 17) {
					switch ($info->categoria) {
						case 1:
							array_push($unosiete_b, $info);
							break;
						case 2:
							array_push($unosiete_a, $info);
							break;
						case 5:
							array_push($unosiete_c, $info);
							break;
						case 6:
							array_push($unosiete_n, $info);
							break;
						default:
							array_push($unosiete_v_m, $info);
							break;
					}
				}elseif ($edad <= 34) {
					switch ($info->categoria) {
						case 1:
							array_push($trescuatro_b, $info);
							break;
						case 2:
							array_push($trescuatro_a, $info);
							break;
						case 5:
							array_push($trescuatro_c, $info);
							break;
						case 6:
							array_push($trescuatro_n, $info);
							break;
						default:
							array_push($trescuatro_v_m, $info);
							break;
					}
				}elseif ($edad <= 44) {
					switch ($info->categoria) {
						case 1:
							array_push($cuatrocuatro_b, $info);
							break;
						case 2:
							array_push($cuatrocuatro_a, $info);
							break;
						case 5:
							array_push($cuatrocuatro_c, $info);
							break;
						case 6:
							array_push($cuatrocuatro_n, $info);
							break;
						default:
							array_push($cuatrocuatro_v_m, $info);
							break;
					}
				}else
					if($info->categoria == 5 || $info->categoria == 6)
						array_push($cuatrocinco_c_n, $info);
					else
						array_push($cuatrocinco_b_a_v_m, $info);
			}
			//generar combates de primera ronda aleatoriamente para cada bloque de edades
			$cuenta=$this->aleatorizar($cuatro,$cuenta,'4 años Blanca');$cuenta=$this->aleatorizar($cinco_b,$cuenta,'5 años Blanca');
			$cuenta=$this->aleatorizar($cinco_a,$cuenta,'5 años Amarilla');$cuenta=$this->aleatorizar($siete_b,$cuenta,'7 años Blanca');
			$cuenta=$this->aleatorizar($siete_a,$cuenta,'7 años Amarilla');$cuenta=$this->aleatorizar($siete_v_m,$cuenta,'7 años Verde y Morada');
			$cuenta=$this->aleatorizar($nueve_b,$cuenta,'9 años Blanca');$cuenta=$this->aleatorizar($nueve_a,$cuenta,'9 años Amarilla');
			$cuenta=$this->aleatorizar($nueve_v_m,$cuenta,'9 años Verde y Morada');$cuenta=$this->aleatorizar($once_b,$cuenta,'11 años Blanca');
			$cuenta=$this->aleatorizar($once_a,$cuenta,'11 años Amarilla');$cuenta=$this->aleatorizar($once_n,$cuenta,'11 años Negra');
			$cuenta=$this->aleatorizar($once_c,$cuenta,'11 años Café');$cuenta=$this->aleatorizar($once_v_m,$cuenta,'11 años Verde y Morada');
			$cuenta=$this->aleatorizar($trece_b,$cuenta,'13 años Blanca');$cuenta=$this->aleatorizar($trece_a,$cuenta,'13 años Amarilla');
			$cuenta=$this->aleatorizar($trece_c,$cuenta,'13 años Café');$cuenta=$this->aleatorizar($trece_n,$cuenta,'13 años Negra');
			$cuenta=$this->aleatorizar($trece_v_m,$cuenta,'13 años Verde y Morada');$cuenta=$this->aleatorizar($quince_b,$cuenta,'15 años Blanca');
			$cuenta=$this->aleatorizar($quince_a,$cuenta,'15 años Amarilla');$cuenta=$this->aleatorizar($quince_c,$cuenta,'15 años Café');
			$cuenta=$this->aleatorizar($quince_n,$cuenta,'15 años Negra');$cuenta=$this->aleatorizar($quince_v_m,$cuenta,'15 años Verde y Morada');
			$cuenta=$this->aleatorizar($unosiete_b,$cuenta,'17 años Blanca');$cuenta=$this->aleatorizar($unosiete_a,$cuenta,'17 años Amarilla');
			$cuenta=$this->aleatorizar($unosiete_c,$cuenta,'17 años Café');$cuenta=$this->aleatorizar($unosiete_n,$cuenta,'17 años Negra');
			$cuenta=$this->aleatorizar($unosiete_v_m,$cuenta,'17 años Verde y Morada');$cuenta=$this->aleatorizar($trescuatro_b,$cuenta,'34 años Blanca');
			$cuenta=$this->aleatorizar($trescuatro_a,$cuenta,'34 años Amarilla');$cuenta=$this->aleatorizar($trescuatro_c,$cuenta,'34 años Café');
			$cuenta=$this->aleatorizar($trescuatro_n,$cuenta,'34 años Negra');$cuenta=$this->aleatorizar($trescuatro_v_m,$cuenta,'34 años Verde y Morada');
			$cuenta=$this->aleatorizar($cuatrocuatro_b,$cuenta,'44 años Blanca');$cuenta=$this->aleatorizar($cuatrocuatro_a,$cuenta,'44 años Amarilla');
			$cuenta=$this->aleatorizar($cuatrocuatro_c,$cuenta,'44 años Café');$cuenta=$this->aleatorizar($cuatrocuatro_n,$cuenta,'44 años Negra');
			$cuenta=$this->aleatorizar($cuatrocuatro_v_m,$cuenta,'44 años Verde y Morada');$cuenta=$this->aleatorizar($cuatrocinco_b_a_v_m,$cuenta,'45 años Blanca, Amarilla, Verde y Morada');
			$cuenta=$this->aleatorizar($cuatrocinco_c_n,$cuenta,'45 años Café y Negra');
		}
		
		$data['msg'] = "<div class='alert alert-success' role='alert'>Combates generados con éxito</div>";
		$this->index($data);
	}

	private function aleatorizar($participantes,$cuenta,$nombre){
		$entran=array();
		foreach ($participantes as $p) {
			if($p->categoria > 4){
				if(!($p->combate == 1 || $p->combate == 3 || $p->combate == 5 || $p->combate == 7))
					array_push($entran, $p);
			}
			else
				array_push($entran, $p);
		}
		$ind_kata=array();
		$ind_kum=array();
		$eq_kata=array();
		$eq_kum=array();
		foreach ($entran as $p) {
			if($p->combate == 1 || $p->combate == 5)
				array_push($ind_kata, $p);
			elseif($p->combate == 2 || $p->combate == 6) 
				array_push($ind_kum, $p);
			elseif($p->combate == 3 || $p->combate == 7)
				array_push($eq_kata, $p);
			else
				array_push($eq_kum, $p);
		}
		if(isset($ind_kum)){
			if(count($ind_kum) > 1){
				$evento=$this->evento_model->getNext()->evento;
				$nombre='Individual KUMITE - '.$nombre;
				$tipo=$this->tipo_model->registra($evento,$nombre);
				unset($r);
				if(count($ind_kum)%2 == 1)
					foreach ($ind_kum as $p) {
						$combate = $p->combate;
						if($this->combate_participante_model->tieneDescanso($p->participante,$this->evento_model->getNext()->evento) == false)
							if($this->combate_participante_model->registraDescanso($p->participante,$p->combate)){
								$descansado=$p;
								break;
							}
					}
				foreach ($ind_kum as $p) {
					$combate = $p->combate;
					if($p->participante != $descansado->participante)
						if(isset($r)){
							if($this->combates_ronda_model->updateRonda($p->participante,$r,$p->categoria))
								unset($r);
						}else
							$r = $this->combates_ronda_model->registra($p->participante,$combate,$evento,$p->categoria,$tipo);
				}
				if(isset($descansado))
					$this->combates_ronda_model->registra($descansado->participante,$combate,$evento,$descansado->categoria,$tipo);
				unset($descansado);
			}
			$cuenta+=1;
		}
		if(isset($ind_kata)){
			if(count($ind_kata) > 1){
				$evento=$this->evento_model->getNext()->evento;
				$nombre='Individual KATA - '.$nombre;
				$tipo=$this->tipo_model->registra($evento,$nombre);
				unset($r);
				if(count($ind_kata)%2 == 1)
					foreach ($ind_kata as $p) {
						$combate = $p->combate;
						if($this->combate_participante_model->tieneDescanso($p->participante,$evento) == false)
							if($this->combate_participante_model->registraDescanso($p->participante,$p->combate)){
								$descansado=$p;
								break;
							}
					}
				foreach ($ind_kata as $p) {
					$combate = $p->combate;
					if($p->participante != $descansado->participante)
						if(isset($r)){
							if($this->combates_ronda_model->updateRonda($p->participante,$r,$p->categoria))
								unset($r);
						}else
							$r = $this->combates_ronda_model->registra($p->participante,$combate,$evento,$p->categoria,$tipo);
				}
				if(isset($descansado))
					$this->combates_ronda_model->registra($descansado->participante,$combate,$evento,$descansado->categoria,$tipo);
				unset($descansado);
			}
			$cuenta+=1;
		}
		if(isset($eq_kata)){
			if(count($eq_kata) > 1){
				$evento=$this->evento_model->getNext()->evento;
				$nombre='Equipo KATA - '.$nombre;
				$tipo=$this->tipo_model->registra($evento,$nombre);
				unset($r);
				if(count($eq_kata)%2 == 1)
					foreach ($eq_kata as $p) {
						$combate = $p->combate;
						if($this->combate_participante_model->tieneDescanso($p->participante,$evento) == false)
							if($this->combate_participante_model->registraDescanso($p->participante,$p->combate)){
								$descansado=$p;
								break;
							}
					}
				foreach ($eq_kata as $p) {
					$combate = $p->combate;
					if($p->participante != $descansado->participante)
						if(isset($r)){
							if($this->combates_ronda_model->updateRonda($p->participante,$r,$p->categoria))
								unset($r);
						}else
							$r = $this->combates_ronda_model->registra($p->participante,$combate,$evento,$p->categoria,$tipo);
				}
				if(isset($descansado))
					$this->combates_ronda_model->registra($descansado->participante,$combate,$evento,$descansado->categoria,$tipo);
				unset($descansado);
			}
			$cuenta+=1;
		}
		if(isset($eq_kum)){
			if(count($eq_kum) > 1){
				$evento=$this->evento_model->getNext()->evento;
				$nombre='Equipo KUMITE - '.$nombre;
				$tipo=$this->tipo_model->registra($evento,$nombre);
				unset($r);
				if(count($eq_kum)%2 == 1)
					foreach ($eq_kum as $p) {
						$combate = $p->combate;
						if($this->combate_participante_model->tieneDescanso($p->participante,$evento) == false)
							if($this->combate_participante_model->registraDescanso($p->participante,$p->combate)){
								$descansado=$p;
								break;
							}
					}
				foreach ($eq_kum as $p) {
					$combate = $p->combate;
					if($p->participante != $descansado->participante)
						if(isset($r)){
							if($this->combates_ronda_model->updateRonda($p->participante,$r,$p->categoria))
								unset($r);
						}else
							$r = $this->combates_ronda_model->registra($p->participante,$combate,$this->evento_model->getNext()->evento,$p->categoria,$tipo);
				}
				if(isset($descansado))
					$this->combates_ronda_model->registra($descansado->participante,$combate,$this->evento_model->getNext()->evento,$descansado->categoria,$tipo);
				unset($descansado);
			}
			$cuenta+=1;
		}
		return $cuenta;
	}

	private function CalculaEdad( $fecha ) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

	private function check_isvalidated(){
    	if(! $this->session->userdata('islogged') && $this->session->userdata('isadmin') != 1)
    		redirect('login');
    }
}