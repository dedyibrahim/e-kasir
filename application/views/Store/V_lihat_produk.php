
<div class="container" style="margin-top:8%; margin-bottom:3%; background-color:#fff;   ">
<?php $data = $produk->row_array();?>
<div class="col-md-4" style="border:1px solid #45cea2; ">
<div id="similar-product" style="padding:10px;" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">

<div class="item active">
<?php if(!file_exists("./uploads/produk/".$data['gambar0'])){ ?>

<a href=""><img src="<?php echo base_url('uploads/produk/no_image.jpg') ?>" alt=""></a>    
<?php }else if($data['gambar0'] == ''){  ?>    

<a href=""><img src="<?php echo base_url('uploads/produk/no_image.jpg') ?>" alt=""></a>    
<?php }else{ ?>
<a href=""><img src="<?php echo base_url('uploads/produk/'.$data['gambar0']) ?>" alt=""></a>

<?php } ?>
</div>

<div class="item">
<?php if(!file_exists("./uploads/produk/".$data['gambar1'])){ ?>

<a href=""><img src="<?php echo base_url('uploads/produk/no_image.jpg') ?>" alt=""></a>    
<?php }else if($data['gambar1'] == ''){  ?>    

<a href=""><img src="<?php echo base_url('uploads/produk/no_image.jpg') ?>" alt=""></a>    
<?php }else{ ?>
<a href=""><img src="<?php echo base_url('uploads/produk/'.$data['gambar1']) ?>" alt=""></a>

<?php } ?>
</div>    

<div class="item">
<?php if(!file_exists("./uploads/produk/".$data['gambar2'])){ ?>

<a href=""><img src="<?php echo base_url('uploads/produk/no_image.jpg') ?>" alt=""></a>    
<?php }else if($data['gambar2'] == ''){  ?>    

<a href=""><img src="<?php echo base_url('uploads/produk/no_image.jpg') ?>" alt=""></a>    
<?php }else{ ?>
<a href=""><img src="<?php echo base_url('uploads/produk/'.$data['gambar2']) ?>" alt=""></a>

<?php } ?>
</div>
    
<div class="item">
<?php if(!file_exists("./uploads/produk/".$data['gambar3'])){ ?>

<a href=""><img src="<?php echo base_url('uploads/produk/no_image.jpg') ?>" alt=""></a>    
<?php }else if($data['gambar3'] == ''){  ?>    

<a href=""><img src="<?php echo base_url('uploads/produk/no_image.jpg') ?>" alt=""></a>    
<?php }else{ ?>
<a href=""><img src="<?php echo base_url('uploads/produk/'.$data['gambar3']) ?>" alt=""></a>

<?php } ?>
</div>    
    

</div>
</div>
</div>


<div class="col-md-7 pull-right" style=" background-color:#fff; ">
<h4><?php echo$data ['nama_produk'] ?></h4>
<hr>
<h4>Ketersedian :<?php echo$data['stok_toko'] ?></h4>
<hr>
<h4>Berat :<?php echo$data ['berat'] ?> Gram</h4>
<hr>
<h4>Harga :Rp.<?php echo number_format($data['harga_produk']) ?></h4>
<hr>
<div class="col-md-6">
<input id="qty" type="text" value="1" placeholder="Jumlah.." class="form-control">
<input id="id_produk" type="hidden"  placeholder="id_produk" class="form-control" value="<?php echo base64_encode($data['id_produk']); ?>" >
</div>
<button id="tambah_keranjang"  class="btn btn-keranjang col-md-4" style=".fa{color:#fff;}">Beli Produk <span class="fa fa-shopping-cart"></span></button>
</div>    
<div class="clearfix"></div>
<hr>

<div class="category-tab shop-details-tab col-sm-12"><!--category-tab-->
<div class="col-sm-12">
<ul class="nav nav-tabs">
<li class=""><a href="#details" data-toggle="tab">Detail Produk</a></li>
<li class="active"><a href="#ongkos" data-toggle="tab">Estimasi Ongkos kirim</a></li>
<li class=""><a href="#pertanyaan" data-toggle="tab">Pertanyaan</a></li>
<li class=""><a href="#reviews" data-toggle="tab">Ulasan</a></li>
</ul>
</div>

<div class="tab-content">

<div class="tab-pane  fade" id="details">
<?php echo $data['deskripsi'] ?>	
</div>

<div class="tab-pane fade active in" id="ongkos">
<div class="col-md-6">
<h4 align="center"><b>CEK ONGKOS KIRIM</b></h4>                                
<label>Pilih provinsi</label>                                   
</select>
<label>Pilih Kota</label>                                   
<select id="kota_tujuan" class="form-control"> 
</select>
<label>Qty Produk :</label>
<input type="text" id="qty_est" value="1" class="form-control">    
<label>Pilih Kurir :</label>
<select id="kurir" onclick="load_data_cost()" class="form-control">
<option name="jne" value="jne">JNE</option>
<option name="jne" value="tiki">TIKI</option>
<option name="jne" value="pos">POS</option>
</select>
</div>
<div class="col-md-6">    
<h3><div id="data_cost"></div></h3>                                
</div>
</div>
<div class="tab-pane fade" id="pertanyaan">
<h1>PERTANYAAN</h1>	
</div>
<div class="tab-pane fade" id="reviews">
<h1>ULASAN</h1>	
</div>
</div>
</div>
<div class="clearfix"></div>
<hr>
</div>
<script type="text/javascript">
$(document).ready(function(){
    
    $("#tambah_keranjang").click(function(){
    var qty = $("#qty").val();
    var id_produk = $("#id_produk").val();
     $.ajax({
         
         type:"POST",
         url:"<?php echo base_url('Toko/tambahkan_keranjang') ?>",
         data:"qty="+qty+"&id_produk="+id_produk,
        success:function(data){
            
    if(data == 'habis'){
   
   swal({
title:"", 
text:"Maaf stok sudah habis",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});
    }else if(data == 'stok_kurang'){
        
        swal({
title:"", 
text:"Maaf stok tidak mencukupi",
timer:1500,
type:"warning",
showCancelButton :false,
showConfirmButton :false
});
        
    }else{
        
        swal({
title:"", 
text:"Berhasil",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});
    }       
    
    } 
         
     }); 
     
    });
    
});


</script>    