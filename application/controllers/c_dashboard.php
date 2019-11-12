<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(['m_barang', 'm_order', 'm_request', 'm_barangmasuk', 'm_returnbarang', 'm_penjualan']);
    is_login();
  }

  public function index()
  {
    $template['title'] = 'siperang | DASHBOARD';
    $data['totalBarang'] = $this->m_barang->getTotal();
    $data['orderBarang'] = $this->m_order->getTotal();
    $data['requestBarang'] = $this->m_request->getTotal();
    $data['barangMasuk'] = $this->m_barangmasuk->getTotal();
    $data['returnBarang'] = $this->m_returnbarang->getTotal();
    $data['totalPenjualan'] = $this->m_penjualan->getTotal();
    $data['totalBarangMasuk'] = $this->m_barangmasuk->getTotalHarga();
    $data['stokMin'] = $this->stokMin();
    $data['chart1'] = $this->grafik_barang();
    $data['chart2'] = $this->grafik_order();
    $data['chart3'] = $this->grafik_request();
    $data['chart4'] = $this->grafik_return();
    $data['chart5'] = $this->grafik_barangmasuk();
    $data['chart6'] = $this->grafik_penjualan_pembelian();
    $data['chart7'] = $this->barangTerlaris();
    $data['tanggal1'] = date('01 M Y');
    $data['tanggal2'] = date('d M Y');
    $this->load->view('template/v_head', $template);
    $this->load->view('template/v_topmenu');
    $this->load->view('template/v_sidebar');
    $this->load->view('template/js');
    $this->load->view('v_utama', $data);
    $this->load->view('template/v_foot');
  }

  public function barangTerlaris()
  {
    $dataChart = [];
    $datas = $this->m_penjualan->getBarangTerlarischart();
    foreach ($datas as $d) {
      $angka = [];
      array_push($angka, floatval($d->jumlah));
      $dataChart[] = [
        'name' => $d->Nama_Barang,
        'data' => $angka
      ];
    }
    $data['chartData'] = json_encode($dataChart);
    return $data;
  }

  public function stokMin()
  {
    $data['jumlah'] = $this->m_barang->getBarangMin(true);
    $data['data'] = $this->m_barang->getBarangMin();
    return $data;
  }

  public function grafik_penjualan_pembelian()
  {
    $getPenjualan = $this->m_penjualan->getTotal();
    $getPembelian = $this->m_barangmasuk->getTotalHarga();
    $dataChart[] = [
      'name' => 'Penjualan',
      'data' => floatval($getPenjualan->total)
    ];

    array_push($dataChart, ['name' => 'Pembelian', 'data' => floatval($getPembelian->total)]);
    $data['chartData'] = json_encode($dataChart);
    return $data;
  }

  public function grafik_barang()
  {
    $get = $this->m_barang->getTotal();
    $dataChart[] = [
      'name' => 'Jumlah Barang',
      'data' => [floatval($get->total)]
    ];
    $data['chartData'] = json_encode($dataChart);
    return $data;
  }

  public function grafik_order()
  {
    $get = $this->m_order->getTotalChart();
    $datas = [];
    $jum = [];
    $cat = [];
    $tooltip = [];
    foreach ($get as $row) :
      array_push($jum, floatval($row->total));
      array_push($tooltip, $row->Tanggal_Order);
      array_push($cat, $row->date);
    endforeach;
    $datas = array_merge(['jumlah' => $jum], ['cat' => $cat], ['tool' => $tooltip]);
    $data['chartData'] = json_encode($datas);
    return $data;
  }

  public function grafik_request()
  {
    $get = $this->m_request->getTotalChart();
    $datas = [];
    $jum = [];
    $cat = [];
    $tooltip = [];
    foreach ($get as $row) :
      array_push($jum, floatval($row->total));
      array_push($tooltip, $row->Tanggal_Request);
      array_push($cat, $row->date);
    endforeach;
    $datas = array_merge(['jumlah' => $jum], ['cat' => $cat], ['tool' => $tooltip]);
    $data['chartData'] = json_encode($datas);
    return $data;
  }

  public function grafik_return()
  {
    $get = $this->m_returnbarang->getTotalChart();
    $datas = [];
    $jum = [];
    $cat = [];
    $tooltip = [];
    foreach ($get as $row) :
      array_push($jum, floatval($row->total));
      array_push($tooltip, $row->Tanggal);
      array_push($cat, $row->date);
    endforeach;
    $datas = array_merge(['jumlah' => $jum], ['cat' => $cat], ['tool' => $tooltip]);
    $data['chartData'] = json_encode($datas);
    return $data;
  }

  public function grafik_barangmasuk()
  {
    $get = $this->m_barangmasuk->getTotalChart();
    $datas = [];
    $jum = [];
    $cat = [];
    $tooltip = [];
    foreach ($get as $row) :
      array_push($jum, floatval($row->total));
      array_push($tooltip, $row->Tanggal);
      array_push($cat, $row->date);
    endforeach;
    $datas = array_merge(['jumlah' => $jum], ['cat' => $cat], ['tool' => $tooltip]);
    $data['chartData'] = json_encode($datas);
    return $data;
  }
}

/* End of file C_dashboard.php */
