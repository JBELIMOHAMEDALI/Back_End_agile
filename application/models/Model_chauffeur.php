<?php


class Model_chauffeur extends CI_Model
{
	public function get_mes_affectation($id, $statu, $eta)
	{
		$sql = "SELECT m.id_mission,m.id_chefService,m.id_chauffeur,v.type voiture,v.matricule,m.date_debut,m.description,m.date_fin,m.etat,m.date_fin_real from mission m join voiture v join chauffeur c on v.id_voiture=m.id_voiture and m.id_chauffeur=c.id_chauffeur where c.id_chauffeur=" . $id . " and c.statut = '" . $statu . "' and m.etat= " . $eta;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_choufeur_son_voture()
	{
		$sql = "select * from chauffeur WHERE chauffeur.id_chauffeur NOT IN 
		(SELECT chauffeur.id_chauffeur from chauffeur join affecter_v_chauffeur 
		on chauffeur.id_chauffeur=affecter_v_chauffeur.id_chauffeur where affecter_v_chauffeur.statut=1) 
		and chauffeur.statut=1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_one_mes_affectation($id)
	{
		$sql = "SELECT m.id_mission,m.id_chefService,m.id_chauffeur,v.type 
		voiture,v.matricule,m.date_debut,m.description,m.date_fin,m.etat,m.date_fin_real 
		from mission m join voiture v join chauffeur c on v.id_voiture=m.id_voiture 
		and m.id_chauffeur=c.id_chauffeur";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function get_All_choufeur_for_mession()
	{
		$sql = "SELECT c.* FROM chauffeur c JOIN affecter_v_chauffeur af on af.id_chauffeur = c.id_chauffeur WHERE c.statut = 1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function check_first_connected($id)
	{
		$this->db->select("*");
		$this->db->from("chauffeur");
		$this->db->where("id_chauffeur", $id);
		$this->db->where("first_connected", "1");
		$query = $this->db->get();
		return $query->num_rows() == 1;
	}
}
