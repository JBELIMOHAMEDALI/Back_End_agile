<?php


class Model_affectation extends CI_Model
{
	public function __construct()
	{
	}

	public function add_Affectation($data)
	{
		$status = $this->db->insert('affectaion', $data);
		return($this->db->affected_rows() != 1) ? false : true;
	}
	public function update_Affectation_bay_id($id,$data)
	{
		$this->db->where('id_affectaion ', $id);
		$this->db->update('affectaion', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function delete_Affectation($id){
		$this->db->where('id_affectaion', $id);
		$this->db->delete('affectaion');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function get_Affectation($id=null)
	{
		if($id)
		{
			$this->db->select("*");
			$this->db->from("affectaion");
			$this->db->where("id_affectaion",$id);
		}
		else
		{
			$this->db->select("*");
			$this->db->from("affectaion");

		}

		$query=$this->db->get();
		return $resulta = $query->result_array();
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
