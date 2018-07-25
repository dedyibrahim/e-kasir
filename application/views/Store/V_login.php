<div class="container" style="margin-top:8%; background-color:#fff; ">
<div class="col-md-2"></div>
<div class="col-md-8">

<h3 align="center">Login customer <span class="fa  fa-toko fa-pencil"></span></h3><hr>
<label>Email</label>
<input type="text" id="email" value="" class="form-control" placeholder="email">
<label>Password</label>
<input type="password" id="password" class="form-control" placeholder="password">
<div class="clearfix"></div><hr>
<button class="btn btn-success pull-right col-md-4" id="login" >Login <span class="fa fa-sign-in"></span></button>
<a href="<?php echo base_url('Toko/daftar_customer') ?>"><button class="btn btn-success pull-left col-md-4"  >Daftar <span class="fa fa-pencil"></span></button></a>

</div>
</div>
<script type="text/javascript">
$(document).ready(function(){

$("#login").click(function(){

var email_masuk = $("#email").val();
var password_masuk = $("#password").val();
$.ajax({
type:"POST",
url:"<?php echo base_url('Toko/login_customer') ?>",
data:"email="+email_masuk+"&password="+password_masuk,
success:function(data){

if(data != 'login_berhasil'){
swal({
title:"", 
text:"Login gagal",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});


}else{

swal({
title:"", 
text:"Login berhasil",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
}, function(){
window.location.href = "<?php echo base_url(); ?>";
});
}
}

});

});
});

</script>
