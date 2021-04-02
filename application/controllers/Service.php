<?php

require APPPATH . 'libraries/REST_Controller.php';
class Service extends REST_Controller
{
	public function add_entretien_post()
	{
		$data = array(
			'nom_service' => $this->input->post('nom_service'),
		);


		$create = $this->Model_generale->add_fn($data,"service");
		if($create)
		{
			$res = array
			(
				'erorer' => false,
				'msg' => "Ajoute Avec Succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
		else
		{
			$res= array(
				'erorer' => true,
				'msg' =>" Erreur l'ore l'insertion dans la base de donnée"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}

	}
	public function update_entretien_post()
	{
		$data = array(
			'nom_service' => $this->input->post('nom_service'),
		);

		$id=$this->input->post('id',true);
		$update = $this->Model_generale->update_fn_bay_id($id,$data,"service","id_service");
		if($update)
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
				'msg' =>" Erreur l'ore Modification dans la base de donnée"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
