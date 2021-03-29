<?php


class Model_user extends CI_Model
{
	public function __construct()
	{
	}
	public function login($email, $password) {
		if($email && $password) {
			$sql = "SELECT * FROM users WHERE email = ? and users.statut = 1";
			$query = $this->db->query($sql, array($email));
			if($query->num_rows() == 1) {
				$result = $query->row_array();
				$hash_password = password_verify($password, $result['password']);
				if($hash_password === true) {
					return $result;
				}
				else {
					return false;
				}
			}
			else {
				return false;
			}
		}
	}
	public function check_matrecule($maty)
	{
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("matricule",$maty);
		$query=$this->db->get();
		return $query->num_rows()==0;
	}
	public function add_user($data)
	{
		$status = $this->db->insert('users', $data);
		return($this->db->affected_rows() != 1) ? false : true;
	}
	public function update_user_bay_id($id,$data)
	{
		$this->db->where('id_user', $id);
		$this->db->update('users', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function get_user($id=null)
	{
		if($id)
		{
			$this->db->select("*");
			$this->db->from("users");
			$this->db->where("id_user",$id);
		}
		else
		{
			$this->db->select("*");
			$this->db->from("users");

		}

		$query=$this->db->get();
		return $resulta = $query->result_array();
	}
	public function delete_user($id){
		$this->db->where('id_user', $id);
		$this->db->delete('users');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function reset_passwored($matrcule,$newpass)
	{
		$sql="UPDATE users SET users.password= '".$newpass."' WHERE matricule ='".$matrcule."'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function active_user($id)
	{
		$this->db->where('id_user ',$id);
		$this->db->set('statut','1',FALSE);
		return $this->db->update('users');
	}



}
