<?php


class Model_affecter_v_chauffeur extends CI_Model
{
	public function get_affectation($statut)
	{
		$sql = "SELECT v.matricule,v.type,c.nomPrenom,avc.id_affecter_v_chauffeur,avc.id_voiture,avc.id_chauffeur
		from chauffeur c JOIN affecter_v_chauffeur avc join voiture v 
		on c.id_chauffeur=avc.id_chauffeur and avc.id_voiture = v.id_voiture 
		WHERE avc.statut=" . $statut;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
