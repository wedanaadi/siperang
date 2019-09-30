<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_barangmasuk extends CI_Model
{
  // function dataBarangMasuk()
  // {
  //   return $this->db->query("SELECT * FROM `t_barangmasuk` WHERE DATE_FORMAT(`Tanggal`,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')")->result();
  // }

  function dataBarangMasuk($tanggal, $supplier = null)
  {
    $this->db->from('t_barangmasuk');
    $this->db->join('tbl_supplier', 'tbl_supplier.Kode_Supplier = t_barangmasuk.Supplier');
    $this->db->where('DATE_FORMAT(`Tanggal`,"%Y-%m-%d") = DATE_FORMAT("' . $tanggal . '","%Y-%m-%d")', null, false);
    if ($supplier != null) {
      $this->db->where('`t_barangmasuk`.Supplier', $supplier);
    }
    $this->db->select('t_barangmasuk.*, tbl_supplier.Nama_Supplier');
    return $this->db->get()->result();
  }

  function kode_otomatis()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(Kode_BarangMasuk,5)) AS kd_max FROM t_barangmasuk");
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
    $kodejadi  = "BM" . time() . $kodemax;
    return $kodejadi;
  }

  function prosesInsert($data, $detil, $idOrder, $stokBarang)
  {
    $this->db->trans_start();
    $this->db->insert('t_barangmasuk', $data);
    $this->db->insert_batch('t_barangmasuk_detil', $detil);

    $this->db->where('Kode_Order', $idOrder);
    $this->db->update('t_order', ['isStatus' => 1]);

    $this->db->update_batch('tbl_databarang', $stokBarang, 'Kode_Barang');

    $this->db->trans_complete();
  }

  function cariBarangMasuk($id)
  {
    $this->db->where('Kode_BarangMasuk', $id);
    return $this->db->get('t_barangmasuk')->row();
  }

  function cariDetil($id)
  {
    $this->db->where('Kode_BarangMasuk', $id);
    return $this->db->get('t_barangmasuk_detil')->result();
  }

  function prosesUpdate($data, $detil, $id, $stokBarang)
  {
    $this->db->trans_start();
    $this->db->where('Kode_BarangMasuk', $id);
    $this->db->delete('t_barangmasuk_detil');

    $this->db->where('Kode_BarangMasuk', $id);
    $this->db->update('t_barangmasuk', $data);

    $this->db->insert_batch('t_barangmasuk_detil', $detil);
    $this->db->update_batch('tbl_databarang', $stokBarang, 'Kode_Barang');
    $this->db->trans_complete();
  }

  public function getTotal()
  {
    return $this->db->query("SELECT COUNT('Kode_BarangMasuk') as 'total' FROM t_barangmasuk WHERE CONCAT(YEAR(`Tanggal`),'/',MONTH(`Tanggal`)) = CONCAT(YEAR(NOW()),'/',MONTH(NOW())) ")->row();
  }

  public function getTotalHarga()
  {
    return $this->db->query("SELECT SUM(Total) AS 'total' FROM `t_barangmasuk` 
    WHERE CONCAT(YEAR(`Tanggal`),'/',MONTH(`Tanggal`)) = CONCAT(YEAR(NOW()),'/',MONTH(NOW()))")->row();
  }
}

/* End of file M_barangmasuk.php */
