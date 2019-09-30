<?php defined('BASEPATH') OR exit('No direct script access allowed');

function generate_token($random_length)
{
  $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdhijklmnopqrstuvwxyz1234567890';
  $tring = '';
  $max = strlen($characters) - 1;

  for ($i=0; $i < $random_length; $i++) {
    $tring.= $characters[mt_rand(0,$max)];
  }

  return $tring;
}