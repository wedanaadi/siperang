<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_penjualan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model([
      'm_penjualan',
      'm_barang'
    ]);
    $this->load->library(['create_pdf']);
    is_login();
  }

  public function index()
  {
    $template['title'] = 'siperang | TRANSAKSI PENJUALAN';
    $data['listTransaksi'] = $this->m_penjualan->dataPenjualan();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('penjualan/v_view', $data);
    $this->load->view('template/v_foot');
  }

  public function PelunasanTrx($id)
  {
    $data = [
      'DP' => 0,
      'Sisa' => 0,
      'StatusTransaksi' => 1,
      'Tanggal_Pelunasan' => date('Y-m-d')
    ];
    $this->m_penjualan->updatePelunasan($data, $id);
    echo json_encode(['success' => true]);
  }

  public function getTransaksi()
  {
    $getTS = DateTime::createFromFormat('Y/m/d', $this->input->post('tanggalawal'));
    $tanggalawal = $getTS->format('Y-m-d');
    $getTE = DateTime::createFromFormat('Y/m/d', $this->input->post('tanggalakhir'));
    $tanggalakhir = $getTE->format('Y-m-d');
    $data = $this->m_penjualan->dataPenjualanjson($tanggalawal, $tanggalakhir);
    echo json_encode($data);
  }

  public function tambahTransaksi()
  {
    $template['title'] = 'siperang | TAMBAH TRANSAKSI PENJUALAN';
    $data['listBarang'] = $this->m_barang->dataBarang();
    $data['kodeTrx'] = $this->m_penjualan->kode_otomatis();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('penjualan/v_add', $data);
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
      echo json_encode(['success' => true]);
    }
  }

  public function insertTrx()
  {
    $this->form_validation->set_rules('Kode', 'Kode Transaksi', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('Detil[]', 'Detil Barang', 'required', [
      'required' => 'Tidak ada barang yang dipilih!'
    ]);
    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $stokRev = [];
      $index = 0;
      foreach ($this->input->post('Detil') as $row) {
        $detil[] = [
          'idDetil' => generate_token(5) . time(),
          'Kode_Transaksi' => $this->input->post('Kode'),
          'Kode_Barang' => $row[0],
          'Nama_Barang' => $row[1],
          'Harga_Barang' => $row[2],
          'Quantity' => $row[3],
          'Subtotal' => $row[4],
        ];

        $getBarang = $this->m_barang->cariBarang($row[0]);

        if ($getBarang->Quantity - $row[3] < 0) {
          $stockMin = [
            'kodeBarang' => $row[0] . '( ' . $row[1] . ' )',
            'stock_available' => $getBarang->Quantity
          ];
          $stokRev[$index] = $stockMin;
          $index++;
        }

        $barang[] = [
          'Kode_Barang' => $row[0],
          'Quantity' => $getBarang->Quantity - $row[3]
        ];
      }

      $getDUE = DateTime::createFromFormat('Y/m/d', $this->input->post('duedate'));
      $tanggalJatuhTempo = $getDUE->format('Y-m-d');

      $data = [
        'Kode_Transaksi' => $this->input->post('Kode'),
        'Tanggal_Transaksi' => date('Y-m-d'),
        'Total' => $this->input->post('Total'),
        'DP' => $this->input->post('DP'),
        'StatusTransaksi' => $this->input->post('method'),
        'Tanggal_JatuhTempo' => $tanggalJatuhTempo,
        'Sisa' => $this->input->post('sisa'),
        'Tanggal_Pelunasan' => date('Y-m-d')
      ];
      if (count($stokRev) > 0) {
        echo json_encode(['revisi' => true, 'min' => $stokRev, 'jumlah' => count($stokRev)]);
      } else {
        $this->m_penjualan->prosesInsertTrx($barang, $data, $detil);
        echo json_encode(['success' => true]);
      }
    }
  }

  public function detil($id)
  {
    $data = $this->m_penjualan->detil($id);
    echo json_encode($data);
  }

  public function editTrx($id)
  {
    $template['title'] = 'siperang | UBAH TRANSAKSI PENJUALAN';
    $data['listBarang'] = $this->m_barang->dataBarang();
    $data['trx'] = $this->m_penjualan->cariTrx($id);
    $data['detil'] = json_encode($this->m_penjualan->cariDetilTrx($id));
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('penjualan/v_edit', $data);
    $this->load->view('template/v_foot');
  }

  public function updateTrx($id)
  {
    $this->form_validation->set_rules('Kode', 'Kode Transaksi', 'trim|required', [
      'required' => '%s harus diisi!'
    ]);
    $this->form_validation->set_rules('Detil[]', 'Detil Barang', 'required', [
      'required' => 'Tidak ada barang yang dipilih!'
    ]);
    if ($this->form_validation->run() == false) {
      echo json_encode(['is_error' => true, 'errors' => $this->form_validation->error_array()]);
    } else {
      $stokRev = [];
      $index = 0;

      foreach ($this->input->post('old') as $old) {
        $getBarangOld = $this->m_barang->cariBarang($old['Kode_Barang']);
        $barangOld[] = [
          'Kode_Barang' => $old['Kode_Barang'],
          'Quantity' => $getBarangOld->Quantity + $old['Quantity']
        ];

        $barangOldRev[] = [
          'Kode_Barang' => $old['Kode_Barang'],
          'Quantity' => $getBarangOld->Quantity
        ];
      }

      foreach ($this->input->post('Detil') as $row) {
        $getBarang = $this->m_barang->cariBarang($row[0]);
        if ($getBarang->Quantity - $row[3] < 0) {
          $stockMin = [
            'kodeBarang' => $row[0] . '( ' . $row[1] . ' )',
            'stock_available' => $getBarang->Quantity
          ];
          $stokRev[$index] = $stockMin;
          $index++;
        }
      }

      $this->m_penjualan->updateStokOld($barangOld);

      foreach ($this->input->post('Detil') as $row) {
        $detil[] = [
          'idDetil' => generate_token(5) . time(),
          'Kode_Transaksi' => $this->input->post('Kode'),
          'Kode_Barang' => $row[0],
          'Nama_Barang' => $row[1],
          'Harga_Barang' => $row[2],
          'Quantity' => $row[3],
          'Subtotal' => $row[4],
        ];

        $getBarang = $this->m_barang->cariBarang($row[0]);

        $barang[] = [
          'Kode_Barang' => $row[0],
          'Quantity' => $getBarang->Quantity - $row[3]
        ];
      }

      $data = [
        'Kode_Transaksi' => $this->input->post('Kode'),
        'Total' => $this->input->post('Total'),
        'DP' => $this->input->post('DP'),
        'Sisa' => $this->input->post('sisa')
      ];

      if (count($stokRev) > 0) {
        $this->m_penjualan->updateStokOld($barangOldRev);
        echo json_encode(['revisi' => true, 'min' => $stokRev, 'jumlah' => count($stokRev)]);
      } else {
        $this->m_penjualan->prosesUpdateTrx($id, $barang, $data, $detil);
        echo json_encode(['success' => true]);
      }
    }
  }

  public function cetakHeader()
  {
    $data = $this->load->view('template/v_template_report', null, true);
    return $data;
  }

  public function cetakListTrx($start, $end)
  {
    $data['header'] = $this->cetakHeader();
    $data['konten'] = $this->m_penjualan->dataPenjualanjson($start, $end);
    $data['start'] = $start;
    $data['end'] = $end;
    $html = $this->load->view('penjualan/v_cetak', $data, TRUE);
    $this->create_pdf->load($html, 'List Transaksi', 'A4-L');
  }

  public function laporan()
  {
    $template['title'] = 'siperang | LAPORAN PENJUALAN';
    $data['listdata'] = $this->m_penjualan->dataLaporan();
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('penjualan/v_laporan', $data);
    $this->load->view('template/v_foot');
  }

  public function getLaporan()
  {
    $getTS = DateTime::createFromFormat('Y/m/d', $this->input->post('tanggalawal'));
    $tanggalawal = $getTS->format('Y-m-d');
    $getTE = DateTime::createFromFormat('Y/m/d', $this->input->post('tanggalakhir'));
    $tanggalakhir = $getTE->format('Y-m-d');
    $data = $this->m_penjualan->dataLaporanJSON($tanggalawal, $tanggalakhir);
    echo json_encode($data);
  }

  public function cetakLaporan($start, $end)
  {
    $data['header'] = $this->cetakHeader();
    $data['konten'] = $this->m_penjualan->dataLaporanJSON($start, $end);
    $data['start'] = $start;
    $data['end'] = $end;
    $html = $this->load->view('penjualan/v_cetak_laporan', $data, TRUE);
    $this->create_pdf->load($html, 'Laporan Transaksi', 'A4-L');
  }

  public function printTrx($id)
  {
    $data['header'] = $this->cetakHeader();
    $data['trx'] = $this->m_penjualan->dataTrxPilihJSON($id);
    $data['trxDetil'] = $this->m_penjualan->dataDetilTrxPilihJSON($id);
    $html = $this->load->view('penjualan/v_cetak_trx_pilih', $data, TRUE);
    $this->create_pdf->load($html, 'Laporan Transaksi', 'A5-P');
  }

  public function laporanBarang()
  {
    $template['title'] = 'siperang | LAPORAN BARANG TERLARIS';
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('penjualan/v_barang_terlaris');
    $this->load->view('template/v_foot');
  }

  public function cetakBarangTerlaris($start, $end)
  {
    $data['header'] = $this->cetakHeader();
    $data['konten'] = $this->m_penjualan->getBarangTerlaris($start, $end);
    $data['start'] = $start;
    $data['end'] = $end;
    $html = $this->load->view('penjualan/v_cetak_barang_terlaris', $data, TRUE);
    $this->create_pdf->load($html, 'Laporan Barang Terlaris', 'A4-P');
  }
}

/* End of file C_penjualan.php */
