<?php

require APPPATH . 'libraries/REST_Controller.php';
class Generale extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
	}
	public function password_hash($pass = '')
	{
		if ($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}
	public function login_get()
	{
		$tabName = $this->input->get('tabname', TRUE);
		$email = $this->input->get('email', TRUE);
		$pass = $this->input->get('password', TRUE);
		$data = $this->Model_generale->login($email, $pass, $tabName);
		if ($data) {
			$res = array(
				'erorer' => false,
				'msg' => $data
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Verifier Votre Adresse Email Et/Ou Votre Mot De Passe"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function get_all_Act_Get()
	{
		$tabName = $this->input->get('tabname', TRUE);
		$data = $this->Model_generale->get_fn_active(null, $tabName);
		$total = count($data);
		if ($total != 0) {
			$res = array(
				'erorer' => false,
				'msg' => $data

			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Pas Des Donne "
			);

			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function get_all_Not_Act_Get()
	{
		$tabName = $this->input->get('tabname', TRUE);
		$data = $this->Model_generale->get_fn_Not_active(null, $tabName);
		$total = count($data);
		if ($total != 0) {
			$res = array(
				'erorer' => false,
				'msg' => $data

			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Pas Des Donne "
			);

			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function get_One_Act_By_ID_Get()
	{
		$tabName = $this->input->get('tabname', TRUE);
		$id = $this->input->get('id', TRUE);
		$nomId = $this->input->get('nomId', TRUE);
		$data = $this->Model_generale->get_fn_active($id, $tabName, $nomId);
		$total = count($data);
		if ($total != 0) {
			$res = array(
				'erorer' => false,
				'msg' => $data

			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Pas Des Donne "
			);

			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function get_One_Not_Act_By_Id_Get()
	{
		$tabName = $this->input->get('tabname', TRUE);
		$id = $this->input->get('id', TRUE);
		$nomId = $this->input->get('nomId', TRUE);
		$data = $this->Model_generale->get_fn_Not_active($id, $tabName, $nomId);
		$total = count($data);
		if ($total != 0) {
			$res = array(
				'erorer' => false,
				'msg' => $data

			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Pas Des Donne "
			);

			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function get_all_Generale_Get()
	{
		$tabName = $this->input->get('tabname', TRUE);
		$data = $this->Model_generale->get_fn_Generale(null, $tabName);
		$total = count($data);
		if ($total != 0) {
			$res = array(
				'erorer' => false,
				'msg' => $data

			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Pas Des Donne "
			);

			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function get_One_Generale_By_ID_Get()
	{
		$tabName = $this->input->get('tabname', TRUE);
		$id = $this->input->get('id', TRUE);
		$nomId = $this->input->get('nomId', TRUE);
		$data = $this->Model_generale->get_fn_Generale($id, $tabName, $nomId);
		$total = count($data);
		if ($total != 0) {
			$res = array(
				'erorer' => false,
				'msg' => $data

			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Pas Des Donne "
			);

			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function delete_generale_post()
	{
		$tabName = $this->input->post('tabname', TRUE);
		$id = $this->input->post('id', TRUE);
		$nomId = $this->input->post('nomId', TRUE);
		$delte = $this->Model_generale->delete_fn($id, $tabName, $nomId);
		if ($delte) {
			$res = array(
				'erorer' => false,
				'msg' => "Suppression Avec Succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Suppression n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function resset_passwored_post()
	{
		$nomtab = $this->input->post('nomTab', TRUE);
		$email = $this->input->post('email', TRUE);
		$matrcule = $this->input->post('matrcule', TRUE);
		$newpass = $this->password_hash($this->input->post('newpass'));
		$rest_pass = $this->Model_generale->reset_passwored($matrcule, $newpass, $nomtab, $email);
		if ($rest_pass) {
			$res = array(
				'erorer' => false,
				'msg' => "Modification Du Mot De Passe Avec Succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Modification Du Mot De Passe n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function active_compte_post()
	{
		$id = $this->input->post('id', true);
		$tabName = $this->input->post('tabname', TRUE);
		$nomId = $this->input->post('nomId', TRUE);

		$act = $this->Model_generale->active_desc_user($id, "1", $tabName, $nomId);
		if ($act) {
			$res = array(
				'erorer' => false,
				'msg' => "Activation Du Compte Avec Succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Activation N'a Pas Réussi "
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function desactive_compte_post()
	{
		$id = $this->input->post('id', true);
		$tabName = $this->input->post('tabname', TRUE);
		$nomId = $this->input->post('nomId', TRUE);

		$act = $this->Model_generale->active_desc_user($id, "0", $tabName, $nomId);
		if ($act) {
			$res = array(
				'erorer' => false,
				'msg' => "Desactivation  Du Compte Avec Succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "desactivation du compte  N'a Pas Réussi "
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function update_all_Passwored_post()
	{
		$id = $this->input->post('id', true);
		$idname = $this->input->post('nomId', true);
		$tabname = $this->input->post('tabname', true);
		$password = $this->password_hash($this->input->post('password'));
		$update = $this->Model_generale->upadte_passwored_first_connection($id, $password, $tabname, $idname);
		if ($update) {
			$res = array(
				'erorer' => false,
				'msg' => "Modification Du Mot de passe  avec succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Modification Du Mot de passe  n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
