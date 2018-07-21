<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
<meta charset="utf-8" >
<title>E-kasir</title>
<link rel="icon" href="<?php echo base_url('assets/gambar/');?>ico.png" type="image/ico" />
<link href="<?php echo base_url();?>assets/daterange/daterangepicker.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/custom_dedi.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>assets/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<link href="<?php echo base_url() ?>assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url();?>assets/chart/dist/Chart.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/chart/dist/Chart.js" type="text/javascript"></script>

</head>
<body style="background-image: url('<?php echo base_url()?>assets/gambar/bg.gif');">
<div class="loading" id="loading" style="display: none;"><div></div><div></div><div></div><div></div></div>
<nav id="myScrollspy" class="navbar-default navbar-static-top"role="navigation" style="background-color:#169F85;">
<div class="container">     
<div class="navbar-header">
<button class="navbar-toggle" type="button" data-toggle="collapse"
data-target=".bs-js-navbar-scrollspy">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
    <a class="navbar-brand" href="<?php echo base_url('Kasir'); ?>">E-kasir <span class="fa fa-shopping-basket"></span></a>
</div>

<div class="pull-right collapse navbar-collapse bs-js-navbar-scrollspy">
<a class="navbar-brand" href="<?php echo base_url('Kasir'); ?>"><span class="fa fa-backward"></span> Menu Utama </a>
<a class="navbar-brand" href="#">Notifikasi <span class="fa fa-bell-o"></span></a>
<a class="navbar-brand" href="<?php echo base_url("P_login/keluar"); ?>">Keluar <span class="fa fa-sign-out"></span></a>

</div>
</div>
</nav>
