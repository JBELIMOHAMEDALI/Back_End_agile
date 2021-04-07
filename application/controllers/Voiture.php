<?php

require APPPATH . 'libraries/REST_Controller.php';
class Voiture extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
		$this->load->model("Model_voiture");
		$this->load->helper('url');
	}
	/*
	 *   add car in db
	 * */
	public function add_voiture_post()
	{
		$data = array(
			'matricule' => $this->input->post('matricule'),
			'type' => $this->input->post('type'),
			'dmc' => $this->input->post('dmc'),
			'puissance' => $this->input->post('puissance'),
			'service' => $this->input->post('service')
		);
		$create = $this->Model_generale->add_fn($data, "voiture");
		if ($create) {
			$res = array(
				'erorer' => false,
				'msg' => "Ajouté avec success"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Inscription n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	/*
	 * update car in db
	 * */
	public function update_voiture_post()
	{
		$data = array(
			'matricule' => $this->input->post('matricule'),
			'type' => $this->input->post('type'),
			'dmc' => $this->input->post('dmc'),
			'puissance' => $this->input->post('puissance'),
			'service' => $this->input->post('service')
		);
		$id = $this->input->post('id', true);
		$update = $this->Model_generale->update_fn_bay_id($id, $data, "voiture", "id_voiture");
		if ($update) {
			$res = array(
				'erorer' => false,
				'msg' => "Modification avec succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Modification n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	/*
	 * get all car not affected to chouffeur
	 * */
	public function get_voitur_non_affecte_get()
	{
		$data = $this->Model_voiture->get_voiture_non_affecte();
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
	/*
	 * get car bay chouffeur
	 */
	public function get_voitur_bay_chouffeur_get()
	{
		$id_chpuffeur = $this->input->get('id', TRUE);
		$data = $this->Model_voiture->get_voiture_bay_chouffeur($id_chpuffeur);
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
