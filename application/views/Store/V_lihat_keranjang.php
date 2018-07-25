<body onload="tampilkan_keranjang()"></body>
<script type="text/javascript">
function tampilkan_keranjang(){
$.ajax({
type:"GET",
url:"<?php echo base_url('Toko/keranjang') ?>",
data:"",
success:function(data){

$("#keranjang_asli").html(data);

}

});


}


function update_qty(id_produk){
var qty_keranjang = $("#qty_keranjang"+id_produk).val();


$.ajax({
type:"POST",
url:"<?php echo base_url('Toko/update_qty_keranjang') ?>",
data:"id_produk="+id_produk+"&qty_keranjang="+qty_keranjang,
success:function(data){

if(data == 'stok_kurang'){

swal({
title:"", 
text:"Stok tidak mencukupi",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});
}else{

swal({
title:"", 
text:"Update berhasil",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});

tampilkan_keranjang();
}   
}
});
}

function hapus_cart(id_produk){
$.ajax({
type:"POST",
url:"<?php echo base_url('Toko/hapus_keranjang') ?>",
data:"id_produk="+id_produk,
success:function(data){
swal({
title:"", 
text:"Update berhasil",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});
tampilkan_keranjang();
}
});
}

</script>
<div class="container" style="margin-top:8%; background-color:#fff; ">
<H3 align='center'>Keranjang belanja anda</H3>
<div class="col-md-1"></div>   <div class="col-md-10" style="border:1px solid #169F85; padding:2%; " id="keranjang_asli">

</div>

</div>