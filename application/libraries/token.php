<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class token {

  var $CI = NULL;
  function __construct(){
      $this->ci =& get_instance();
  }

  public function generate_token($random_length)
  {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $tring = '';
    $max = strlen($characters) - 1;

    for ($i=0; $i < $random_length; $i++) {
      $tring.= $characters[mt_rand(0,$max)];
    }

    return $tring;
  }

}
