<?php


class Model_voiture extends CI_Model
{
	protected $info = array('nom_tab'=>'voiture', 'nom_id'=>'id_voiture' , 'cond'=>'statut','condvalue'=>'1');
	public function __construct()
	{
	}
	public function add_voiture($data)
	{
		$status = $this->db->insert($this->info['nom_tab'], $data);
		return($this->db->affected_rows() != 1) ? false : true;
	}
	public function update_voiture_bay_id($id,$data)
	{
		$this->db->where($this->info['nom_id'], $id);
		$this->db->update($this->info['nom_tab'], $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function get_voiture_one_all($id=null)
	{
		if($id)
		{
			$this->db->select("*");
			$this->db->from($this->info['nom_tab']);
			$this->db->where($this->info['nom_id'],$id);
		}
		else
		{
			$this->db->select("*");
			$this->db->from($this->info['nom_tab']);
		}

		$query=$this->db->get();
		return $resulta = $query->result_array();
	}
	public function delete_voiture($id){
		$sql="INSERT INTO historique_voiture (id_voiture,matricule, type, dmc, puissance, service, nom_chouffeure, date) 
		select v.id_voiture,v.matricule,v.type,v.dmc,v.puissance,v.service,u.nom_prnom ,CURDATE() as date from voiture v join 
		affectaion_voture_user afv join users u on v.id_voiture = afv.id_voiture and afv.id_ueser=u.id_user WHERE v.id_voiture=".$id;
		$query1 = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			$statue1= true;
		}else{
			$statue1= false;

		}
		$this->db->where($this->info['nom_id'], $id);
		$this->db->delete($this->info['nom_tab']);
		if ($this->db->affected_rows() > 0) {
			$statue2= true;
		}
		else{
			$statue2= false;

		}
		return $statue1 && $statue2;
	}
	public function get_voture_user($id)
	{
		$sql="select * FROM users u join affectaion_voture_user af JOIN voiture v on af.id_ueser=u.id_user AND af.id_voiture=v.id_voiture WHERE u.id_user=".$id;
		$query = $this->db->query($sql);
		return $query->result_array();

	}

}
