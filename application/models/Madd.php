<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Madd extends CI_Model {

	public function update($data)
	{
    $this->db->set($data);
    $this->db->where('id', 1);
    $this->db->update('tabelupdate');
  }
  public function registrasi($data)
  {
   $insert = $this->db->insert('admin', $data);
   return $data;
 }
 public function ambil(){
  $query = $this->db->select('nilaikemiringan')->from('data')->order_by("id","desc")->limit(1)->get();
  return $query->row()->nilaikemiringan; 
}
public function ambiljsontotal(){
  $query = $this->db->select('*')->from('tabelupdate')->order_by("id","desc")->limit(1)->get();
  $hasil = $query->row();
  return json_encode($hasil);
}
}

/* End of file Madd.php */
/* Location: ./application/models/Madd.php */