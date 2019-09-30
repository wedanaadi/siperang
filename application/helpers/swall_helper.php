<?php defined('BASEPATH') OR exit('No direct script access allowed');
  function swall_success($pesan) 
  {
    return [
      'type' => 'success',
      'pesan' => $pesan,
      'title' => 'Berhasil',
    ];
  }

  function swall_error($pesan) 
  {
    return [
      'type' => 'error',
      'pesan' => $pesan,
      'title' => 'Gagal',
    ];
  }

  function swall_berhasil($pesan)
  {
    return [
      'title' => 'Horeeee!!',
      "text" => $pesan,
      'imageUrl' => base_url('assets/img/smile.png'),
      'showConfirmButton' => true,
    ];
  }

  function swall_gagal($pesan)
  {
    return [
      'title' => 'Oops..',
      "text" => $pesan,
      'imageUrl' => base_url('assets/img/sad.png'),
      'showConfirmButton' => true,
    ];
  }