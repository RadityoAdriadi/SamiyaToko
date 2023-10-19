<h3>Laporan Tahunan</h3>
<form method="post">
	<div class="form-group">
		<label>Pilih tahun</label>
		<select class="form-control" name="tahun">
			<option value="">Pilih Tahun</option>
			<option value="2018">2018</option>
			<option value="2019">2019</option>
		</select>
	</div>
	<button class="btn btn-primary" name="tampilkan">Tampilkan</button>
</form>


<?php 
	if(isset($_POST["tampilkan"]))
	{
		$laporan_tahunan = $pembelian->laporan_pembelian_tahuna($_POST['tahun']);

		echo "<pre>";
		print_r($laporan_tahunan);
		echo "</pre>";
	}

 ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="letakgrafik"></div>
    <p class="highcharts-description"></p>
</figure>

<script type="text/javascript">
	Highcharts.chart('letakgrafik', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Browser market shares in January, 2018'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [<?php foreach (laporan_pembelian_tahuna($_POST['tahun']) as $key => $tiaptaun): ?>
            '<?php echo $tiaphari ?>',
        <?php endforeach ?>]
    }]
});
</script>
