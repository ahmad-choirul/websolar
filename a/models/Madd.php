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
public function ambiljson(){
  $query = $this->db->select('*')->from('tabelupdate')->order_by("id","desc")->limit(1)->get();
  $hasil = $query->result_array();;
  return json_encode($hasil);
}
public function addlog($data)
{
  $this->db->insert('tabellogv2', $data);
}
}

/* End of file Madd.php */
/* Location: ./application/models/Madd.php */