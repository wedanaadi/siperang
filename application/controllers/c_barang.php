<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_barang extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(['m_barang']);
  }

  public function index()
  {
    $template['title'] = 'siperang | DAFTAR BARANG';
    $data['listBarang'] = $this->m_barang->dataBarang();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('barang/v_view', $data);
    $this->load->view('template/v_foot');
  }

  public function tambahBarang()
  {
    $template['title'] = 'siperang | TAMBAH BARANG';
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('barang/v_add');
    $this->load->view('template/v_foot');
  }

  public function buatBarang()
  {
    $this->form_validation->set_rules('KodeBarang', 'Kode Barang', 'trim|required', [
      'required' => 'Kode Barang harus diisi!'
    ]);
    $this->form_validation->set_rules('NamaBarang', 'Nama Barang', 'trim|required', [
      'required' => 'Nama Barang harus diisi!'
    ]);
    $this->form_validation->set_rules('HargaBeli', 'Harga Beli', 'trim|required|numeric', [
      'required' => 'Harga Beli harus diisi!',
      'numeric' => '%s harus berupa angka'
    ]);
    $this->form_validation->set_rules('HargaJual', 'Harga Jual', 'trim|required|numeric', [
      'required' => 'Harga Jual diisi!',
      'numeric' => '%s harus berupa angka'
    ]);
    $this->form_validation->set_rules('Quantity', 'Quantity', 'trim|required|numeric', [
      'required' => 'Quantity diisi!',
      'numeric' => '%s harus berupa angka'
    ]);

    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $data = [
        'Kode_Barang' => $this->input->post('KodeBarang'),
        'Nama_barang' => $this->input->post('NamaBarang'),
        'Harga_Beli' => $this->input->post('HargaBeli'),
        'Harga_Jual' => $this->input->post('HargaJual'),
        'Quantity' => $this->input->post('Quantity'),
      ];

      $this->m_barang->insertBarang($data);
      echo json_encode(['success' => true]);
    }
  }

  public function editBarang($id)
  {
    $template['title'] = 'siperang | UBAH BARANG';
    $data['dataUbah'] = $this->m_barang->cariBarang($id);
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('barang/v_edit', $data);
    $this->load->view('template/v_foot');
  }

  public function updateBarang($id)
  {
    $this->form_validation->set_rules('KodeBarang', 'Kode Barang', 'trim|required', [
      'required' => 'Kode Barang harus diisi!'
    ]);
    $this->form_validation->set_rules('NamaBarang', 'Nama Barang', 'trim|required', [
      'required' => 'Nama Barang harus diisi!'
    ]);
    $this->form_validation->set_rules('HargaBeli', 'Harga Beli', 'trim|required|numeric', [
      'required' => 'Harga Beli harus diisi!',
      'numeric' => '%s harus berupa angka'
    ]);
    $this->form_validation->set_rules('HargaJual', 'Harga Jual', 'trim|required|numeric', [
      'required' => 'Harga Jual diisi!',
      'numeric' => '%s harus berupa angka'
    ]);
    $this->form_validation->set_rules('Quantity', 'Quantity', 'trim|required|numeric', [
      'required' => 'Quantity diisi!',
      'numeric' => '%s harus berupa angka'
    ]);

    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $data = [
        'Kode_Barang' => $this->input->post('KodeBarang'),
        'Nama_barang' => $this->input->post('NamaBarang'),
        'Harga_Beli' => $this->input->post('HargaBeli'),
        'Harga_Jual' => $this->input->post('HargaJual'),
        'Quantity' => $this->input->post('Quantity'),
      ];
      $this->m_barang->updateBarang($data, $id);
      echo json_encode(['success' => true]);
    }
  }

  public function deleteBarang($id)
  {
    $this->m_barang->deleteBarang($id);
    echo json_encode(['success' => true]);
  }

  public function getDetil($id)
  {
    echo json_encode($this->m_barang->cariBarang($id));
  }
}

/* End of file C_barang.php */
