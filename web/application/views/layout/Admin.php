<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Arbolado</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="lib/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="lib/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="lib/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="lib/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="lib/dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="<?php base_url(); ?>lib/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css">

  <link rel="stylesheet" href="<?php base_url() ?>lib/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
  

  <link rel="stylesheet" href="<?php base_url() ?>lib/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" href="<?php base_url() ?>lib/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Bootstrap datetimepicker -->
  <link rel="stylesheet" href="<?php base_url(); ?>lib/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url('css/general.css') ?>">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Leaflet Maps -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
  <style>
    #map {
      height: 100%;
    }
  </style>
  <?php $this->load->view('layout/general_scripts') ?>

</head>

<?php $this->load->view('layout/wait') ?>

<body class="hold-transition skin-green sidebar-mini"></body>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Arbol</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo base_url() ?>assets\img\Isologo.png" class="brandlogo-image">
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <?php

      $this->load->view('layout/perfil');

      ?>


    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php $this->load->view('layout/menu'); ?>

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section id="content" class="content">




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>V.</b>1.0
    </div>
    <!--<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved. -->
    <strong>Copyright &copy; 2019 - SECRETARIA DE AMBIENTE - San Juan</a>.
  </footer>


</div>
<!-- ./wrapper -->
<script>
  var link = '';

  $('.menu .link').on('click', function() {
    link = $(this).data('link');
    linkTo();
  });

  function linkTo(uri = '') {
    if (link == '' && uri == '') return;
    $('#content').empty();
    $('#content').load('<?php base_url() ?>' + (uri == '' ? link : uri));
  }

  function collapse(e) {
    e = $(e).closest('.box');

    if (e.hasClass('collapsed-box')) {
      $(e).removeClass('collapsed-box');
    } else {
      $(e).addClass('collapsed-box');
    }

  }


  /* Abre cuadro cargando ajax */
  function WaitingOpen(texto) {
    if (texto == '' || texto == null) {
      $('#waitingText').html('Cargando ...');
    } else {
      $('#waitingText').html(texto);
    }
    $('#waiting').fadeIn('slow');
  }
  /* Cierra cuadro cargando ajax */
  function WaitingClose() {
    $('#waiting').fadeOut('slow');
  }
</script>
<?php $this->load->view(FRM . "scripts") ?>

</body>

</html>