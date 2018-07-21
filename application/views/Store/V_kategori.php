

<div class="container" style="background-color:#fff;   " >
<?php foreach ($produk->result_array() as  $produk) { ?>
   
    <a href="<?php echo base_url('Toko/lihat_produk/'.base64_encode($produk['id_produk']));?>">
    <div style="height:45%; " class="col-md-3">
<div style="margin:10px;  text-align:center;">

<?php if(!file_exists("./uploads/produk/".$produk['gambar0'])){ ?>    
<img class="img-circle" style="width:170px; margin:5px; border:3px solid #169F85; height:170px; " src="<?php echo base_url('uploads/produk/no_image.jpg'); ?>">
    
<?php }else if($produk['gambar0'] == ''){  ?>
<img class="img-circle" style="width:170px; margin:5px; border:3px solid #169F85; height:170px; " src="<?php echo base_url('uploads/produk/no_image.jpg'); ?>">

<?php }else{ ?>    
<img class="img-circle" style="width:170px; margin:5px; border:3px solid #169F85; height:170px; " src="<?php echo base_url('uploads/produk/'.$produk['gambar0']); ?>">
<?php }?>

<br>
<h4>Rp. <?php echo number_format($produk['harga_produk']); ?></h4>
<h4><?php echo $produk['nama_produk']; ?></h4>
</div>
</div>
</a>
       
<?php } ?>
   

</div>