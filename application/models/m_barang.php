<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{
  function dataBarang()
  {
    return $this->db->query("SELECT * FROM tbl_databarang WHERE isAktif = '1'")->result();
  }

  function insertBarang($data)
  {
    $this->db->insert('tbl_databarang', $data);
  }

  function cariBarang($id)
  {
    return $this->db->query("SELECT * FROM tbl_databarang WHERE Kode_Barang = '$id'")->row();
  }

  function updateBarang($data, $id)
  {
    $this->db->where('Kode_Barang', $id);
    $this->db->update('tbl_databarang', $data);
  }

  function deleteBarang($id)
  {
    $this->db->where('Kode_Barang', $id);
    $this->db->update('tbl_databarang', ['isAktif' => 0]);
  }

  function getTotal()
  {
    return $this->db->query("SELECT COUNT('Kode_Barang') as 'total' FROM tbl_databarang WHERE isAktif = '1'")->row();
  }

  function getBarangMin($count = false)
  {
    $this->db->where('Quantity < ', 10);
    $this->db->select('*');
    $this->db->from('tbl_databarang');
    if ($count) {
      return $this->db->count_all_results();
    } else {
      return $this->db->get()->result();
    }
  }

  function kode_otomatis()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(Kode_Barang,5)) AS kd_max FROM tbl_databarang");
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
    $kodejadi  = $kodemax;
    return $kodejadi;
  }
}

/* End of file M_barang.php */
