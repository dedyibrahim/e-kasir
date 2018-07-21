
<html lang="en">
<head>
<meta charset="utf-8">
<title>E-kasir</title>
<link rel="icon" href="<?php echo base_url('assets/gambar/');?>ico.png" type="image/ico" />
<link href="<?php echo base_url();?>assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/custom_dedi.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>assets/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<link href="<?php echo base_url() ?>assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
</head>
<body style="background-image: url('<?php echo base_url()?>assets/gambar/bg.gif');">
<div class="container">
<h1 class="welcome text-center"></h1>
<div class="card card-container">
<h1 class='login_title text-center'>E-kasir <span class="fa fa-shopping-basket" ></span></h1>
<hr>
<div class="form-signin">
<span id="reauth-email" class="reauth-email"></span>
<p class="input_title">Email</p>
<input type="text" id="inputemail" class="login_box" placeholder="Email.." required autofocus>
<p class="input_title">Password</p>
<input type="password" id="inputpassword" class="login_box" placeholder="Passwod.." required>
<button class=" btn btn_login btn-lg btn-success" id="login" type="submit">Login <span class="fa fa-key"></span></button>
</div>
</div>
</div>
</body>
<script type="text/javascript">
$(document).ready(function(){
$("#login").click(function(){
var email = $("#inputemail").val();
var password = $("#inputpassword").val();
if(email !='' && password !=''){
$.ajax({
type:"POST",
url:"<?php echo base_url('P_login/login') ?>",
data:"email="+email+"&password="+password,
success:function(data){
    
if(data != ''){
swal({
title:"", 
text:"Login berhasil",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
}, function(){
      window.location.href = "<?php echo base_url('Kasir'); ?>";
});
}else{
swal({
title:"", 
text:"Email atau Password yang anda masukan salah",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});
}

}

});
}
});

});

</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/datatables/datatables.min.js"></script>
<script src="<?php echo base_url();?>assets/react/build/JSXTransformer.js"></script>
<script src="<?php echo base_url();?>assets/react/build/react.js" ></script>
<script src="<?php echo base_url();?>assets/react/build/react-dom.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/jPut/js/jput.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/jPut/js/jput-2.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
</html>