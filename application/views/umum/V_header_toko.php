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
<input id="cari" type="text" class="form-search" placeholder="Cari produk ...">    
</div>
<div class="pull-right">

<a href="#"><div  id="keranjang_header" class="popover-show-cart navbar-brand_menu hidden-xs hidden-sm " title="Keranjang belanja"
data-container="body" data-toggle="popover" data-placement="bottom"
data-content="
<div id='keranjang'></div>

<a href='<?php echo base_url('Toko/lihat_keranjang') ?>'><buttton class='btn btn-success'>Lihat keranjang <span class='fa fa-eye'></span></button></a>
<a href='<?php echo base_url('Toko/checkout') ?>'><buttton class='btn btn-success'>Bayar <span class='fa fa-money'></span></button></a><hr>
"

><span class="fa_toko fa-shopping-basket"></span></div></a>
<?php if($this->session->userdata('nama_customer') !=''){ ?>
<a href="#"><div class="popover-show-user navbar-brand_menu hidden-xs hidden-sm" title="<?php echo $this->session->userdata('nama_customer'); ?>"
data-container="body" data-toggle="popover" data-placement="bottom"
data-content="<h4 align='center'>Selamat datang</h4><hr><button class='btn col-md-12 btn-success' onclick='keluar()'>Keluar <span class='fa fa-sign-out'></span></button>"><span class="fa_toko fa-user"></span></div></a>
<?php }else { ?>
    
<a href="#"><div class="popover-show-user navbar-brand_menu hidden-xs hidden-sm" title="Akun"
data-container="body" data-toggle="popover" data-placement="bottom"
data-content="
<label>Email :</label>
<input type='text' id='email_masuk' value='' class='form-control' placeholder='Email ...'>

<label>Password :</label>
<input type='password' id='password_masuk' value='' class='form-control' placeholder='Password ...'>
<hr>
<p align='center'><button onclick='masuk();' class='btn btn-success'>Masuk <span class='fa fa-key'></span></button></p>
<hr>
<h4 align='center'><a href='<?php echo base_url('Toko/daftar_customer') ?>'>Belum punnya akun ?</a> </h4>
"><span class="fa_toko fa-user"></span></div></a>
    
<?php } ?>

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
$( document ).ajaxStart(function() {
$( "#loading" ).show();
});
$( document ).ajaxComplete(function() {
$( "#loading" ).hide();
});   

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

}); 

$("#keranjang_header").click(function(){

$.ajax({

type:"GET",
url:"<?php echo base_url('Toko/keranjang_header') ?>",
data:"",
success:function(data){

$("#keranjang").html(data); 
}

});

});


</script>
<script type="text/javascript">
$(document).ready(function(){

$("#cari").keyup(function(){
var kata_kunci = $("#cari").val();
$.ajax({
type:"POST",
url:"<?php echo base_url('Toko/search') ?>",
data:"kata_kunci="+kata_kunci,
success:function(data){
if (kata_kunci != ''){
$("#hasil_cari").show();
$("#hasil_cari").html(data);
$("#isi").hide();
}else{
$("#hasil_cari").hide();
$("#isi").show();

}    

}
});    


});


}); 



</script>    
<script type="text/javascript">
function masuk(){
var email_masuk    =$("#email_masuk").val();  
var password_masuk =$("#password_masuk").val();

$.ajax({

type:"POST",
url:"<?php echo base_url('Toko/login_customer') ?>",
data:"email="+email_masuk+"&password="+password_masuk,
success:function(data){

if(data != 'login_berhasil'){
swal({
title:"", 
text:"Login gagal",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});


}else{

swal({
title:"", 
text:"Login berhasil",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
}, function(){
      window.location.href = "<?php echo base_url(); ?>";
});
}
}

});

}
function keluar(){
$.ajax({
    type:"POST",
    url:"<?php echo base_url('Toko/keluar') ?>",
    data:"",
    success:function(){
   swal({
title:"", 
text:"Logout",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
}, function(){
      window.location.href = "<?php echo base_url(); ?>";
});
    
    }   
});
    
}

</script>    


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
<div class="container" id="hasil_cari" style="background-color:#fff; margin-top:8%; display: none;"></div>
<div id="isi">
