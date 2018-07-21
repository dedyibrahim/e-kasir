<div class="clearfix"></div>
<hr>
<a href=""><button class=" btn btn-success">Customer toko <span class=" fa fa-users"></span></button></a>
<a href="<?php  echo base_url('P_toko/menu_toko')?>"><button class=" btn btn-success">Menu Toko <span class=" fa fa-list-ol "></span></button></a>
<a href=""><button class=" btn btn-success">Banner Toko <span class=" fa fa-paperclip "></span></button></a>
<a href=""><button class=" btn btn-success">Pengaturan Toko <span class=" fa fa-gear"></span></button></a>
<a href="<?php  echo base_url('P_toko/set_produk_toko')?>"><button class=" btn btn-success">Set Produk toko <span class=" fa fa-list-alt"></span></button></a>
<div class="clearfix"></div>
<hr>

<div class="row top_tiles">
<a href="<?php echo base_url('P_produk') ?>">
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="tile-stats">
<div class="icon"></div>
<div class="count"><?php echo $this->db->get('data_produk')->num_rows(); ?></div>
<h3>Orderan Masuk</h3>
<p>Orderan yang perlu di proses</p>
</div>
</div></a>

<a href="<?php echo base_url('P_produk/pabrik_mau_habis') ?>">
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="tile-stats">
<div class="icon"></div>
<div class="count"><?php echo $this->db->get_where('data_produk',array('stok_pabrik <' =>10))->num_rows(); ?></div>
<h3>Orderan di proses</h3>
<p>Orderan yang sedang di proses</p>
</div>
</div></a>

<a href="<?php echo base_url('P_produk/toko_mau_habis') ?>">
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="tile-stats">
<div class="icon"></div>
<div class="count"><?php echo $this->db->get_where('data_produk',array('stok_toko <' =>10))->num_rows(); ?></div>
<h3>Orderan dikirim</h3>
<p>Orderan yang sedang di kirim</p>
</div>
</div></a>

<a href="<?php echo base_url('P_produk/toko_sudah_habis') ?>">

<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="tile-stats">
<div class="icon"></div>
<div class="count"><?php echo $this->db->get_where('data_produk',array('stok_toko =' =>0))->num_rows(); ?></div>
<h3>Orderan selesai</h3>
<p>Orderan yang telah di terima</p>
</div>

</div></a>

</div>
