<div class="container" style="margin-top:8%; background-color:#fff; ">
<div class="col-md-2"></div>
<div class="col-md-8">

<h3 align="center">DAFTAR CUSTOMER</h3><hr>
<label>Nama customer</label>
<input type="text" id="nama_customer" value="" class="form-control" placeholder="nama customer">
<label>Email</label>
<input type="text" id="email" value="" class="form-control" placeholder="email">
<label>Password</label>
<input type="password"  id="password1" class="form-control" placeholder="password">
<label>Ulangi Password</label>
<input type="password" id="password2" class="form-control" placeholder="ulangi password">
<div class="clearfix"></div><hr>
<button class="btn btn-success pull-right col-md-4" id="daftar" >Daftar <span class="fa fa-save"></span></button>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){

$("#daftar").click(function(){
var  nama_customer = $("#nama_customer").val();
var  email = $("#email").val();
var  password1 =$("#password1").val();
var  password2 =$("#password2").val();

if(password1 != password2){
swal({
title:"", 
text:"Password tidak sama",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});
}else if(nama_customer !='' && email !='' && password1 !='' && password2 !=''){
$.ajax({
type:"POST",
url:"<?php echo base_url('Toko/simpan_customer') ?>",
data:"nama_customer="+nama_customer+"&email="+email+"&password="+password1,
success:function(data){
swal({
title:"", 
text:"Daftar berhasil silahkan cek email untuk melakukan konfirmasi akun",
timer:3000,
type:"success",
showCancelButton :false,
showConfirmButton :false
});
}
});    
}else{
swal({
title:"", 
text:"Masih ada data kosong",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});
}
});
});

</script>    