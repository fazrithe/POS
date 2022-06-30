<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('remove_comma')) {
  function remove_comma($value) {
    return str_replace(',','',$value);
  }
}

