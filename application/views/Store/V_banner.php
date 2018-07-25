<script src="<?php echo base_url(); ?>assets/jssor/jquery.cycle2.min.js" type="text/javascript"></script>
<style type="text/css">
 * { margin: 0; padding: 0; }
 img { max-width: 100%; }
 .cycle-slideshow {
  width: 100%;
  max-width: 100%;
  display: block;
  position:static;
  margin: 20px auto;
  overflow: hidden;
  width: 100%;
  height: auto;
 }
 .cycle-prev, .cycle-next {
  font-size: 200%;
  color: #fff;
  display: block;
  position: absolute;
  top: 50%;
  z-index: 9999;
  cursor: pointer;
  margin-top: -16px;
  
 }
 .cycle-prev { left: 42px; }
 .cycle-next { right: 62px; }
 .cycle-pager {
  position: absolute;
  width: 100%;
  height: 10px;
  bottom: 10px;
  z-index: 9999;
  text-align: center;
 }
 .cycle-pager span {
  text-indent: 100%;
  top: 100px;
  width: 10px;
  height: 10px;
  display: inline-block;
  border: 1px solid #fff;
  border-radius: 50%;
  margin: 0 10px;
  white-space: nowrap;
  cursor: pointer;
 }
 .cycle-pager-active { background-color: #fff; }
</style>

<div class="cycle-slideshow"  style="margin-top:7%;">
    <span class="cycle-prev"><span class="fa_toko fa-arrow-circle-left"></span></span> 
 <span class="cycle-next"><span class="fa_toko fa-arrow-circle-right"></span></span> 
 <span class="cycle-pager"></span>  
<?php foreach ($banner->result_array() as $gambar){ ?>
 <img style="width:100%; height:400px; " src="<?php echo base_url('uploads/banner/'.$gambar['nama_banner']) ?>" alt="Gambar Pertama">
<?php } ?>

</div>
