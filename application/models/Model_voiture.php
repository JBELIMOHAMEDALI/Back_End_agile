<?php


class Model_voiture extends CI_Model
{
	public function get_voiture_non_affecte()
	{
		$sql="select * from voiture WHERE voiture.id_voiture NOT IN (SELECT voiture.id_voiture from voiture join affecter_v_chauffeur on voiture.id_voiture=affecter_v_chauffeur.id_voiture) and voiture.statut=1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_voiture_bay_chouffeur($id)
	{
		$sql="select v.* from voiture v join affecter_v_chauffeur afv join chauffeur c on v.id_voiture=afv.id_voiture and afv.id_chauffeur=c.id_chauffeur and c.id_chauffeur =".$id;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}
