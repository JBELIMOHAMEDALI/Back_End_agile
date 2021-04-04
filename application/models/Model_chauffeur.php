<?php


class Model_chauffeur extends CI_Model
{
	public function get_mes_affectation($id,$type)
	{
		$sql="select * from chauffeur c join mission m on c.id_chauffeur=m.id_chauffeur WHERE c.id_chauffeur= ".$id." and m.etat =".$type;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}
