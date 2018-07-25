<body onload="data_menu();"></body>
<div class="D_panel layout_border container" style="margin-bottom:7%;">
<div class="D_panel_atas">PENGATURAN HALAMAN TOKO</div>
<?php $this->load->view('P_toko/V_menu') ?>
<div class="clearfix"></div>
<hr>
<div class="col-md-4">
<label> Nama Menu toko : </label>    
<input type="text" id="nama_menu_toko" placeholder="Nama menu" class="form-control">    
<div class=" clearfix"></div><hr>
<button id="simpan_menu" class="btn btn-success pull-right">Simpan Menu <span class="fa fa-save"></span></button>
</div>
<div class="col-md-8" id="data_menu">
	
</div>

<div class="clearfix"></div>
<hr> 
</div>
<script type="text/javascript">
$(document).ready(function(){

$("#simpan_menu").click(function(){
var nama_menu = $("#nama_menu_toko").val();
if(nama_menu !=''){
$.ajax({
type:"POST",
url:"<?php echo base_url('P_toko/simpan_menu') ?>",
data:"nama_menu="+nama_menu,
success:function(data){

swal({
title:"", 
text:"Menu berhasil tersimpan",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});
data_menu();
$("#nama_menu_toko").val("");
}  

});
}else{
swal({
title:"", 
text:"Menu belum di isi",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});
}

});

});
function data_menu(){

	$.ajax({
		type:"GET",
		url:"<?php echo base_url('P_toko/data_menu') ?>",
		data:"",
		success:function(html){

			$("#data_menu").html(html);
		}
	});
}

function hapus_menu(id_menu,menu){


$.ajax({
  type:"POST",
  url:"<?php echo base_url('P_toko/hapus_menu') ?>",
  data:"id_menu="+id_menu,
  success:function(data){

 swal({
title:"", 
text:"Menu berhasil terhapus",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});
data_menu();
  } 

   

});

}

</script>    