<?php


class Modele_carnet_bord extends CI_Model
{
	public function __construct()
	{
	}


	public function get_carnet_bord_for_user($id)
	{
			$this->db->select("*");
			$this->db->from("carnet_bord");
			$this->db->where("id_choufer",$id);
			$this->db->order_by("date", "desc");
		$query=$this->db->get();
		return $resulta = $query->result_array();
	}
	public function get_one_carnet_bord_for_one_user($id,$id_carn_bord)
	{
		$sql="select * FROM users u join carnet_bord cb on cb.id_choufer=u.id_user WHERE u.id_user=".$id."and cb.id_carnet_bord=".$id_carn_bord;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_All_Affectationcarnet_bord_for_one_user($id)
	{
		$sql="select * FROM users u join carnet_bord cb on cb.id_choufer=u.id_user WHERE u.id_user=".$id;
		$query = $this->db->query($sql);
		return $query->result_array();

	}
	//get affectation
	//SELECT * FROM carnet_bord WHERE id_choufer=11 ORDER BY carnet_bord.id_carnet_bord DESC LIMIT 1

}
