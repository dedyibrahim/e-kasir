<script src="<?php echo base_url();?>assets/jquery/jquery-1.11.0.min.js" type="text/javascript"></script>
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
ajax: {"url": "<?php echo base_url('P_produk/json_produk_pabrik_mau_habis') ?> ", "type": "POST"},
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


<div class="container layout_border " style="margin-bottom:80px;">
<div class="D_panel_atas">
Data produk di pabrik  yang mau habis <span class="fa fa-list-alt"></span>
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

