<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_supplier extends CI_Model
{

  function dataSupplier()
  {
    return $this->db->query("SELECT * FROM tbl_supplier")->result();
  }

  function insertSupplier($data)
  {
    $this->db->insert('tbl_supplier', $data);
  }

  function cariSupplier($id)
  {
    return $this->db->query("SELECT * FROM tbl_supplier WHERE Kode_Supplier = '$id'")->row();
  }

  function updateSupplier($data, $id)
  {
    $this->db->where('Kode_Supplier', $id);
    $this->db->update('tbl_supplier', $data);
  }

  function deleteSupplier($id)
  {
    $this->db->where('Kode_Supplier', $id);
    $this->db->delete('tbl_supplier');
  }
}

/* End of file M_supplier.php */
