<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_stockopname extends CI_Model
{
  function prosesInsert($so, $barang)
  {
    $this->db->trans_start();
    $this->db->insert_batch('t_stockopname', $so);
    $this->db->update_batch('tbl_databarang', $barang, 'Kode_Barang');
    $this->db->trans_complete();
  }

  function dataStockOpname($tgl)
  {
    return $this->db->query("SELECT *, (`Selisih` * Harga) AS 'Subtotal' FROM `t_stockopname` WHERE DATE_FORMAT(`Tanggal`,'%Y-%m-%d') = '$tgl' ORDER BY Kode_Barang")->result();
  }
}

/* End of file M_stockopname.php */
