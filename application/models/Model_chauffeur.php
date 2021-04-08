<?php


class Model_chauffeur extends CI_Model
{
	public function get_mes_affectation($id, $type)
	{
		$sql = "select * from chauffeur c join mission m on c.id_chauffeur=m.id_chauffeur WHERE c.id_chauffeur= " . $id . " and m.etat =" . $type;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_choufeur_son_voture()
	{
		$sql = "select * from chauffeur WHERE chauffeur.id_chauffeur NOT IN 
		(SELECT chauffeur.id_chauffeur from chauffeur join affecter_v_chauffeur 
		on chauffeur.id_chauffeur=affecter_v_chauffeur.id_chauffeur where affecter_v_chauffeur.statut=1) and chauffeur.statut=1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
