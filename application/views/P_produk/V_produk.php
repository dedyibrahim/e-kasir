<script src="<?php echo base_url();?>assets/jquery/jquery-1.11.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
function simpan_produk(){
var barcode       = $("#barcode").val();
var nama_produk   = $("#nama_produk").val();
var harga_produk  = $("#harga_produk").val();
var stok_toko     = $("#stok_toko").val();
var stok_pabrik   = $("#stok_pabrik").val();
var status_produk = $("#status_produk").val();

if(barcode !='' && nama_produk !='' && harga_produk !='' && stok_toko != '' && stok_pabrik != '' && status_produk !=''){

$.ajax({
type:"POST",
url :"<?php echo base_url("P_produk/simpan_produk"); ?>",
data:"barcode="+barcode+"&nama_produk="+nama_produk+"&harga_produk="+harga_produk+"&stok_toko="+stok_toko+"&stok_pabrik="+stok_pabrik+"&status_produk="+status_produk,
success:function(html){

swal({
title:"", 
text:"Produk berhasil disimpan",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});
$("#barcode").val("");
$("#nama_produk").val("");
$("#harga_produk").val("");
$("#stok_toko").val("");
$("#stok_pabrik").val("");
$("#status_produk").val("")
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
</script>
<script type="text/javascript">
$(document).ready(function() {
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
return {
"iStart": oSettings._iDisplayStart,
"iEnd": oSettings.fnDisplayEnd(),
"iLength": oSettings._iDisplayLength,
"iTotal": oSettings.fnRecordsTotal(),
"iFilteredTotal": oSettings.fnRecordsDisplay(),
"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
};
};

var t = $("#produk_table").dataTable({
initComplete: function() {
var api = this.api();
$('#produk_table')
.off('.DT')
.on('keyup.DT', function(e) {
if (e.keyCode == 13) {
api.search(this.value).draw();
}
});
},
oLanguage: {
sProcessing: "loading..."
},
processing: true,
serverSide: true,
ajax: {"url": "<?php echo base_url('P_produk/json_produk_toko') ?> ", "type": "POST"},
columns: [
{
"data": "id_produk",
"orderable": false
},
{"data": "nama_produk"},
{"data": "barcode"},
{"data": "harga_produk"},
{"data": "stok_toko"},
{"data": "stok_pabrik"},
{"data": "status_produk"},
{"data": "view"},


],
order: [[1, 'desc']],
rowCallback: function(row, data, iDisplayIndex) {
var info = this.fnPagingInfo();
var page = info.iPage;
var length = info.iLength;
var index = page * length + (iDisplayIndex + 1);
$('td:eq(0)', row).html(index);
}
});
});

$(document).ready(function(){

$("#download_tamplate").click(function(){
window.location="<?php echo base_url('P_produk/download_tamplate_excel'); ?>"

});


});





</script>    





<div class="container">
<div class="clearfix"></div>
<hr>
<div class="row top_tiles">
   <a href="<?php echo base_url('P_produk') ?>">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"></div>
                  <div class="count"><?php echo $this->db->get('data_produk')->num_rows(); ?></div>
                  <h3>Total produk</h3>
                  <p>Total seluruh produk</p>
                </div>
              </div></a>

           <a href="<?php echo base_url('P_produk/pabrik_mau_habis') ?>">
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"></div>
                  <div class="count"><?php echo $this->db->get_where('data_produk',array('stok_pabrik <' =>10))->num_rows(); ?></div>
                  <h3>Produk mau habis</h3>
                  <p>Produk di pabrik yang mau habis</p>
                </div>
              </div></a>

          <a href="<?php echo base_url('P_produk/toko_mau_habis') ?>">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="tile-stats">
                  <div class="icon"></div>
                  <div class="count"><?php echo $this->db->get_where('data_produk',array('stok_toko <' =>10,'stok_toko !=' =>0))->num_rows(); ?></div>
                  <h3>Produk mau habis</h3>
                  <p>Produk di toko yang mau habis</p>
                </div>
              </div></a>
            
             <a href="<?php echo base_url('P_produk/toko_sudah_habis') ?>">
     
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"></div>
                  <div class="count"><?php echo $this->db->get_where('data_produk',array('stok_toko =' =>0))->num_rows(); ?></div>
                  <h3>Produk sudah habis</h3>
                  <p>Produk di toko yang sudah habis</p>
                </div>
   
              </div></a>
   </div>

<div class="clearfix"></div>
<hr>
</div>
<div class="container layout_border">
<div class="D_panel_atas">
Input produk <span class="fa fa-pencil"></span>
</div>
<div class="clearfix"></div>
<hr>
<form action="<?php echo base_url('P_produk/upload_excel'); ?>" enctype="multipart/form-data" method="POST"> 

 <div class="col-md-3">
  <input type="file" name="produk" class="form-control">
</div>

<div class="col-md-3">
    <button type="submit" class="form-control btn btn-success" ><span class="fa fa-upload"></span> Upload produk Excel</button>
</div>
<div class="pull-right ">
    <button type="button" id="download_tamplate" class="  form-control btn btn-success" ><span class="fa fa-download"></span> Download Tamplate excel</button>

</div>
  
</form>
<div class="clearfix"></div>
<hr>
<div class="col-md-6">
<label>Barcode</label>
<input type="tex" class="form-control" id="barcode" value="" placeholder="Barcode . . .">
<label>Nama produk</label>
<input type="tex" class="form-control" id="nama_produk" value="" placeholder="Nama produk . . .">
<label>Harga produk</label>
<input type="tex" class="form-control" id="harga_produk" value="" placeholder="Harga produk . . .">
</div>
<div class="col-md-6">    
<label>Stok toko</label>
<input type="tex" class="form-control" id="stok_toko" value="" placeholder="Stok toko . . .">
<label>Stok pabrik</label>
<input type="tex" class="form-control" id="stok_pabrik" value="" placeholder="Stok pabrik . . .">
<label>Status</label>
<select class="form-control" id="status_produk">
<option>Aktif</option>
<option>Tidak</option>
</select>
</div>
<div class="col-md-12 footer">
<hr>


<button type="button" onclick="simpan_produk();" class="btn btn-success pull-right">SIMPAN PRODUK <span class="fa fa-save"></span></button>   
</div>

</div>


<div class="container layout_border " style="margin-bottom:80px;">
<div class="D_panel_atas">
Data produk <span class="fa fa-list-alt"></span>
</div>
<div class="clearfix"></div>
<hr>
<div class="clearfix"></div>
<hr>
<table id="produk_table" style="width: 100%; " class="table table-striped table-condensed table-bordered table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama</th>
<th  align="center"  aria-controls="datatable-fixed-header" >Barcode</th>
<th  align="center"   aria-controls="datatable-fixed-header"  >Harga</th>
<th  align="center"  aria-controls="datatable-fixed-header"   >Stok toko</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Stok pabrik</th>
<th  align="center"  aria-controls="datatable-fixed-header"  >Status</th>
<th  align="center"  aria-controls="datatable-fixed-header"   >Aksi</th>
</thead>
<tbody align="center">
</table>
<div class="clearfix"></div>
</div>        

