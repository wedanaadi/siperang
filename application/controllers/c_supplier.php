<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_supplier extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->model(['m_supplier', 'm_barang']);
  }


  public function index()
  {
    $template['title'] = 'siperang | DAFTAR SUPPLIER';
    $data['listSupplier'] = $this->m_supplier->dataSupplier();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('supplier/v_view', $data);
    $this->load->view('template/v_foot');
  }

  public function tambahSupplier()
  {
    $template['title'] = 'siperang | TAMBAH SUPPLIER';
    $data['listBarang'] = $this->m_barang->dataBarang();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('supplier/v_add', $data);
    $this->load->view('template/v_foot');
  }

  public function buatSupplier()
  {
    $this->form_validation->set_rules('NamaSupplier', 'Nama Supplier', 'trim|required', [
      'required' => 'Nama Supplier harus diisi!'
    ]);
    $this->form_validation->set_rules('AlamatSupplier', 'Alamat Supplier', 'trim|required', [
      'required' => 'Alamat Supplier harus diisi!'
    ]);
    $this->form_validation->set_rules('NoTelp', 'Telepon', 'trim|required', [
      'required' => 'Telepon harus diisi!'
    ]);
    $this->form_validation->set_rules('BarangSupplier[]', 'Barang Supplier', 'trim|required', [
      'required' => 'Barang Supplier harus diisi!'
    ]);

    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $data = [
        'Kode_Supplier' => 'SUP' . time(),
        'Nama_Supplier' => $this->input->post('NamaSupplier'),
        'Alamat_Supplier' => $this->input->post('AlamatSupplier'),
        'No_Tlp' => $this->input->post('NoTelp'),
      ];

      foreach ($this->input->post('BarangSupplier') as $bs) {
        $dataBarang[] = [
          'Id_PK' => generate_token(5) . time(),
          'Id_Supplier' => $data['Kode_Supplier'],
          'Kode_Barang' => $bs['kode']
        ];
      }

      $this->m_supplier->insertSupplier($data, $dataBarang);
      echo json_encode(['success' => true]);
    }
  }

  public function editSupplier($id)
  {
    $template['title'] = 'siperang | UBAH SUPPLIER';
    $data['dataUbah'] = $this->m_supplier->cariSupplier($id);
    $data['listBarang'] = $this->m_barang->dataBarang();
    $data['detilBarangSup'] = json_encode($this->m_supplier->getBarangSupp($id));
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('supplier/v_edit', $data);
    $this->load->view('template/v_foot');
  }

  public function ubahSupplier($id)
  {
    $this->form_validation->set_rules('NamaSupplier', 'Nama Supplier', 'trim|required', [
      'required' => 'Nama Supplier harus diisi!'
    ]);
    $this->form_validation->set_rules('AlamatSupplier', 'Alamat Supplier', 'trim|required', [
      'required' => 'Alamat Supplier harus diisi!'
    ]);
    $this->form_validation->set_rules('NoTelp', 'Telepon', 'trim|required', [
      'required' => 'Telepon harus diisi!'
    ]);

    $this->form_validation->set_rules('BarangSupplier[]', 'Barang Supplier', 'trim|required', [
      'required' => 'Barang Supplier harus diisi!'
    ]);

    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $data = [
        'Nama_Supplier' => $this->input->post('NamaSupplier'),
        'Alamat_Supplier' => $this->input->post('AlamatSupplier'),
        'No_Tlp' => $this->input->post('NoTelp'),
      ];

      foreach ($this->input->post('BarangSupplier') as $bs) {
        $dataBarang[] = [
          'Id_PK' => generate_token(5) . time(),
          'Id_Supplier' => $id,
          'Kode_Barang' => $bs['kode']
        ];
      }

      $this->m_supplier->updateSupplier($data, $id, $dataBarang);
      echo json_encode(['success' => true]);
    }
  }

  public function deleteSupplier($id)
  {
    $this->m_supplier->deleteSupplier($id);
    echo json_encode(['success' => true]);
  }
}

/* End of file C_supplier.php */
