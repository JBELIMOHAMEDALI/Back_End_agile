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
	/*
	 * cryptage du mot de passe
	 * */
	public function password_hash($pass = '')
	{
		if ($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}
	/*
	 * ajouter une choufeure dans la bd
	 * */
	public function add_chauffeur_post()
	{
		$matrecule = $this->input->post('matricule');
		$password = $this->password_hash($matrecule);
		$data = array(
			'password' => $password,
			'matricule' => $this->input->post('matricule'),
			'nomPrenom' => $this->input->post('nomPrenom'),
			'tel' => $this->input->post('tel'),
			'email' =>  $this->input->post('email'),
			'region' =>  $this->input->post('region'),
			'dns' =>  $this->input->post('dns'),
		);

		if ($this->Model_generale->check_matrecule($matrecule, "matricule", "chauffeur") === true) {
			$create = $this->Model_generale->add_fn($data, "chauffeur");
			if ($create) {
				$res = array(
					'erorer' => false,
					'msg' => "chauffeur Ajouté avec succès"
				);
				$this->response($res, REST_Controller::HTTP_OK);
			} else {
				$res = array(
					'erorer' => true,
					'msg' => "Ajouté d'un chauffeur n'a pas réussi"
				);
				$this->response($res, REST_Controller::HTTP_NOT_FOUND);
			}
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Matricule Existe Déjà "
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function update_chauffeur_chefService_profil_post()
	{
		$tabName = $this->input->post('tabName');
		$idName = $this->input->post('idName', true);

		switch ($tabName) {
			case "chauffeur":
				$data = array(

					'nomPrenom' => $this->input->post('nomPrenom'),
					'tel' => $this->input->post('tel'),
					'region' =>  $this->input->post('region'),
					'dns' =>  $this->input->post('dns'),
				);
				break;
			case "chefservice":
				$data = array(

					'matricule' => $this->input->post('matricule'),
					'nomPrenom' => $this->input->post('nomPrenom'),
					'tel' => $this->input->post('tel'),
					'email' =>  $this->input->post('email'),
					'region' =>  $this->input->post('region'),
					'dns' =>  $this->input->post('dns'),
				);
				break;
		}


		$id = $this->input->post('id', true);


		$update = $this->Model_generale->update_fn_bay_id($id, $data, $tabName, $idName);
		if ($update) {
			$res = array(
				'erorer' => false,
				'msg' => "Modification Du Profile avec succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Modification Du Profile n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}


	public function update_chauffeur_data_post()
	{
		$id = $this->input->post('id', true);
		if ($this->Model_chauffeur->check_first_connected($id)) {
			$data = array(

				'matricule' => $this->input->post('matricule'),
				'nomPrenom' => $this->input->post('nomPrenom'),
				'tel' => $this->input->post('tel'),
				'email' =>  $this->input->post('email'),
				'region' =>  $this->input->post('region'),
				'dns' =>  $this->input->post('dns'),
			);
		} else {
			$matrecule = $this->input->post('matricule');
			$password = $this->password_hash($matrecule);
			$data = array(
				'password' => $password,
				'matricule' => $matrecule,
				'nomPrenom' => $this->input->post('nomPrenom'),
				'tel' => $this->input->post('tel'),
				'email' =>  $this->input->post('email'),
				'region' =>  $this->input->post('region'),
				'dns' =>  $this->input->post('dns'),
			);
		}
		$update = $this->Model_generale->update_fn_bay_id($id, $data, "chauffeur", "id_chauffeur");
		if ($update) {
			$res = array(
				'erorer' => false,
				'msg' => "Modification Du Profile avec succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Modification Du Profile n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	/*
	 * consulte mes mestion selon l'etat du mission
	 * 0=>en attente
	 * 1=>en cour
	 * 2=>don
	 * */
	public function get_Mes_Mission_for_one_choufeur_get()
	{
		$etat = $this->input->get('etat', TRUE); //etat du mission
		$id = $this->input->get('id', TRUE); //id_choufeure
		$stat = $this->input->get('statu', TRUE); //id_choufeure

		$data = $this->Model_chauffeur->get_mes_affectation($id, $stat, $etat);
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

	public function get_chouffeur_non_affecte_voture_get() //--
	{
		$data = $this->Model_chauffeur->get_choufeur_son_voture();
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

	public function get_One_Mission_for_one_choufeur_get()
	{

		$id = $this->input->get('id', TRUE); //id_choufeure

		$data = $this->Model_chauffeur->get_one_mes_affectation($id);
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

	public function get_chouffeur_for_mession_get()
	{
		$data = $this->Model_chauffeur->get_All_choufeur_for_mession();
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
	//
	public function get_chouffeur_one_voiture_get()
	{
		$data = $this->Model_chauffeur->getchouffeur_on_voiture();
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
}
