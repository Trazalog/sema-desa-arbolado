<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct(){

      parent::__construct();
      $this->load->helper('login_helper');
   }
   function index(){
       if(!isset($this->session->userdata['direccion']))
       {
      $dir = 'sema-desa-arbolado';
      login($dir);
       }
       else
       {
        if($this->session->userdata['direccion'] == 'sema-desa-arbolado/Dash')
        {
            redirect('Dash');
        }else{
            $this->session->set_userdata('direccionsalida','sema-desa-arbolado/Login');
            logout();
        }
       }
       }
  function log_out()
  {
      logout();
  }
   function edit()
   {
       editar();
   }
   function usuarios()
   {
       admin_usuarios();
   }
}
?>