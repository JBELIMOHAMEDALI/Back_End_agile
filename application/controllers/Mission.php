<?php

require APPPATH . 'libraries/REST_Controller.php';
class Mission extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
		$this->load->model("Model_mission");
	}
	/*
	 * Add car in mission
	 * */
	public function add_mission_post()
	{
		$date_debut=$this->input->post('date_debut');
		$date_fin=$this->input->post('date_fin');
		$date1=date_create($date_debut);
		$date2=date_create($date_fin);
		$diff=date_diff($date1,$date2);
		$d= $diff->format("%a");

		$data = array(
			'id_chefService' => $this->input->post('id_chefService'),
			'id_chauffeur' => $this->input->post('id_chauffeur'),
			'id_voiture ' => $this->input->post('id_voiture'),
			'date_debut' => $date_debut,
			'description' =>$this->input->post('description'),
			'date_fin' =>$date_fin,
			'periode_estem' =>$d,
		);
		$create = $this->Model_generale->add_fn($data,"mission");
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
	/*
	 * update mission in db
	 * */
	public function update_mission_post()
	{
		$date_debut= $this->input->post('date_debut');
		$date_fin=$this->input->post('date_fin');
		$date1=date_create($date_debut);
		$date2=date_create($date_fin);
		$diff=date_diff($date1,$date2);
		$d= $diff->format("%a");

		$data = array(
			'id_chefService' => $this->input->post('id_chefService'),
			'id_chauffeur' => $this->input->post('id_chauffeur'),
			'id_voiture ' => $this->input->post('id_voiture'),
			'date_debut' => $date_debut,
			'description' =>$this->input->post('description'),
			'date_fin' =>$date_fin,
			'periode_estem' =>$d,
		);

		$id=$this->input->post('id',true);
		$update = $this->Model_generale->update_fn_bay_id($id,$data,"mission","id_mission");
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
	/*
	 * mission don
	 */
	public function don_fonction_post()
	{
		$id= $this->input->post('id');
		$data=$this->Model_mission->get_date_debut($id);

		$date_deb=date_create($data[0]->date_debut);
		$date_fn=date_create(date("Y-m-d"));
		$diff=date_diff($date_deb,$date_fn);
		$d= $diff->format("%a");
		echo $d;
		$update = $this->Model_mission->don_fn($id,$d);
		if($update)
		{
			$res = array
			(
				'erorer' => false,
				'msg' => "Finir Mission"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
		else
		{
			$res= array(
				'erorer' => true,
				'msg' =>"Failer "
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
