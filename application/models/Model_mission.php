<?php


class Model_mission extends CI_Model
{
	public function don_fn($id,$date_real)
	{
		$this->db->where("id_mission ",$id);
		$this->db->set('etat',"1",FALSE);
		$this->db->set('periode_rael',$date_real,FALSE);
		return $this->db->update('mission');
	}
	public function get_date_debut($id)
	{
		$sql="SELECT mission.date_debut  FROM mission WHERE mission.id_mission= ".$id;
		$query = $this->db->query($sql);
		return $query->result();
	}

}
