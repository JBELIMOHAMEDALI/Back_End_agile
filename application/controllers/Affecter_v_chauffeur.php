<?php

require APPPATH . 'libraries/REST_Controller.php';
class Affecter_v_chauffeur extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
		$this->load->model("Model_affecter_v_chauffeur");
	}
	public function get_all_affecation_info_Get()
	{
		$statut = $this->input->get('statut');
		$data = $this->Model_affecter_v_chauffeur->get_affectation($statut);
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
	public function add_Affecter_v_chauffeur_post() //--
	{
		$data = array(
			'id_voiture' => $this->input->post('id_voiture'),
			'id_chauffeur' => $this->input->post('id_chauffeur'),
			'date_affectation' => date('Y-m-d')
		);


		$create = $this->Model_generale->add_fn($data, "affecter_v_chauffeur");
		if ($create) {
			$res = array(
				'erorer' => false,
				'msg' => "Ajouté avec success"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => " Erreur l'ore l'insertion dans la base de donnée"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function update_Affecter_v_chauffeur_post()
	{
		$data = array(
			'id_voiture' => $this->input->post('id_voiture'),
			'id_chauffeur' => $this->input->post('id_chauffeur'),
			'date_affectation' => date('Y-m-d')
		);

		$id = $this->input->post('id', true);
		$update = $this->Model_generale->update_fn_bay_id($id, $data, "affecter_v_chauffeur", "id_affecter_v_chauffeur ");
		if ($update) {
			$res = array(
				'erorer' => false,
				'msg' => "Modification avec succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => " Erreur l'ore Modification dans la base de donnée"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
