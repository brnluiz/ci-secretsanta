<?php
class Users_model extends CI_Model{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function get_all()
	{
		$this->db->select('name,twitter')
		->from('users');
		
		return $this->db->get()->result();
	}
	function chk_user($email)
	{
		return $this->db->select('email')
		->from('users')
		->where('email',$email)
		->count_all_results();
	}

	function get_user_data($id)
	{
		return $this->db->from('users')->where('id',$id)->get()->row();
	}

	function save($data)
	{
		$id = $this->session->userdata('id');
		if(!empty($id))
		{
			$data['id'] = $id;
			return $this->db->where('id',$id)->update('users',$data);
		}
		else
			return $this->db->insert('users',$data);
	}
	function login($email,$pswd)
	{
		if($email == '0') $email = '';
		if($pswd == '0') $pswd = '';

		$r = $this->db->select('id')
		->from('users')
		->where('email',$email)
		->where('pswd',$pswd)
		->get()->row();

		if(!empty($r)) return $r->id;
		else return false;
	}
}