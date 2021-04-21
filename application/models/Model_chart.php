<?php


class Model_chart extends CI_Model
{
	/**
	 * retern nomber des voiture/chouffeur active
	 */
	public function get_tt_count_act_act($tab)
	{
		$this->db->select('*');
		$this->db->from($tab);
		$this->db->where('statut', '1');
		return $this->db->count_all_results();
	}
	/**
	 * retern nombre des mession selon l'etat du mession
	 * ou nomber des mession selon l'etat du mession par chouffeur
	 */
	public function get_tt_count_mission_etat($etat, $idchouffeur = null)
	{
		$this->db->select('*');
		$this->db->from('mission');
		if ($idchouffeur != null) {
			$this->db->where('id_chauffeur', $idchouffeur);
		}
		$this->db->where('etat', $etat);
		return $this->db->count_all_results();
	}
	/**
	 * retern nombre des entritine bay anne actule
	 * */
	public function get_tt_count_nomber_entritient_bay_yeares()
	{
		$year = date("Y");
		$sql = "SELECT COUNT(id_entretien) as nombre_entrint FROM entretien WHERE entretien.date LIKE '%" . $year . "'";
		$query = $this->db->query($sql);
		return $this->db->count_all_results();
	}
	/**
	 * retern nombre des affection des chouffeur par voiturz
	 * */
	public function get_tt_count_affectaion_act()
	{
		$this->db->select('*');
		$this->db->from('affecter_v_chauffeur');
		$this->db->where('statut', '1');
		return $this->db->count_all_results();
	}
	/**
	 * retern nombre des carnet des bored pour un chouffeur
	 * */
	public function get_tt_count_carnet_bored_chouffeur($id)
	{
		$year = date("Y");
		$sql = "SELECT COUNT(carnet_bord.id_carnet_bord) as nb from carnet_bord WHERE carnet_bord.id_choufer=" . $id . " and carnet_bord.date LIKE  '" . $year . "%'";
		$query = $this->db->query($sql);
		$query = $this->db->query($sql);
		return $query->result();
	}
}
