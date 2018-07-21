<script type="text/javascript">
$(document).ready(function(){
$("#update_customer").click(function(){

var id_customer = <?php echo base64_decode($this->uri->segment(3)) ?>;
var nama_customer = $("#nama_customer").val();
var nomor_kontak = $("#nomor_kontak").val();
var kode_pos     = $("#kode_pos").val();
var alamat_lengkap = $("#alamat_lengkap").val();


$.ajax({

    type:"POST",
    url:"<?php echo base_url('P_kasir/update_customer'); ?>",
    data:"id_customer="+id_customer+"&nama_customer="+nama_customer+"&nomor_kontak="+nomor_kontak+"&kode_pos="+kode_pos+"&alamat_lengkap="+alamat_lengkap,
    success:function(){

     swal({
title:"", 
text:"Update Berhasil",
timer:1500,
type:"success",
showCancelButton :false,
showConfirmButton :false
}, function(){
      window.location.href = "<?php echo base_url('P_kasir/data_customer') ?>";
});

    }
});

});

});
</script>

<?php  $customer = $query->row_array(); ?>
<div class="container layout_border" style="margin-bottom:10%; ">
    <div class="D_panel_atas">Daftar customer <span class="fa fa-book"> </span>
    </div>
   
        <div class="clearfix"></div><hr>   

<div class="col-md-6">
 <label>Nama customer</label>
 <input type="text" class="form-control" id="nama_customer" value="<?php  echo $customer['nama_customer']; ?>">   
 <label>Nomor kontak</label>
 <input type="text" class="form-control" id="nomor_kontak" value="<?php  echo $customer['nomor_kontak']; ?>">   
 <label>Kode pos</label>
 <input type="text" class="form-control" id="kode_pos" value="<?php  echo $customer['kode_pos']; ?>">   
</div>
<div class="col-md-6">
 <label>Alamat lengkap </label>
 <textarea class="form-control" id="alamat_lengkap"><?php  echo $customer['alamat_lengkap']; ?></textarea>   
</div>
<div class="clearfix"></div>
<hr>
<button id="update_customer" class="btn btn-success pull-right">Update customer <span class="fa fa-save"></span></button>
<div class="clearfix"></div>
<hr>

</div>