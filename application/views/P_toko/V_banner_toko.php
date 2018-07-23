<body onload="data_banner();"></body>
<div class="D_panel layout_border container" style="margin-bottom:7%;">
<div class="D_panel_atas">Pengaturan Banner Toko</div>
<?php $this->load->view('P_toko/V_menu') ?>
<div class="clearfix"></div>
<hr>
<div class="col-md-4">
<?php echo form_open_multipart('P_toko/simpan_banner') ?>
 <label>Tambah banner: </label>    
<input type="file" name="banner" class="form-control">    
<div class=" clearfix"></div><hr>
<button  class="btn btn-success pull-right" type="submit">Simpan Banner <span class="fa fa-save"></span></button>
</form>

</div>
<div class="col-md-8" id="data_banner">

</div>

<div class="clearfix"></div>
<hr> 
</div>
<script type="text/javascript">

function data_banner(){

$.ajax({
type:"GET",
url:"<?php echo base_url('P_toko/data_banner') ?>",
data:"",
success:function(html){

$("#data_banner").html(html);
}
});
}

function hapus_banner(id_banner){


$.ajax({
type:"POST",
url:"<?php echo base_url('P_toko/hapus_banner') ?>",
data:"id_banner="+id_banner,
success:function(data){

swal({
title:"", 
text:"Banner terhapus",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});
data_banner();
} 



});

}

</script>    