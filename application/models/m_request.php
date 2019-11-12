<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_request extends CI_Model
{
  function dataRequest()
  {
    $this->db->from('t_requestbarang');
    $this->db->join('tbl_user', 'tbl_user.Kode_User = t_requestbarang.user');
    $this->db->select('t_requestbarang.*, tbl_user.Nama_User');
    return $this->db->get()->result();
  }

  function kode_otomatis()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(Kode_Request,5)) AS kd_max FROM t_requestbarang");
    $kd = "";
    if ($q->num_rows() > 0) {
      foreach ($q->result() as $k) {
        $tmp = ((int)$k->kd_max) + 1;
        $kd = sprintf("%05s", $tmp);
      }
    } else {
      $kd = "00001";
    }
    $kodemax = str_pad($kd, 5, "0", STR_PAD_LEFT);
    $kodejadi  = "RQ" . time() . $kodemax;
    return $kodejadi;
  }

  function prosesInsert($data, $detil)
  {
    $this->db->trans_start();
    $this->db->insert('t_requestbarang', $data);
    $this->db->insert_batch('t_requestbarang_detil', $detil);
    $this->db->trans_complete();
  }

  function detil($id)
  {
    $this->db->where('Kode_Request', $id);
    return $this->db->get('t_requestbarang_detil')->result();
  }

  function cariRequest($id)
  {
    $this->db->where('Kode_Request', $id);
    $this->db->select('*');
    return $this->db->get('t_requestbarang')->row();
  }

  function cariDetilRequest($id)
  {
    $this->db->where('Kode_Request', $id);
    return $this->db->get('t_requestbarang_detil')->result();
  }

  function prosesUpdate($data, $detil, $id)
  {
    $this->db->trans_start();
    $this->db->where('Kode_Request', $id);
    $this->db->delete('t_requestbarang_detil');

    $this->db->where('Kode_Request', $id);
    $this->db->update('t_requestbarang', $data);

    $this->db->insert_batch('t_requestbarang_detil', $detil);
    $this->db->trans_complete();
  }

  function getReq()
  {
    $sql  =  "SELECT *, GROUP_CONCAT(DISTINCT id SEPARATOR ',') AS 'id_req', GROUP_CONCAT(DISTINCT `Kode_Request` SEPARATOR ',') AS 'kode_req', SUM(`Quantity`) AS 'Jumlah' 
    FROM `t_requestbarang_detil` WHERE `isStatus` = 0
    GROUP BY `Kode_Barang`,`isStatus`";
    return $this->db->query($sql)->result();
  }

  public function getTotal()
  {
    return $this->db->query("SELECT COUNT('Kode_Request') as 'total' FROM t_requestbarang WHERE CONCAT(YEAR(`Tanggal_Request`),'/',MONTH(`Tanggal_Request`)) = CONCAT(YEAR(NOW()),'/',MONTH(NOW())) ")->row();
  }

  public function getTotalChart()
  {
    return $this->db->query("SELECT Tanggal_Request ,COUNT('Kode_Request') as 'total', DAY(Tanggal_Request) AS 'date' FROM t_requestbarang WHERE CONCAT(YEAR(`Tanggal_Request`),'/',MONTH(`Tanggal_Request`)) = CONCAT(YEAR(NOW()),'/',MONTH(NOW())) GROUP BY Tanggal_Request")->result();
  }
}

/* End of file M_request.php */
