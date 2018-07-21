<?php
           $this->db->group_by('tanggal_transaksi');
$tanggal = $this->db->get('data_penjualan_kasir');
?>


<div class="container layout_border" style="margin-bottom:10%; ">
    <div class="D_panel_atas">Grafik penjualan <span class="fa fa-table"> </span>
    </div>
   
        <div class="clearfix"></div><hr>   

<div style="width:100%;">
     <canvas id="myChart" width="300" height="100"></canvas>
</div>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var options = {
animation: true,

};
var myChart = new Chart(ctx,{
type: 'bar',
data: {
labels: [<?php foreach ($tanggal->result_array()  as $hari) {

 echo json_encode($hari['tanggal_transaksi']),',';


} ?>],
datasets: [{
label: 'penjualan',
backgroundColor:"#36CAAB",
borderColor:"rgba(38, 185, 154, 0.7)",
pointBorderColor:"rgba(38, 185, 154, 0.7)",
pointBackgroundColor:"rgba(38, 185, 154, 0.7)",
pointHoverBackgroundColor:"#fff",
pointHoverBorderColor:"rgba(220,220,220,1)",
pointBorderWidth:1,
data: [<?php 
foreach ($tanggal->result_array()  as $pendapatan) {
$query = $this->db->get_where('data_penjualan_kasir',array('tanggal_transaksi'=>$pendapatan['tanggal_transaksi']));

$total_pendapatan = 0;
foreach($query->result_array() as  $hasil_pendapatan){
    $total_pendapatan += $hasil_pendapatan['total'];
}

echo $total_pendapatan,',';
}

?>],
}
]
},
 options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    callback: function(value, index, values) {
                        return 'Rp. ' + number_format(value);
                    }
                }
            }]
        },
        tooltips: {
            callbacks: {
                label: function(tooltipItem, chart){
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ':Rp. ' + number_format(tooltipItem.yLabel, 2);
                }
            }
        }
    }

}),options;
function number_format(number, decimals, dec_point, thousands_sep) {
// *     example: number_format(1234.56, 2, ',', ' ');
// *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
</script>


</div>