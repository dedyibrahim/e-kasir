<div id="window_print"></div>
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

var t = $("#seluruh_transaksi_table").dataTable({
initComplete: function() {
    var api = this.api();
    $('#seluruh_transaksi_table')
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
ajax: {"url": "<?php echo base_url('P_kasir/data_transaksi_edit')?>", "type": "POST"},
columns: [
    {
        "data": "no_invoices",
        "orderable": false
    },
    {"data": "nama_customer"},
    {"data": "invoice"},
    {"data": "nama_kasir"},
    {"data": "nomor_kontak"},
    {"data": "metode_pembayaran"},
    {"data": "tanggal_transaksi"},
    {"data": "view"},


   ],
order: [[0, 'desc']],
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
<script type="text/javascript">
$(document).ready(function(){
$("#kode_barcode").keyup(function (e) {
var kode_barcode = $("#kode_barcode").val();
if (e.keyCode == 13) {
$.ajax({
type:"POST",
url:"<?php echo base_url('P_kasir/cari_id_produk') ?>",
data:"kode_barcode="+kode_barcode,
success:function(data){
if(data != ''){

$.ajax({
type:"POST",
url:"<?php echo base_url("P_kasir/set_edit"); ?>",
data:"id_produk="+data,
success:function(data){

$("#kode_barcode").val("");
load_kasir();
}
});  
}else{
swal({
title:"", 
text:"Maaf Kode barcode tidak ditemukan",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});
$("#kode_barcode").val("");
}


}

});
}
});

});    


$(function () {
$("#kunci_produk").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('P_kasir/cari_produk'); ?>',
select:function(event, ui){
$('#id_produk').val(ui.item.id_produk);

$.ajax({
type:"POST",
url:"<?php echo base_url("P_kasir/set_edit"); ?>",
data:"id_produk="+ui.item.id_produk,
success:function(data){

$("#kunci_produk").val("");
load_kasir();
}
});

}
}
);
});

$(function () {
$("#nama_customer_ui").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('P_kasir/cari_customer'); ?>',
select:function(event, ui){
$('#nama_customer_ui').val(ui.item.nama_customer);
$('#kode_pos_ui').val(ui.item.kode_pos);
$('#nomor_kontak_ui').val(ui.item.nomor_kontak);
$('#alamat_lengkap_ui').val(ui.item.alamat_lengkap);

$.ajax({
type:"POST",
url:"<?php echo base_url('P_kasir/simpan_customer_stroke_edit'); ?>",
data:"nama_customer="+ui.item.nama_customer+"&kode_pos="+ui.item.kode_pos+"&nomor_kontak="+ui.item.nomor_kontak+"&alamat_lengkap="+ui.item.alamat_lengkap,
success:function(){
swal({
title:"", 
text:"Customer terpilih "+ui.item.nama_customer,
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});

}


});

}
}
);
});


function hapus_setedit(id){

var id_hapus = id;
$.ajax({
type:'POST',
url:'<?php echo base_url('P_kasir/hapus_set_edit') ?>',
data:'id_hapus='+id_hapus,
success:function(){

load_kasir();
}        

});

}

function update_qty_edit(id){
var id_qty = id ;
var qty_kasir = $("#qty_kasir"+id).val();
var stok_toko = $("#stok_toko"+id) .val();

if(parseInt(qty_kasir) > parseInt(stok_toko)){


swal({
title:"", 
text:"Stok toko tersedi hannya "+stok_toko,
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});

$.ajax({
type:"POST",
url :"<?php echo base_url('P_kasir/update_qty_edit'); ?>",
data:"qty_kasir="+stok_toko+"&id_qty="+id_qty,
success:function(){

load_kasir();
}


});

}else{
$.ajax({
type:"POST",
url :"<?php echo base_url('P_kasir/update_qty_edit'); ?>",
data:"qty_kasir="+qty_kasir+"&id_qty="+id_qty,
success:function(){

load_kasir();
}


});   

}

}
function load_kasir(){

$.ajax({
type:"GET",
url:"<?php echo base_url('P_kasir/canvas_edit')?>",
data:"",
success:function(html){
$("#canvas_edit").html(html);

load_daftar_transaksi_hari_ini();
}

});

}
function load_daftar_transaksi_hari_ini(){
$.ajax({
type:"GET",
url:"<?php echo base_url('P_kasir/daftar_transaksi_hari_ini')?>",
data:"",
success:function(html){
$("#daftar_transaksi_hari_ini").html(html);

}

});


}

function modal_diskon_edit(){

$.ajax({
type:"GET",
url:"<?php echo base_url('P_kasir/modal_diskon_edit')?>",
data:"",
success:function(html){
$("#modal_diskon_edit").html(html);
}

});

}

function set_diskon_edit(){
var total_kasir_diskon = $("#total_kasir_diskon").val();
var nilai_diskon       = $("#nilai_diskon").val();
var hitung_diskon      = total_kasir_diskon*nilai_diskon/100;

$("#hasil_diskon").val(total_kasir_diskon-hitung_diskon); 

}

function simpan_diskon_edit(){
var total_kasir_diskon = $("#total_kasir_diskon").val();
var nilai_diskon       = $("#nilai_diskon").val();
if(nilai_diskon != '' && total_kasir_diskon != '0' ){

$.ajax({
type:'POST',
url:"<?php echo base_url('P_kasir/set_diskon_edit');?>",
data:"nilai_diskon="+nilai_diskon,
success:function(html){
load_kasir();
swal({
title:"", 
text:"Set Diskon berhasil",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});
$("#nilai_diskon").val("");
}

});



}else{
swal({
title:"", 
text:"Nilai diskon belum di isi",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});

}

} 
function modal_ppn_edit(){

$.ajax({
type:"GET",
url:"<?php echo base_url('P_kasir/modal_ppn_edit')?>",
data:"",
success:function(html){
$("#modal_ppn_edit").html(html);
}

});

}

function modal_stroke_edit(){

$.ajax({
type:"GET",
url:"<?php echo base_url('P_kasir/modal_stroke_edit')?>",
data:"",
success:function(html){
$("#modal_stroke_edit").html(html);
}

});

}

function simpan_ppn_edit(){
var hasil_nilai_ppn = $("#hasil_nilai_ppn").val();
var harga_setelah_ppn = $("#harga_setelah_ppn").val();

if(hasil_nilai_ppn != 0){
$.ajax({
type:"POST",
url:"<?php echo base_url('P_kasir/simpan_ppn_edit'); ?>",
data:"hasil_nilai_ppn="+hasil_nilai_ppn+"&harga_setelah_ppn="+harga_setelah_ppn,
success:function(){
load_kasir();
swal({
title:"", 
text:"PPN berhasil disimpan",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});  
}
});

} else {


swal({
title:"", 
text:"Anda Belum memasukan produk",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});  

}
}


function simpan_customer(){
var nama_customer  = $("#nama_customer").val();
var nomor_kontak   = $("#nomor_kontak").val();
var kode_pos       = $("#kode_pos").val();
var alamat_lengkap = $("#alamat_lengkap").val();
if(nama_customer != '' && nomor_kontak != '' && kode_pos != '' && alamat_lengkap != ''){
$.ajax({
type:"POST",
url :"<?php echo base_url('P_kasir/simpan_customer') ?>",
data:"nama_customer="+nama_customer+"&nomor_kontak="+nomor_kontak+"&kode_pos="+kode_pos+"&alamat_lengkap="+alamat_lengkap,
success:function(){
swal({
title:"", 
text:"Customer berhasil disimpan",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
});  

$("#nama_customer").val("");
$("#nomor_kontak").val("");
$("#kode_pos").val("");
$("#alamat_lengkap").val("");
}


});
}else{

swal({
title:"", 
text:"Masih terdapat data yang belum di isi",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
}); 

}

}

function simpan_biaya_lain_edit(){
var nama_biaya_lain   =$("#nama_biaya_lain").val();
var jumlah_biaya_lain =$("#jumlah_biaya_lain").val(); 

if(nama_biaya_lain != '' && jumlah_biaya_lain != ''){
$.ajax({
type:"POST",
url:"<?php echo base_url('P_kasir/simpan_biaya_lain_edit') ?>",
data:"nama_biaya_lain="+nama_biaya_lain+"&jumlah_biaya_lain="+jumlah_biaya_lain,
success:function(){
load_kasir();
swal({
title:"", 
text:"Biaya lain-lain Tersimpan",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
}); 
$("#nama_biaya_lain").val("");
$("#jumlah_biaya_lain").val(""); 
}   
});

}else{

swal({
title:"", 
text:"Masih terdapat data yang belum di isi",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});    
}

}
function jumlah_uang(){
var jumlah_uang = $("#jumlah_uang").val();
var harus_bayar = $("#harus_bayar").val();

$("#kembalian").val(jumlah_uang-harus_bayar);

}

function print_div_edit(window_print){
var jumlah_uang = $("#jumlah_uang").val();
var kembalian   = $("#kembalian").val();
var harus_bayar = $("#harus_bayar").val();
var metode_pembayaran = $("#metode_pembayaran").val();
var catatan      = $("#catatan").val();
if(parseInt(jumlah_uang) < parseInt(harus_bayar) ){
swal({
title:"", 
text:"Maaf anda kurang bayar",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});     


}else if(jumlah_uang != '' && harus_bayar != '0'){
$.ajax({
type:"GET",
url:"<?php echo base_url('P_kasir/simpan_data_kasir_edit')?>",
data:"jumlah_uang="+jumlah_uang+"&kembalian="+kembalian+"&metode_pembayaran="+metode_pembayaran+"&catatan="+catatan,
success:function(html){
load_kasir();
load_daftar_transaksi_hari_ini();
$("#window_print").html(html);
var konten = document.getElementById(window_print).innerHTML;
document.body.innerHTML = konten;
window.print();
}

});
}else{

swal({
title:"", 
text:"Anda belum memasukan jumlah pembayaran",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});
}    


}
function  print_stroke(no_invoices){
$.ajax({
type:"GET",
url:"<?php echo base_url('P_kasir/print_kasir/')?>"+no_invoices,
data:"",
success:function(html){
$("#window_print").html(html);
var window_print = 'window_print';
var konten = document.getElementById(window_print).innerHTML;
document.body.innerHTML = konten;
window.print();
}


});

}
$(document).ready(function(){

$('#metode_cari').change(function() {

if ($(this).val() === '1') {
$("#form_nama_produk").show();
$("#form_barcode").hide();

}else if($(this).val() === '2'){
$("#form_nama_produk").hide();
$("#form_barcode").show();

}

});

});
</script>
<body onload="load_kasir();"></body>
<?php if($this->session->userdata('no_invoices') !='') { ?>
<div class="container D_panel layout_border" >
<div class="D_panel_atas">
Halaman Kasir edit <span class="fa fa-print"></span>
</div>
<div class="clearfix"></div><hr>     
<div class="col-md-5 Lyt_kasir">
<div class="container  col-md-12 Lyt_form_kasir">
<div class="form-group col-md-9" id="form_nama_produk">
<input type="text"   id="kunci_produk" style="height:40px; " class="form-control" placeholder="Nama produk ...">
</div>
<div class="form-group   col-md-9" id="form_barcode" style="display: none;">
<input type="text"  id="kode_barcode" style="height:40px; " class="form-control" placeholder="Kode Barcode ...">
</div>

<div class="form-group col-md-3">
<select id="metode_cari" style="margin-top:5px; " class="form-control"><option value="1" >Nama produk</option><option value="2">Barcode</option></select>    
</div>    
</div>
<div class="clearfix"></div>       
<div id="canvas_edit" style="margin: 1%;">
</div>
<hr>

<div class="col-md-6">    
<label>Nama customer :</label>
<input type="text" id="nama_customer_ui"  value="<?php echo $this->session->userdata('nama_customer_edit'); ?>" class="form-control">
<label>Telp/Hp :</label>
<input type="text" id="nomor_kontak_ui" readonly="" value="<?php echo $this->session->userdata('nomor_kontak_edit'); ?>" class="form-control">
</div>
<div class="col-md-6">    
<label>Kode Pos :</label>
<input type="text" id="kode_pos_ui"  value="<?php echo $this->session->userdata('kode_pos_edit'); ?>"    readonly="" class="form-control">
<label>Alamat lengkap :</label>
<textarea  id="alamat_lengkap_ui"  rows="1px;"    readonly="" class="form-control"><?php echo $this->session->userdata('alamat_lengkap_edit'); ?></textarea>
</div>
<div class="clearfix"></div>
<hr>
<button class="btn btn-success pull-left" data-toggle="modal" data-target="#tambah_biaya_lain_lain" >Biaya lain-lain <span class="fa fa-plus"></span> </button>

<button class="btn btn-success pull-right " data-toggle="modal" data-target="#tambah_customer">Tambah customer <span class="fa fa-plus"></span> </button>

<div class="clearfix"></div>
<hr>

<button class="btn btn-warning" onclick="modal_diskon_edit();"data-toggle="modal" data-target="#diskon" >Diskon <span class="fa fa-percent"></span> </button>
<button class="btn btn-warning " onclick="modal_ppn_edit();" data-toggle="modal" data-target="#ppn">PPN <span class="fa fa-building"></span> </button>
<button class="btn btn-success pull-right" onclick="modal_stroke_edit();" data-toggle="modal" data-target="#myModal">Print Update <span class="fa fa-print"></span> </button>
</div>
<div class="col-md-7 pull-right" style="margin-top:1%; " >
<form action="<?php echo base_url('P_kasir/buat_laporan'); ?>" method="POST" ecntype="multipart/form-data">
    
<div class="form-group col-md-9">
<input type="text" date-format="dd-mm-yyyy" class="form-control" name="daterange" id="laporan" value="" />
</div>
<div class="form-group col-md-2">
    <button type="submit" class="btn btn-success">Buat Laporan <span class=" fa fa-info"</button>    
</form>

</div>
<div class="clearfix"></div>
<hr>    
<script src="<?php echo base_url();?>assets/daterange/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/daterange/daterangepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">

$(function() {
  $('input[name="daterange"]').daterangepicker({
  locale :{
    format:'DD/MM/YYYY'
  },
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
  });
});
</script>
<h4 align="center">Daftar transaksi hari ini</h4>
<div id="daftar_transaksi_hari_ini">


</div>
</div>
</div>
<?php } ?>

<div class="container layout_border" style="margin-bottom:10%; ">
    <div class="D_panel_atas">
        Daftar transaksi edit <span class="fa fa-edit"></span>
    </div>
    <div class="clearfix"></div><hr>   
<table id="seluruh_transaksi_table" style="width: 100%; " class="table table-striped table-condensed table-bordered table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama customer</th>
<th  align="center"  aria-controls="datatable-fixed-header" >Invoice</th>
<th  align="center"   aria-controls="datatable-fixed-header"  >Kasir</th>
<th  align="center"  aria-controls="datatable-fixed-header"   >Nomor kontak</th>
<th  align="center"  aria-controls="datatable-fixed-header"   >Metode pembayaran</th>
<th  align="center"  aria-controls="datatable-fixed-header"   >Tanggal</th>
<th  align="center"  aria-controls="datatable-fixed-header"   >Aksi</th>
</thead>
<tbody align="center">
</table>
</div>

<!----- modal print stroke-------------------->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;
</button>
<h4 class="modal-title" id="myModalLabel">Konfirmasi penjualan</h4>
</div>
<div class="modal-body" id="modal_stroke_edit">

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
<button type="button" onclick="print_div_edit('window_print');" class="btn btn-primary">Print <span class="fa fa-print"></span></button>
</div>

</div>
</div></div>
<!----- modal diskon-------------------->
<div class="modal fade col-lg-12" id="diskon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;
</button>
<h4 class="modal-title" id="myModalLabel">Tambah Diskon</h4>
</div>
<div class="modal-body" id="modal_diskon_edit">

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
<button type="button" onclick="simpan_diskon_edit();" class="btn btn-primary">Simpan diskon <i class="fa fa-save"></i></button>
</div>

</div>
</div></div>
<!----- modal ppn-------------------->
<div class="modal fade col-lg-12" id="ppn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;
</button>
<h4 class="modal-title" id="myModalLabel">Tambah PPN</h4>
</div>
<div class="modal-body" id="modal_ppn_edit">

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
<button type="button" class="btn btn-primary" onclick="simpan_ppn_edit();">Simpan PPN <i class="fa fa-save"></i></button>
</div>

</div>
</div></div>
<!----- modal tambah customer-------------------->
<div class="modal fade col-lg-12" id="tambah_customer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;
</button>
<h4 class="modal-title" id="myModalLabel">Tambah kustomer</h4>
</div>
<div class="modal-body">

<label>Nama customer :</label>
<input type="text" id="nama_customer"   class="form-control">
<label>Telp/Hp :</label>
<input type="text" id="nomor_kontak" class="form-control">
<label>Kode Pos :</label>
<input type="text" id="kode_pos" class="form-control">
<label>Alamat lengkap :</label>
<textarea id="alamat_lengkap" class="form-control"></textarea>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
<button type="button" onclick="simpan_customer();" class="btn btn-primary">Simpan alamat <i class=" fa fa-save"></i></button>
</div>

</div>
</div></div>

<!----- Biaya lain lain-------------------->

<div class="modal fade col-lg-12" id="tambah_biaya_lain_lain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;
</button>
<h4 class="modal-title" id="myModalLabel">Biaya lain-lain</h4>
</div>
<div class="modal-body">

<label>Nama Biaya :</label>
<input type="text" id="nama_biaya_lain" class="form-control">
<label>Jumlah Biaya :</label>
<input type="text" id="jumlah_biaya_lain" class="form-control">

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
<button type="button" onclick="simpan_biaya_lain_edit();" class="btn btn-primary">Simpan biaya lain <i class=" fa fa-save"></i></button>
</div>

</div>
</div>
</div>



