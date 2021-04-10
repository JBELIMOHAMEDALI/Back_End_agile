<?php


class Carnet_bord extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
		$this->load->model("Modele_carnet_bord");
	}
	/*
		 * ajouter une carnet_bord dans la bd
		 * */
	public function add_carnet_bord_post()
	{

		$data = array(
			'klm' => $this->input->post('klm'),
			'consomation' => $this->input->post('consomation'),
			'date' =>  date('Y-m-d'),
			'id_choufer' =>  $this->input->post('id_choufer'),
		);
			$create = $this->Model_generale->add_fn($data,"carnet_bord");
			if($create)
			{
				$res = array
				(
					'erorer' => false,
					'msg' => "Ajouté avec succès"
				);
				$this->response($res, REST_Controller::HTTP_OK);
			}
			else
			{
				$res= array(
					'erorer' => true,
					'msg' =>"Ajouté n'a pas réussi"
				);
				$this->response($res, REST_Controller::HTTP_NOT_FOUND);
			}

	}//
	public function get_all_carnet_bord_for_chouffeur_Get()
	{
		$id = $this->input->get('id', TRUE);
		$data = $this->Modele_carnet_bord->get_carnet_bord_for_user($id);
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
	 * modifer une carnet_bord => tt les donne pour carnet_bord
	 * */
	/*public function update_carnet_bord_post()
	{
		$data = array(
			'klm' => $this->input->post('klm'),
			'consomation' => $this->input->post('consomation'),
			'date' => $this->input->post('date'),
			'id_choufer' =>  $this->input->post('id_choufer'),
		);
		$id=$this->input->post('id',true);
		$update = $this->Model_generale->update_fn_bay_id($id,$data,"carnet_bord","id_carnet_bord");
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
	}*/
}
