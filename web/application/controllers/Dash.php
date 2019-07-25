<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {
    function __construct(){

      parent::__construct();
      $this->load->helper('file');
      $this->load->helper('login_helper');
     
      if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/web/Dash')
      {
       $this->session->set_userdata('direccionsalida','sema-desa-arbolado/web/Login');
       logout();
      }
     
   }
   function index(){
      
      $this->load->view('layout/Admin');
      
   }
}
?>