<body onload="data_akun();"></body>
<script type="text/javascript">

function data_akun(){
$.ajax({
type:"GET",
url:"<?php echo base_url('P_aplikasi/data_akun')?>",
data:"",
success:function(html){
$("#data_akun").html(html);
}
});

}

function simpan_user(){
var username  =$("#username").val();
var email     =$("#email").val();
var password  =$("#password").val();
var level     =$("#level").val();
var password1 =$("#password1").val();

if(username != '' && email !='' && password !='' && password1 !='' && level !=''){

if(password != password1){
swal({
title:"", 
text:"Maaf password tidak sama",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});
}else{
$.ajax({
type:"POST",
url:"<?php echo base_url('P_aplikasi/simpan_akun'); ?>",
data:"username="+username+"&email="+email+"&password="+password+"&level="+level,

success:function(){
data_akun();
$("#username").val("");
$("#email").val("");
$("#password").val("");
$("#level").val();
$("#password1").val("");
}

});    

} 
}else{
swal({
title:"", 
text:"Maaf tidak boleh ada data kosong",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});   

}   
}
function hapus_akun(id){
   $.ajax({
      type:"POST",
      url:"<?php echo base_url('P_aplikasi/hapus_akun'); ?>",
      data:"id_akun="+id,
      success:function(){
          
          data_akun();
      }
   });
}
</script>
<div class="container layout_border">
<div class="D_panel_atas" style="margin-bottom:1%; ">
Pengaturan Account <span class="fa fa-users"></span>
</div>
<div class="clearfix"></div>
<hr>    


<div class="col-md-4" style="background-color:#fff; ">
<label>Nama lengkap:</label>
<input placeholder="Nama lenkap.." type="text" class="form-control" id="username">
<label>Email    :</label>  
<input placeholder="email.." type="email" required="" class="form-control" id="email">
<label>level    :</label>  
<select class="form-control" id="level">
<option value="super admin">super admin</option>   
<option value="admin kasir">admin kasir</option>   
<option value="admin toko">admin toko</option>   
<option value="admin produk">admin produk</option>   

</select>
<label>Password    :</label>  
<input placeholder="password.." type="Password" class="form-control" id="password">
<label>Retype password    :</label>  
<input placeholder="ulangi password.." type="Password" class="form-control" id="password1">
<div class="clearfix"></div><hr>
<div class="footer">
<button class="btn btn-success pull-right" onclick="simpan_user();">Simpan <span class="fa fa-save"></span></button>
<div class="clearfix"></div></div>

</div>

<div id="data_akun" class="col-md-8" style="background-color:#fff;" >

</div>
</div>
