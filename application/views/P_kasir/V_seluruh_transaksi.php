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
ajax: {"url": "<?php echo base_url('P_kasir/seluruh_transaksi')?>", "type": "POST"},
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
<div class="container layout_border" style="margin-bottom:10%; ">
    <div class="D_panel_atas">Seluruh Transaksi <span class="fa fa-book"> </span>
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