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
	public function add_voiture_post()
	{
		$data = array(
			'matricule' => $this->input->post('matricule'),
			'type' => $this->input->post('type'),
			'dmc' => $this->input->post('dmc'),
			'service' =>$this->input->post('service')
		);
			$create = $this->Model_voiture->add_voiture($data);
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
	public function update_voiture_post()
	{
		$data = array(
			'matricule' => $this->input->post('matricule'),
			'type' => $this->input->post('type'),
			'dmc' => $this->input->post('dmc'),
			'service' =>$this->input->post('service'),


		);
		$create = $this->Model_voiture->update_voiture_bay_id($this->input->post('id',true),$data);
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
	public function get_all_voiture_Get(){

		$data = $this->Model_voiture->get_voiture_one_all();
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
	public function get_one_voiture_Get()
	{

		$data = $this->Model_voiture->get_voiture_one_all($this->input->get('id', TRUE));
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
	public function delete_voiture_post()
	{
		$id=$this->input->post('id', TRUE);
		$delte=$this->Model_voiture->delete_voiture($id);
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
	public function get_voiture_for_user_get()
	{

		$data = $this->Model_voiture->get_voture_user($this->input->get('id', TRUE));
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
				'msg' => "Pas des donne "
			);

			$this->response($res, REST_Controller::HTTP_NOT_FOUND);

		}
	}

}
