
<script type="text/javascript">
$(document).ready(function(){
$('.popover-show-cart').popover({html:true,trigger:"click"});
$('.popover-show-cart').on('click', function (e) {
$('.popover-show-user').not(this).popover('hide');
$('.popover-show-list').not(this).popover('hide');

});     

$('.popover-show-user').popover({html:true,trigger:"click"});
$('.popover-show-user').on('click', function (e) {
$('.popover-show-cart').not(this).popover('hide');
$('.popover-show-list').not(this).popover('hide');

});     


$('.popover-show-list').popover({html:true,trigger:"click" });
$('.popover-show-list').on('click', function (e) {
$('.popover-show-cart').not(this).popover('hide');
$('.popover-show-user').not(this).popover('hide');

});     



});    


</script>
</div> 
<nav class="navbar navbar-default navbar-bottom" role="navigation" style="background-color:#169F85; margin-top:8%;  ">
<div class="container">
<div class="navbar-header">
<a class="navbar-brand" href="<?php echo base_url(); ?>"><span class="fa fa-copyright"></span> E-Toko <span class="fa fa-shopping-basket"></span> 2018 </a>
</div>


<div class="navbar-brand pull-right hidden-xs hidden-sm">
Kecepatan server <strong>{elapsed_time}</strong> seconds
</div>        
</nav>  
</body>
<script src="<?php echo base_url();?>assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
</html>
