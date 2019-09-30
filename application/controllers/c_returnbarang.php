<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_returnbarang extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(['m_barang', 'm_returnbarang', 'm_supplier']);
    is_login();
  }

  public function index()
  {
    $template['title'] = 'siperang | RETURN BARANG';
    $data['listSupplier'] = $this->m_supplier->dataSupplier();
    $data['listReturn'] = $this->m_returnbarang->dataReturn(date('Y-m-d'));
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('return/v_view', $data);
    $this->load->view('template/v_foot');
  }

  public function tambahReturn()
  {
    $template['title'] = 'siperang | TAMBAH RETURN BARANG';
    $data['listSupplier'] = $this->m_supplier->dataSupplier();
    $data['listBarang'] = $this->m_barang->dataBarang();
    $data['KodeReturn'] = $this->m_returnbarang->kode_otomatis();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('return/v_add', $data);
    $this->load->view('template/v_foot');
  }

  public function addBarang()
  {
    $this->form_validation->set_rules('KodeBarang', 'Kode Barang', 'trim|required', [
      'required' => 'Kode Barang harus diisi!'
    ]);
    $this->form_validation->set_rules('NamaBarang', 'Nama Barang', 'trim|required', [
      'required' => 'Nama Barang harus diisi!'
    ]);
    $this->form_validation->set_rules('HargaBeli', 'Harga Beli', 'trim|required|numeric', [
      'required' => 'Harga Beli diisi!',
      'numeric' => '%s harus berupa angka'
    ]);
    $this->form_validation->set_rules('Quantity', 'Quantity', 'trim|required|numeric', [
      'required' => 'Quantity diisi!',
      'numeric' => '%s harus berupa angka'
    ]);
    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      echo json_encode(['success' => true]);
    }
  }

  public function insertReturn()
  {
    $this->form_validation->set_rules('Kode', 'Kode Transaksi', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('KodeSupplier', 'Kode Suplier', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('NamaSupplier', 'Nama Suplier', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('Detil[]', 'Detil Barang', 'required', [
      'required' => 'Tidak ada barang yang dipilih!'
    ]);
    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $updateStok = [];
      foreach ($this->input->post('Detil') as $row) {
        $detil[] = [
          'id' => generate_token(5) . time(),
          'Kode_Return' => $this->input->post('Kode'),
          'Kode_Barang' => $row[0],
          'Nama_Barang' => $row[1],
          'Harga_Barang' => $row[2],
          'Quantity' => $row[3],
          'Subtotal' => $row[4],
        ];

        $getBarang = $this->m_barang->cariBarang($row[0]);
        array_push($updateStok, ['Kode_Barang' => $row[0], 'Quantity' => $getBarang->Quantity - $row[3]]);
      }

      $data = [
        'Kode_Return' => $this->input->post('Kode'),
        'Supplier' => $this->input->post('KodeSupplier'),
        'Tanggal' => date('Y-m-d'),
        'Total' => $this->input->post('Total'),
      ];

      $this->m_returnbarang->prosesInsert($data, $detil, $updateStok);
      echo json_encode(['success' => true]);
    }
  }

  public function getSupplierData()
  {
    $id = $this->input->post('id');
    echo json_encode($this->m_supplier->cariSupplier($id));
  }

  public function editReturn($id)
  {
    $template['title'] = 'siperang | UBAH RETURN BARANG';
    $data['return'] = $this->m_returnbarang->cariReturn($id);
    $data['dataSupplier'] = $this->m_supplier->cariSupplier($data['return']->Supplier);
    $data['detil'] = json_encode($this->m_returnbarang->cariDetil($id));
    $data['listSupplier'] = $this->m_supplier->dataSupplier();
    $data['listBarang'] = $this->m_barang->dataBarang();
    $data['KodeReturn'] = $this->m_returnbarang->kode_otomatis();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('return/v_edit', $data);
    $this->load->view('template/v_foot');
  }

  public function updateReturn($id)
  {
    $this->form_validation->set_rules('Kode', 'Kode Transaksi', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('KodeSupplier', 'Kode Suplier', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('NamaSupplier', 'Nama Suplier', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('Detil[]', 'Detil Barang', 'required', [
      'required' => 'Tidak ada barang yang dipilih!'
    ]);
    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      foreach ($this->input->post('old') as $old) {
        $getBarangold = $this->m_barang->cariBarang($old['Kode_Barang']);
        $dataOld = [
          'Quantity' => $old['Quantity'] + $getBarangold->Quantity,
        ];
        $this->m_barang->updateBarang($dataOld, $old['Kode_Barang']);
      }

      $updateStok = [];
      foreach ($this->input->post('Detil') as $row) {
        $detil[] = [
          'id' => generate_token(5) . time(),
          'Kode_Return' => $this->input->post('Kode'),
          'Kode_Barang' => $row[0],
          'Nama_Barang' => $row[1],
          'Harga_Barang' => $row[2],
          'Quantity' => $row[3],
          'Subtotal' => $row[4],
        ];

        $getBarang = $this->m_barang->cariBarang($row[0]);
        array_push($updateStok, ['Kode_Barang' => $row[0], 'Quantity' => $getBarang->Quantity - $row[3]]);
      }

      $data = [
        'Kode_Return' => $this->input->post('Kode'),
        'Supplier' => $this->input->post('KodeSupplier'),
        'Tanggal' => date('Y-m-d'),
        'Total' => $this->input->post('Total'),
      ];

      $this->m_returnbarang->prosesUpdate($data, $detil, $updateStok, $id);
      echo json_encode(['success' => true]);
    }
  }

  public function detil($id)
  {
    $data = $this->m_returnbarang->cariDetil($id);
    echo json_encode($data);
  }

  public function getReturnJson()
  {
    $tanggal = $this->input->post('Tanggal');
    $supplier = $this->input->post('Supplier') == 'ALL' ? null : $this->input->post('Supplier');
    $data = $this->m_returnbarang->dataReturn($tanggal, $supplier);
    echo json_encode($data);
  }
}

/* End of file C_returnbarang.php */
