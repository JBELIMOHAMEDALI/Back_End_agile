<?php


class Model_generale extends CI_Model
{
	public function __construct()
	{
	}

	public function add_tab($data,$tab)
	{
		$status = $this->db->insert($tab, $data);
		return($this->db->affected_rows() != 1) ? false : true;
	}
	public function update_tab_bay_id($nom_id,$id,$data,$tab)
	{
		$this->db->where($nom_id, $id);
		$this->db->update($tab, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function get_tab_one_all($id,$tab,$nom_id)
	{
		if($id)
		{
			$this->db->select("*");
			$this->db->from($tab);
			$this->db->where($nom_id,$id);
		}
		else
		{
			$this->db->select("*");
			$this->db->from($tab);

		}

		$query=$this->db->get();
		return $resulta = $query->result_array();
	}
	public function delete_voiture($id,$nom_id,$tab){
		$this->db->where($nom_id, $id);
		$this->db->delete($tab);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}
