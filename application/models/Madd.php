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
 public function addlog($data)
 {
  $this->db->insert('tabellogv2', $data);
}
public function ambiljsontotal(){
  $query = $this->db->select('*')->from('tabelupdate')->order_by("id","desc")->limit(1)->get();
  $datarealtime = $query->row();
  return json_encode($datarealtime);
}
public function getarrayerrorver()
{
  $query = "SELECT `waktu`,`errorvert` FROM `tabellogv2` ORDER BY `tabellogv2`.`id` DESC LIMIT 50";
  $hasil= $this->db->query($query)->result_array();
  $i=0;
  foreach ($hasil as $val) {
    $datas[$i++] = $val['errorvert'];
  }
  return array_reverse($datas);
}
public function getdatalog()
{
  $query = "SELECT * FROM `tabellogv2` ORDER BY `tabellogv2`.`id` DESC LIMIT 200";
  $hasil= $this->db->query($query)->result_array(); 
  return array_reverse($hasil);
}
public function getdatapergerakantracker()
{
  $query = "SELECT * FROM `tabellogposisi` WHERE date(waktu) = (SELECT date(waktu) from tabellogposisi ORDER BY waktu desc limit 1)";
  $hasil= $this->db->query($query)->result_array(); 
  return array_reverse($hasil);
}
public function getdatapergerakantrackerjson()
{
  $query = "SELECT * FROM `tabellogposisi` WHERE waktu >= NOW() - INTERVAL 3 day ORDER BY `tabellogposisi`.`id` desc LIMIT 1";
  $hasil= $this->db->query($query)->row(); 
  return json_encode($hasil);
}
}

/* End of file Madd.php */
/* Location: ./application/models/Madd.php */