<div class="container" style=" margin-top:8%; background-color:#fff;  ">
<div class="col-md-3">
<h3 align="center">Alamat pengiriman</h3>

<div class="clearfix"></div>
<hr>

<label>Nama penerima</label>
<input type="text" id="nama_customer" readonly="" value="<?php echo $this->session->userdata('nama_customer'); ?>" class="form-control" placeholder="Nama penerima">

<label>Nomor kontak</label>
<input type="text" id="nomor_kontak" class="form-control" placeholder="Nomor Kontak">

<label>Provinsi</label>
<select id="data_provinsi" class="form-control"><option> </option></select>

<label>Nama Kota</label>
<select id="data_kota" class="form-control"><option> </option></select>


<label>Kode pos</label>
<input type="text" id="kode_pos" class="form-control" placeholder="Kode pos">

<label>Nama Kec,Jl,Rt/Rw</label>
<textarea id="alamat_lengkap" class="form-control" placeholder="Nama Kec,Jl,Rt/Rw"></textarea>

<div class="clearfix"></div>
<hr>
<button id="simpan_alamat" class=" pull-right btn btn-success">Simpan <span class="fa fa-save"></span></button>

</div>

<div class="col-md-3">
<h3 align="center">Metode Pembayaran</h3>
<div class="clearfix"></div>
<hr>
<label>Metode pembayaran</label>
<select id="metode_pembayaran" onchange="metode_pembayaran();" class="form-control">
<option></option>    
<option value="1">Cash On Delivery</option>    
<option value="2">Bank Transfer</option>    
</select>

<div style="display: none;" id="metode_pengiriman">
<label>Metode pengiriman</label>
<select id="kurir" onchange="load_data_pengiriman();" class="form-control">
<option></option>
<option name="jne" value="jne">JNE</option>
<option name="tiki" value="tiki">TIKI</option>
<option name="pos" value="pos">POS</option>
</select>
</div>

</div>


</div>
<body onload="ambil_provinsi();"></body>

<script type="text/javascript">
function ambil_data_kota(){
$.ajax({
type:"POST",
url :"<?php echo base_url('Toko/ambil_kota_ongkir') ?>",
data:"",
success:function(data){
$("#data_kota").html(data);
}
});
}

function ambil_provinsi(){
$.ajax({
type:"POST",
url :"<?php echo base_url('Toko/ambil_provinsi_ongkir') ?>",
data:"",
success:function(data){
$("#data_provinsi").html(data);
ambil_data_kota();
}
});
}

function metode_pembayaran(){
var metode_pembayaran = $("#metode_pembayaran").val();

if(metode_pembayaran == '2'){
$("#metode_pengiriman").show(100);
}else{
$("#metode_pengiriman").hide();

}
}

$(document).ready(function(){
$("#simpan_alamat").click(function(){

var nomor_kontak = $("#nomor_kontak").val();
var data_provinsi = $("#data_provinsi").html();
var data_kota = $("#data_kota").html();
var kode_pos = $("#kode_pos").val();
var alamat_lengkap = $("#alamat_lengkap").val();
var id_provinsi = $("#data_provinsi").val();
var id_kota = $("#data_kota").val();


if(nomor_kontak !='' && data_provinsi !='' && kode_pos !='' && alamat_lengkap !=''){

$.ajax({
type:"POST",
url:"<?php echo base_url('Toko/simpan_alamat_customer') ?>",
data:"nomor_kontak="+nomor_kontak+
"&data_provinsi="+data_provinsi+
"&data_kota="+data_kota+
"&kode_pos="+kode_pos+
"&alamat_lengkap="+alamat_lengkap+
"&id_provinsi="+id_provinsi+
"&id_kota="+id_kota,
success:function(){

$("#simpan_alamat").remove();
$("#nomor_kontak").attr('readonly',true);
$("#data_provinsi").attr('readonly',true);
$("#data_kota").attr('readonly',true);
$("#kode_pos").attr('readonly',true);
$("#alamat_lengkap").attr('readonly',true);


}

});     

}else{

alert("masih ada data kosong");

}

});

});

</script>