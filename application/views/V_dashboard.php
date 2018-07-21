<div class="container">
<div class="col-md-12" style="padding:10px; margin:50px 0;   color: #169F85; ">    

<div class="col-md-12" style="margin-bottom:10%">
<h2 align="center">Selamat datang <?php echo $this->session->userdata('username') ?> di Aplikasi E-kasir <span class="fa fa-shopping-basket"></span></h2>
<h4 align="center">Aplikasi ini diciptakan untuk mempermudah para penjual yang memiliki marketplace di berbagai tempat dan aplikasi ini suda di lengkapi pula dengan E-commerce yang bisa digunakan untuk berjualan sebagaimana mestinya.</h4>
</div>   


<a href="<?php echo base_url('P_kasir'); ?>"><div class="col-md-3">
<p align="center"  class="col-md-12"><img class="img img-circle img-responsive" style="width:130px;  border:2px #169F85 solid; margin:2px;   height: 130px; " src="<?php echo base_url() ?>assets/gambar/kasir.png" alt=""/><br><strong>KASIR</strong></p>
</div></a>

<a href="<?php echo base_url('P_produk'); ?>"><div class="col-md-3">
<p align="center"  class="col-md-12"><img class="img img-circle img-responsive" style="width:130px;  border:2px #169F85 solid; margin:2px;   height: 130px; " src="<?php echo base_url() ?>assets/gambar/produk.png" alt=""/><br><strong>PENGATURAN PRODUK</strong></p>
</div></a>

<a href="<?php echo base_url('P_toko'); ?>"><div class="col-md-3">
<p align="center"  class="col-md-12"><img class="img img-circle img-responsive" style="width:130px;  border:2px #169F85 solid; margin:2px;   height: 130px; " src="<?php echo base_url() ?>assets/gambar/toko.png" alt=""/><br><strong>PENGATURAN TOKO</strong></p>
</div></a>

<a href="<?php echo base_url('P_aplikasi'); ?>"><div class="col-md-3">
<p align="center"  class="col-md-12"><img class="img img-circle img-responsive" style="width:130px;  border:2px #169F85 solid; margin:2px;   height: 130px; " src="<?php echo base_url() ?>assets/gambar/pengaturan.png" alt=""/><br><strong>PENGATURAN APLIKASI</strong></p>
</div></a>



</div>
</div>
