<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct(){

      parent::__construct();
      $this->load->helper('login_helper');
   }
   function index(){
      $dir = 'sema-desa-arbolado';
      login($dir);
       }
  function log_out()
  {
      logout();
  }
   function edit()
   {
       editar();
   }
}
?>