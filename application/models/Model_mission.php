<?php


class Model_mission extends CI_Model
{
	public function don_fn($id)
	{

		$date = date("Y-m-d H:i:s");
		$d = strval(date("Y-m-d H:i:s"));
		$sql = "UPDATE mission SET etat=1 , date_fin_real= '" . $d . "'  WHERE id_mission = " . $id;
		$query = $this->db->query($sql);
		return $this->db->affected_rows() > 0;
	}
	public function get_date_debut($id)
	{
		$sql = "SELECT mission.date_debut  FROM mission WHERE mission.id_mission= " . $id;
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_mession_info()
	{
		$sql = "select c.nomPrenom,c.matricule as matriculeChauffeur,v.type,v.matricule,m.* from chauffeur c 
		join voiture v join mission m on m.id_chauffeur=c.id_chauffeur and m.id_voiture=v.id_voiture";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_one_mession_info($id)
	{
		$sql = "select c.nomPrenom,v.type,v.matricule,m.* from chauffeur c join voiture v 
		join mission m on m.id_chauffeur=c.id_chauffeur and m.id_voiture=v.id_voiture WHERE m.id_mission= " . $id;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
