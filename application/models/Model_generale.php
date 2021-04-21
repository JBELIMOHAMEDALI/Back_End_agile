<?php


class Model_generale extends CI_Model
{
	public function __construct()
	{
	}
	public function reset_passwored($matrcule,$newpass,$nomtab,$email)
	{
		$sql="UPDATE ".$nomtab." SET password= '".$newpass."' WHERE matricule ='".$matrcule."' and email = '".$email."' and statut=1";
		$query = $this->db->query($sql);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function supprimer($id,$tab,$nomId)
	{
		$this->db->where($nomId,$id);
		$this->db->set('statut','1',FALSE);
		return $this->db->update($tab);
	}
	public function delete_fn($id,$tab,$nomIab){
		$this->db->where($nomIab, $id);
		$this->db->delete($tab);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function get_fn_active($id=null,$tabnam,$idname=null)
	{
		$this->db->select("*");
		$this->db->from($tabnam);
		if($id && $idname)
		{
			$this->db->where($idname,$id);
		}
		$this->db->where('statut ','1');
		$query=$this->db->get();
		return $resulta = $query->result_array();
	}
	public function get_fn_Not_active($id=null,$tabnam,$idname=null)
	{
		$this->db->select("*");
		$this->db->from($tabnam);
		if($id && $idname)
		{
			$this->db->where($idname,$id);
		}
		$this->db->where('statut ','0');
		$query=$this->db->get();
		return $resulta = $query->result_array();
	}
	public function get_fn_Generale($id=null,$tabnam,$idname=null)
	{
		$this->db->select("*");
		$this->db->from($tabnam);
		if($id && $idname)
		{
			$this->db->where($idname,$id);
		}
		$query=$this->db->get();
		return $resulta = $query->result_array();
	}
	public function login($email, $password,$tabName) {
		if($email && $password) {
			$sql = "SELECT * FROM ".$tabName." WHERE email = ? and ".$tabName.".statut = 1";
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
	public function check_matrecule($maty,$name,$tab)
	{
		$this->db->select("*");
		$this->db->from($tab);
		$this->db->where($name,$maty);
		$query=$this->db->get();
		return $query->num_rows()==0;
	}
	public function add_fn($data,$tabName)
	{
		$status = $this->db->insert($tabName, $data);
		return($this->db->affected_rows() != 1) ? false : true;
	}
	public function update_fn_bay_id($id,$data,$tab,$nomId)
	{
		$this->db->where($nomId, $id);
		$this->db->update($tab,$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function active_desc_user($id,$statut,$tabname,$idname)
	{
		$this->db->where($idname,$id);
		$this->db->set('statut',$statut,FALSE);
		return $this->db->update($tabname);
	}
	public function upadte_passwored_first_connection($id,$passwored,$tabname,$idname)
	{
		$sql="UPDATE ".$tabname." SET password= '".$passwored."' WHERE ".$idname."  = ".$id;
		$query = $this->db->query($sql);
		$statue2=$this->db->affected_rows() > 0 ;
		if($statue2){
		$this->db->where($idname,$id);
		$this->db->set('first_connected',"1",FALSE);
		$statue_first_con= $this->db->update($tabname);
		if ($statue2 && $statue_first_con ) {
			return true;
		} else {
			return false;
		}
		}else{
			return false ;
		}
	}

}
