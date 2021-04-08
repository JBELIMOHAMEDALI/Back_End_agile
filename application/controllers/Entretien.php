<?php

require APPPATH . 'libraries/REST_Controller.php';
class Entretien extends REST_Controller
{
	public function add_entretien_post()
	{
		$data = array(
			'id_voiture' => $this->input->post('id_voiture'),
			'date' => $this->input->post('date'),
			'description' => $this->input->post('description')
		);


		$create = $this->Model_generale->add_fn($data, "entretien");
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
	public function update_entretien_post()
	{
		$data = array(
			'id_voiture' => $this->input->post('id_voiture'),
			'date' => $this->input->post('date'),
			'description' => $this->input->post('description')
		);

		$id = $this->input->post('id', true);
		$update = $this->Model_generale->update_fn_bay_id($id, $data, "entretien", "id_entretien");
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
