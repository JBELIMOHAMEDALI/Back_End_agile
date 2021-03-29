<?php


require APPPATH . 'libraries/REST_Controller.php';
class User extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
		$this->load->model("Model_user");
		$this->load->helper('url');
	}
	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}
	public function add_user_post()
{
	$password = $this->password_hash($this->input->post('password'));
	$matrecule=$this->input->post('matricule');
	$data = array(
		'password' => $password,
		'matricule' => $matrecule,
		'nom_prnom' => $this->input->post('nom_prnom'),
		'tel' => $this->input->post('tel'),
		'email' =>  $this->input->post('email'),
		'type'=>"0",
		'statut'=>"0",
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
			$this->response($res, REST_Controller::HTTP_OK);
		}
	}
	else
	{
		$res= array(
			'erorer' => true,
			'msg' =>"Matricule Existe Déjà "
		);
		$this->response($res, REST_Controller::HTTP_OK);
	}
}
	public function login_get()
	{

		$email=$this->input->get('email', TRUE);
		$pass=$this->input->get('password', TRUE);

		$data = $this->Model_user->login($email,$pass);

		if($data)
		{
			$res = array
			(
				'erorer' => false,
				'msg' => $data
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
		else
		{
			$res= array(
				'erorer' => true,
				'msg' =>"Verifier Votre Adresse Email Et/Ou Votre Mot De Passe"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
	}
	public function active_user_post()
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
			$this->response($res, REST_Controller::HTTP_OK);
		}


	}
	public function update_user_post()
	{
		$password = $this->password_hash($this->input->post('password'));
		$data = array(
			'password' => $password,
			'matricule' => $this->input->post('matricule'),
			'nom_prnom' => $this->input->post('nom_prnom'),
			'tel' => $this->input->post('tel'),
			'email' =>  $this->input->post('email'),
			'type'=>"0",
			'statut'=>"0",
		);
		$create = $this->Model_user->update_user_bay_id($this->input->post('id',true),$data);
		if($create)
		{
			$res = array
			(
				'erorer' => false,
				'msg' => "Modification avec succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
		else
		{
			$res= array(
				'erorer' => true,
				'msg' =>"Modification n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
	}
	public function get_all_user_Get(){

		$data = $this->Model_user->get_user();
		$total = count($data);
		if($total != 0 )
		{
			$res = array
			(
				'erorer' => false,
				'msg' => $data

			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
		else
		{
			$res= array(
				'erorer' => true,
				'msg' =>"Pas Des Donne "
			);

			$this->response($res, REST_Controller::HTTP_NOT_FOUND);

		}
	}
	public function get_one_user_Get()
	{

		$data = $this->Model_user->get_user($this->input->get('id', TRUE));
		$total = count($data);
		if ($total != 0) {
			$res = array
			(
				'erorer' => false,
				'msg' => $data

			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "data not found "
			);

			$this->response($res, REST_Controller::HTTP_NOT_FOUND);

		}
	}
	public function delete_user_post()
	{
		$id=$this->input->post('id', TRUE);
		$delte=$this->Model_user->delete_user($id);
		if($delte)
		{
			$res = array
			(
				'erorer' => false,
				'msg' => "Suppression Avec Succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
		else
		{
			$res= array(
				'erorer' => true,
				'msg' =>"Suppression n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}

	}
	public function resset_passwored_post()
	{
		$password = $this->password_hash($this->input->post('newpass'));
		$rest_pass=$this->Model_user->reset_passwored($this->input->post('matrcule', TRUE),$password);
		if($rest_pass)
		{
			$res = array
			(
				'erorer' => false,
				'msg' => "Modification Du Mot De Passe Avec Succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
		else
		{
			$res= array(
				'erorer' => true,
				'msg' =>"Modification Du Mot De Passe n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
	}
}
