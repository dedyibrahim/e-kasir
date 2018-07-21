<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
<meta charset="utf-8" >
<title>E-kasir</title>
<link rel="icon" href="<?php echo base_url('assets/gambar/');?>ico.png" type="image/ico" />
<link href="<?php echo base_url();?>assets/daterange/daterangepicker.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/custom_toko.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>assets/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<link href="<?php echo base_url() ?>assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>

</head>

<body style="background-image: url('<?php echo base_url()?>assets/gambar/bg.gif');">
<div class="loading" id="loading" ><div></div><div></div><div></div><div></div></div>
<nav id="myScrollspy" class="navbar-default navbar-fixed-top  background_header_toko"role="navigation" style="height:60px; ">
<div class="container">         
<div class="hidden-xs">    
<a class="navbar-brand_toko" href="<?php echo base_url(); ?>">E-Toko <span class="fa_toko fa-shopping-basket"></span></a>
</div>
<div class="search_header col-md-7 ">
<input type="text" class="form-search" placeholder="Cari produk ...">    
</div>
<div class="pull-right">

<a href="#"><div class="popover-show-cart navbar-brand_menu hidden-xs hidden-sm " title="Keranjang belanja"
data-container="body" data-toggle="popover" data-placement="bottom"
data-content="Some content in Popover on bottom"><span class="fa_toko fa-shopping-basket"></span></div></a>

<a href="#"><div class="popover-show-user navbar-brand_menu hidden-xs hidden-sm" title="Akun"
data-container="body" data-toggle="popover" data-placement="bottom"
data-content="
<label>Email :</label>
<input type='text' class='form-control' placeholder='Email ...'>

<label>Password :</label>
<input type='password' class='form-control' placeholder='Password ...'>
<hr>
<p align='center'><button class='btn btn-success'>Masuk <span class='fa fa-key'></span></button></p>
<hr>
<h4 align='center'><a href='<?php echo base_url('Toko/daftar_customer') ?>'>Belum punnya akun ?</a> </h4>


"><span class="fa_toko fa-user"></span></div></a>

<a href="#"><div class="popover-show-list navbar-brand_menu hidden-xs hidden-sm" title="Menu"
data-container="body" data-toggle="popover" data-placement="bottom"
data-content="Some content in Popover on bottom"><span class="fa_toko fa-list-alt"></span></div></a>



</div>
</div>
    <div id="fixed" class="normal" style="display:block;">	

<div class="container-fluid"  style="background-color:#45cea2; height:35px;">
<div class="container">
<ul class="menu_toko">
<?php foreach ( $this->db->get('menu_toko')->result_array() as $menu ){ ?>    
<li><a href="<?php echo base_url('Toko/kategori_toko/'.urlencode($menu['nama_menu'])) ?>"><?php echo $menu['nama_menu'] ?></a></li>
<?php }?>
</ul>

</div>

</div>
</div>    
</nav>
<script type="text/javascript">
$(function(){
var menu = $('#fixed'),
pos = menu.offset();

$(window).scroll(function(){
if($(this).scrollTop() > pos.top+menu.height() && menu.hasClass('normal')){
menu.fadeOut('fast', function(){
$(this).removeClass('normal').addClass('fixed').fadeIn('fast');
});
} else if($(this).scrollTop() <= pos.top && menu.hasClass('fixed')){
menu.fadeOut('fast', function(){
$(this).removeClass('fixed').addClass('normal').fadeIn('fast');
});
}
});

}); </script>
<style>
.fixed {
margin: 0px auto;
z-index: 1;
display:none;
position:inherit;
opacity:10;
top: -100px;
left: 0;
width: 100%;

}
</style>