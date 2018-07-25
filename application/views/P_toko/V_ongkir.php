<body onload="tampil_api();"></body>
<div class="D_panel layout_border container">
<div class="D_panel_atas">Pengaturan toko</div>
<?php $this->load->view('P_toko/V_menu') ?>
<div class="clearfix"></div>
<hr>
<div class="col-md-6">
<label>
Masukan API Raja Ongkir:   
</label>
<input type="text" class="form-control" id="api_ongkir">
<hr>
<button class="btn btn-success pull-right" id="simpan_api">Simpan API <span class="fa fa-save"></span></button>
</div>
<div class="col-md-6">
<label>API Key anda</label>
<div id="tampil_api">

	

</div>	

</div>


<div class="clearfix"></div>
<hr>
</div>
<script type="text/javascript">
$(document).ready(function(){

$("#simpan_api").click(function(){
var api_ongkir = $("#api_ongkir").val();
$.ajax({
type:"POST",
url:"<?php echo base_url('P_toko/simpan_api_ongkir') ?>",
data:"api_ongkir="+api_ongkir,
success:function(data){

swal({
title:"", 
text:"Update API berhasil",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});

tampil_api()
}

});

});
});

function tampil_api(){
$.ajax({
type:"GET",
url:"<?php  echo base_url('P_toko/tampil_api') ?>",
data:"",
success :function(data){

$("#tampil_api").html(data)
}

});

}

</script>    
