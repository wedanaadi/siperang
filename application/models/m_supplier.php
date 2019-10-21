<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_supplier extends CI_Model
{

  function dataSupplier()
  {
    return $this->db->query("SELECT * FROM tbl_supplier")->result();
  }

  function insertSupplier($data, $barang)
  {
    $this->db->insert('tbl_supplier', $data);
    $this->db->insert_batch('t_barang_supplier', $barang);
  }

  function cariSupplier($id)
  {
    return $this->db->query("SELECT * FROM tbl_supplier WHERE Kode_Supplier = '$id'")->row();
  }

  function updateSupplier($data, $id, $barang)
  {
    $this->db->where('Id_Supplier', $id);
    $this->db->delete('t_barang_supplier');

    $this->db->where('Kode_Supplier', $id);
    $this->db->update('tbl_supplier', $data);

    $this->db->insert_batch('t_barang_supplier', $barang);
  }

  function deleteSupplier($id)
  {
    $this->db->where('Kode_Supplier', $id);
    $this->db->delete('tbl_supplier');
  }

  function getBarangSupp($id)
  {
    $this->db->where('Id_supplier', $id);
    return $this->db->get('t_barang_supplier')->result();
  }

  function getReq($id)
  {
    $sql = "SELECT *, GROUP_CONCAT(DISTINCT id SEPARATOR ',') AS 'id_req', GROUP_CONCAT(DISTINCT `Kode_Request` SEPARATOR ',') AS 'kode_req', SUM(`Quantity`) AS 'Jumlah' FROM (
      SELECT `t_barang_supplier`.* FROM `t_barang_supplier`
      INNER JOIN `tbl_databarang` ON `tbl_databarang`.`Kode_Barang` = `t_barang_supplier`.`Kode_Barang`
    ) AS t_join
    INNER JOIN `t_requestbarang_detil` ON `t_requestbarang_detil`.`Kode_Barang` = `t_join`.`Kode_Barang`
    WHERE `Id_Supplier` = '$id' AND `t_requestbarang_detil`.`isStatus` = '0'
    GROUP BY `t_requestbarang_detil`.`Kode_Barang`, `t_requestbarang_detil`.`isStatus`
    ";

    return $this->db->query($sql)->result();
  }

  function getBarangSupplier($id)
  {
    $this->db->where('Id_Supplier', $id);
    $this->db->join('tbl_databarang', 'tbl_databarang.Kode_Barang = t_barang_supplier.Kode_Barang');
    $this->db->select('tbl_databarang.*');
    return $this->db->get('t_barang_supplier')->result();
  }
}

/* End of file M_supplier.php */
