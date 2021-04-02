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
			'puissance' => $this->input->post('puissance'),
			'id_service' =>$this->input->post('id_service')
		);
			$create = $this->Model_generale->add_fn($data,"voiture");
			if($create)
			{
				$res = array
				(
					'erorer' => false,
					'msg' => "Ajouté avec success"
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
	public function update_voiture_post()
	{
		$data = array(
			'matricule' => $this->input->post('matricule'),
			'type' => $this->input->post('type'),
			'dmc' => $this->input->post('dmc'),
			'puissance' => $this->input->post('puissance'),
			'id_service' =>$this->input->post('id_service')
		);
		$id=$this->input->post('id',true);
		$update = $this->Model_generale->update_fn_bay_id($id,$data,"voiture","id_voiture");
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
				'msg' =>"Modification n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
