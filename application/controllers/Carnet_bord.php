<?php


class Carnet_bord extends REST_Controller
{
	/*
		 * ajouter une carnet_bord dans la bd
		 * */
	public function add_carnet_bord_post()
	{

		$data = array(
			'klm' => $this->input->post('klm'),
			'consomation' => $this->input->post('consomation'),
			'date' => $this->input->post('date'),
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
