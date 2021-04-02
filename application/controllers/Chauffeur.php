<?php


require APPPATH . 'libraries/REST_Controller.php';
class Chauffeur extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
		$this->load->model("Model_chauffeur");
		$this->load->helper('url');
	}
	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}
	public function add_chauffeur_post()
{
	$password = $this->password_hash($this->input->post('password'));
	$matrecule=$this->input->post('matricule');
	$data = array(
		'password' => $password,
		'matricule' => $this->input->post('matricule'),
		'nomPrenom' => $this->input->post('nom_prnom'),
		'tel' => $this->input->post('tel'),
		'email' =>  $this->input->post('email'),
		'region' =>  $this->input->post('region'),
		'DNS' =>  $this->input->post('DNS'),
	);

	if($this->Model_user->check_matrecule($matrecule)===true){
		$create = $this->Model_user->add_user($data);
		if($create)
		{
			$res = array
			(
				'erorer' => false,
				'msg' => "Inscription avec succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
		else
		{
			$res= array(
				'erorer' => true,
				'msg' =>"Inscription n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	else
	{
		$res= array(
			'erorer' => true,
			'msg' =>"Matricule Existe Déjà "
		);
		$this->response($res, REST_Controller::HTTP_NOT_FOUND);
	}
}
	public function active_chauffeur_post()
	{
		$act=$this->Model_user->active_user($this->input->post('id',true));
		if($act)
		{
			$res = array
			(
				'erorer' => false,
				'msg' => "Activation Du Compte Avec Succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
		else
		{
			$res= array(
				'erorer' => true,
				'msg' =>"Activation N'a Pas Réussi "
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}


	}
	public function update_chauffeur_Profile_post()
{
	$password = $this->password_hash($this->input->post('password'));
	$data = array(
		'password' => $password,
		'matricule' => $this->input->post('matricule'),
		'nom_prnom' => $this->input->post('nom_prnom'),
		'tel' => $this->input->post('tel'),
		'region' =>  $this->input->post('region'),
		'DNS' =>  $this->input->post('DNS'),
	);
	$create = $this->Model_user->update_user_bay_id($this->input->post('id',true),$data);
	if($create)
	{
		$res = array
		(
			'erorer' => false,
			'msg' => "Modification Du Profile avec succès"
		);
		$this->response($res, REST_Controller::HTTP_NOT_FOUND);
	}
	else
	{
		$res= array(
			'erorer' => true,
			'msg' =>"Modification Du Profile n'a pas réussi"
		);
		$this->response($res, REST_Controller::HTTP_NOT_FOUND);
	}
}
	public function update_hauffeur_post()
	{
		$password = $this->password_hash($this->input->post('password'));
		$data = array(
			'password' => $password,
			'matricule' => $this->input->post('matricule'),
			'nomPrenom' => $this->input->post('nom_prnom'),
			'tel' => $this->input->post('tel'),
			'email' =>  $this->input->post('email'),
			'region' =>  $this->input->post('region'),
			'DNS' =>  $this->input->post('DNS'),
			'type' =>  $this->input->post('type'),
		);

		$create = $this->Model_user->update_user_bay_id($this->input->post('id',true),$data);
		if($create)
		{
			$res = array
			(
				'erorer' => false,
				'msg' => "Modification Du Profile avec succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
		else
		{
			$res= array(
				'erorer' => true,
				'msg' =>"Modification Du Profile n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}

}
