<?php


class Model_entretien extends CI_Model
{
	public function get_entritien_ifo()
	{

		$sql = "SELECT * FROM entretien e join voiture v on e.id_voiture = v.id_voiture ORDER by e.date DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_one_entritien_ifo($id)
	{

		$sql = "SELECT * FROM entretien e join voiture v on e.id_voiture = v.id_voiture WHERE e.id_entretien= " . $id;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
