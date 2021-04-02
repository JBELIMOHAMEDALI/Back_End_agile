<?php


class Model_affectation extends CI_Model
{
	public function __construct()
	{
	}

	public function get_one_Affectation_for_one_user($id,$id_aff)
	{
		$sql="select * FROM users u join affectaion af on af.id_chauffeur=u.id_user WHERE u.id_user=".$id." and af.id_affectaion =".$id_aff;
		$query = $this->db->query($sql);
		return $query->result_array();

	}
	public function get_All_Affectation_for_one_user()
	{
		$sql="select * FROM users u join affectaion af on af.id_chauffeur=u.id_user ";
		$query = $this->db->query($sql);
		return $query->result_array();

	}
}
