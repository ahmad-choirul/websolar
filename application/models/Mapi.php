<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapi extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getcurrenttracker()
	{
		$query = $this->db->query("SELECT * FROM `tabellogtracker` ORDER by waktu desc limit 1");
		return $query->result_array()[0];
	}


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
  $this->db->insert('tabellogtracker', $data);
}
public function getdatarealtimesensor(){
  $query = $this->db->select('*')->from('tabelupdate')->order_by("id","desc")->limit(1)->get();
  $datarealtime = $query->row();
  return json_encode($datarealtime);
}
public function getdatasensor()
{
  $query = "SELECT * FROM `tabellogsensor` ORDER BY `tabellogsensor`.`id` DESC LIMIT 200";
  $hasil= $this->db->query($query)->result_array(); 
  return array_reverse($hasil);
}
public function getdatapergerakantracker()
{
  $query = "SELECT * FROM `tabellogtracker` WHERE date(waktu) = (SELECT date(waktu) from tabellogtracker ORDER BY waktu desc limit 1)";
  $hasil= $this->db->query($query)->result_array(); 
  return array_reverse($hasil);
}
public function getdatapergerakantrackerjson()
{
  $query = "SELECT * FROM `tabellogtracker` WHERE waktu >= NOW() - INTERVAL 3 day ORDER BY `tabellogtracker`.`id` desc LIMIT 1";
  $hasil= $this->db->query($query)->row(); 
  return json_encode($hasil);
}
public function getdatapergerakanaktuator()
{
  $query = "SELECT * FROM `tabellogaktuator` WHERE date(waktu) = (SELECT date(waktu) from tabellogaktuator ORDER BY waktu desc limit 1)";
  $hasil= $this->db->query($query)->result_array(); 
  return array_reverse($hasil);
}
public function get_datalogsensor()
{
  $query = "SELECT * FROM `tabellogsensor` ORDER BY `tabellogsensor`.`id` DESC LIMIT 200";
  $hasil= $this->db->query($query)->result_array(); 
  return array_reverse($hasil);
}
public function get_historysensor()
    {
        return $this->db->get('tabellogsensor')->result();
    }
    public function get_historytracker()
    {
        return $this->db->get('tabellogtracker')->result();
    }
    public function get_historyaktuator($no_aktuator='')
    {
      $this->db->where('no_aktuator', $no_aktuator);
        return $this->db->get('tabellogaktuator')->result();
    }
    public function get_listaktuator()
    {
      $this->db->select('no_aktuator');
      $data = $this->db->get('tabellogaktuator')->result_array();
      $datas[''] = "Pilih no aktuator";
    foreach ($data as $val) {
      $datas[$val["no_aktuator"]] = $val["no_aktuator"];
    }
    return $datas;
    }
}

/* End of file Mapi.php */
/* Location: ./application/models/Mapi.php */