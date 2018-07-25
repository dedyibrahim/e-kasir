<div class="D_panel layout_border container " style="margin-bottom:5%;">
<div class="D_panel_atas">Set produk toko</div>
<div class="clearfix"></div>
<hr>

<table style="text-align:center;" class="table table-striped table-bordered table-condensed ">
<tr>
<th style="width: 1%;">No</th>	
<th>Nama produk</th>	
<th>Harga produk</th>	
<th style="width: 13%;">Kategori toko</th>	
</tr>	

<?php $i=1; foreach ($data->result_array() as $produk) {
echo "<tr>
<td>".$i++."</td>
<td>".$produk['nama_produk']."</td>
<td>Rp.".number_format($produk['harga_produk'])."</td>
<td><select id='kategori_terpilih".$produk['id_produk']."' onchange='update_kategori(".$produk['id_produk'].");' class='form-control'><option>".$produk['kategori']."</option><option></option>
";
foreach ($data_menu->result_array() as $kategori) {
echo "<option> ".$kategori['nama_menu']."</option>";
}
echo "</select></td></tr>"; 
} 
?>	
</table>


</div>

<script type="text/javascript">
	

	function update_kategori(id_produk){

    var kategori = $("#kategori_terpilih"+id_produk).val();

	$.ajax({
      type:"POST",
      url:"<?php echo base_url('P_toko/update_kategori_produk') ?>",
      data:"id_produk="+id_produk+"&kategori="+kategori,
      success:function(data){

 swal({
title:"", 
text:"kategori terpilih "+kategori,
timer:1000,
type:"success",
showCancelButton :false,
showConfirmButton :false
});
      }

	});

	}
</script>