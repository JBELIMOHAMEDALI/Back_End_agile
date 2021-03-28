<?php


class Modele_carnet_bord extends CI_Model
{
	public function __construct()
	{
	}

	public function add_carnet_bord($data)
	{
		$status = $this->db->insert('carnet_bord', $data);
		return($this->db->affected_rows() != 1) ? false : true;
	}
	public function update_carnet_bord_bay_id($id,$data)
	{
		$this->db->where('id_carnet_bord', $id);
		$this->db->update('carnet_bord', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function delete_carnet_bord($id){
		$this->db->where('id_carnet_bord', $id);
		$this->db->delete('carnet_bord');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function get_carnet_bord($id=null)
	{
		if($id)
		{
			$this->db->select("*");
			$this->db->from("carnet_bord");
			$this->db->where("id_carnet_bord",$id);
		}
		else
		{
			$this->db->select("*");
			$this->db->from("carnet_bord");

		}

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

}
