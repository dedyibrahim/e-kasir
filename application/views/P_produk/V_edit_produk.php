<body onload="gambar_produk();"></body>
<script src="<?php echo base_url();?>assets/jquery/jquery-1.11.0.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $( document ).ajaxStart(function() {
    $( "#loading" ).show();
 });
 $( document ).ajaxComplete(function() {
    $( "#loading" ).hide();
$("#file_input").val("");

    });
 


$(document).ready(function(){
$('#file_input').on('change', function(){
var fileInput = $('#file_input')[0];
var id_produk = $('#id_produk').val();
if( fileInput.files.length > 4 ){
swal({
title:"", 
text:"maksimal upload 4 foto",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});
$("#file_input").val("");

}else if( fileInput.files.length >0 ){
var formData = new FormData();
$.each(fileInput.files, function(k,file){   
formData.append('images[]',file);
});
formData.append('id_produk',id_produk);


$.ajax({
method: 'post',
url:"<?php echo base_url('P_produk/proses_upload') ?>",
data: formData,
dataType: 'text',
contentType: false,
processData: false,
success:function(data){
swal({
title:"", 
text:"Upload produk berhasil",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});

    
        gambar_produk();

}

});


}else{
swal({
title:"", 
text:"gambar belum di pilih",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});

$("#file_input").val("");

}
});

});






function update_produk(){
var id_produk     = "<?php echo $this->uri->segment(3); ?>";
var barcode       = $("#barcode").val();
var nama_produk   = $("#nama_produk").val();
var harga_produk  = $("#harga_produk").val();
var stok_toko     = $("#stok_toko").val();
var stok_pabrik   = $("#stok_pabrik").val();
var status_produk = $("#status_produk").val();
var berat = $("#status_produk").val();

if(barcode !='' && nama_produk !='' && harga_produk !='' && stok_toko != '' && stok_pabrik != '' && status_produk !=''){

$.ajax({
type:"POST",
url :"<?php echo base_url("P_produk/update_produk"); ?>",
data:"berat="+berat+"&id_produk="+id_produk+"&barcode="+barcode+"&nama_produk="+nama_produk+"&harga_produk="+harga_produk+"&stok_toko="+stok_toko+"&stok_pabrik="+stok_pabrik+"&status_produk="+status_produk,
success:function(html){
swal({
title:"", 
text:"Update produk berhasil",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
}, function(){
window.location.href = "<?php echo base_url('P_produk'); ?>";
});

}
});

}else{

swal({
title:"", 
text:"Masih terdapat data kosong",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});

}
}
function gambar_produk(){
var id_produk = "<?php echo $this->uri->segment(3) ?>";

$.ajax({
    type:"GET",
    url:"<?php echo base_url('P_produk/gambar_produk') ?>",
    data:"id_produk="+id_produk,
    success:function(html){
        
        $("#gambar_produk").html(html);
        
    }
    
});

}
</script>
<?php $data = $produk->row_array();?>
<div class="container layout_border">
<div class="D_panel_atas">Edit Produk</div>
<div class="clearfix"></div>
<hr>

<div class="col-md-6">
<label>Barcode</label>
<input type="tex" class="form-control" id="barcode" value="<?php echo $data['barcode']; ?>" placeholder="Barcode . . .">
<label>Nama produk</label>
<input type="tex" class="form-control" id="nama_produk" value="<?php echo $data['nama_produk']; ?>" placeholder="Nama produk . . .">
<label>Harga produk</label>
<input type="tex" class="form-control" id="harga_produk" value="<?php echo $data['harga_produk']; ?>" placeholder="Harga produk . . .">
<label>Stok toko</label>
<input type="tex" class="form-control" id="stok_toko" value="<?php echo $data['stok_toko']; ?>" placeholder="Stok toko . . .">
<label>Stok pabrik</label>
<input type="tex" class="form-control" id="stok_pabrik" value="<?php echo $data['stok_pabrik']; ?>" placeholder="Stok pabrik . . .">
<label>Berat produk</label>
<input type="tex" class="form-control" id="berat" value="<?php echo $data['berat']; ?>" placeholder="Berat . . .">
<label>Status</label>
<select class="form-control" id="status_produk">
<option>Aktif</option>
<option>Tidak</option>
</select>
</div>

<div class="col-md-6">    
<label>Tambahkan foto</label>
<form>
<input class="form-control" type="file" name="images[]" id="file_input" multiple />
<input class="form-control" type="hidden" name="id_produk" id="id_produk" value="<?php echo $data['id_produk']; ?>" />
</form>

<label>Gambar produk</label><br>
<div id="gambar_produk">
</div>    
</div>
<div class="col-md-12 footer">
<hr>   
<button type="button" onclick="update_produk();" class="btn btn-success pull-right">Update produk <span class="fa fa-save"></span></button>   
</div>

</div>