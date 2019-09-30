<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_returnbarang extends CI_Model
{
  function dataReturn($tanggal, $supplier = null)
  {
    $this->db->from('t_returnbarang');
    $this->db->join('tbl_supplier', 'tbl_supplier.Kode_Supplier = t_returnbarang.Supplier');
    $this->db->where('DATE_FORMAT(`Tanggal`,"%Y-%m-%d") = DATE_FORMAT("' . $tanggal . '","%Y-%m-%d")', null, false);
    if ($supplier != null) {
      $this->db->where('`t_returnbarang`.Supplier', $supplier);
    }
    $this->db->select('t_returnbarang.*, tbl_supplier.Nama_Supplier');
    return $this->db->get()->result();
  }

  function kode_otomatis()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(Kode_Return,5)) AS kd_max FROM t_returnbarang");
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
    $kodejadi  = "RB" . time() . $kodemax;
    return $kodejadi;
  }

  function prosesInsert($data, $detil, $stok)
  {
    $this->db->trans_start();
    $this->db->insert('t_returnbarang', $data);
    $this->db->insert_batch('t_returnbarang_detil', $detil);
    $this->db->update_batch('tbl_databarang', $stok, 'Kode_Barang');
    $this->db->trans_complete();
  }

  function cariReturn($id)
  {
    $this->db->where('Kode_Return', $id);
    return $this->db->get('t_returnbarang')->row();
  }

  function cariDetil($id)
  {
    $this->db->where('Kode_Return', $id);
    return $this->db->get('t_returnbarang_detil')->result();
  }

  function prosesUpdate($data, $detil, $stok, $id)
  {
    $this->db->trans_start();
    $this->db->where('Kode_Return', $id);
    $this->db->delete('t_returnbarang_detil');

    $this->db->where('Kode_Return', $id);
    $this->db->update('t_returnbarang', $data);

    $this->db->insert_batch('t_returnbarang_detil', $detil);
    $this->db->update_batch('tbl_databarang', $stok, 'Kode_Barang');
    $this->db->trans_complete();
  }

  public function getTotal()
  {
    return $this->db->query("SELECT COUNT('Kode_Return') as 'total' FROM t_returnbarang WHERE CONCAT(YEAR(`Tanggal`),'/',MONTH(`Tanggal`)) = CONCAT(YEAR(NOW()),'/',MONTH(NOW())) ")->row();
  }
}

/* End of file M_returnbarang.php */
