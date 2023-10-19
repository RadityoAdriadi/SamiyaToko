<h3>Laporan Pembelian</h3>
<form method="post">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label>Tanggal Mulai</label>
				<input type="date" name="tglmulai" class="form-control">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Tanggal Selesai</label>
				<input type="date" name="tglselesai" class="form-control">
			</div>
		</div>
		<div class="col-md-4">
			<label>&nbsp;</label><br>
			<button class="btn btn-primary" name="lihat">Lihat</button>
		</div>
	</div>
</form>

<?php 
	if (isset($_POST['lihat'])) 
	{
		$laporan_pembelian = $pembelian->laporan_pembelian($_POST['tglmulai'],$_POST['tglselesai']);

		echo "<pre>";
		print_r($laporan_pembelian);
		echo "</pre>";
	}

 ?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="letakgrafik"></div>
    <p class="highcharts-description"></p>
</figure>
<script type="text/javascript">
	Highcharts.chart('letakgrafik', {

    title: {
        text: 'Solar Employment Growth by Sector, 2010-2016'
    },

    subtitle: {
        text: 'Source: thesolarfoundation.com'
    },

    yAxis: {
        title: {
            text: 'Number of Employees'
        }
    },

    xAxis: {
        accessibility: {
            rangeDescription: 'Range: 2010 to 2017'
        },
        categories: [
        	<?php foreach (diantara_tanggal($_POST['tglmulai'],$_POST['tglselesai']) as $key => $tiaphari): ?>
        		
        	'<?php echo $tiaphari ?>',
        	<?php endforeach ?>
        ]
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            
        }
    },

    series: [
    <?php foreach ($laporan_pembelian as $namastatus => $tiapstatus): ?>
    {
        name: '<?php echo $namastatus ?>',
        data: [
        <?php foreach ($tiapstatus as $tanggal => $money): ?>
        		<?php echo $money; ?>,
        <?php endforeach ?>
        ]
    }, 
    <?php endforeach ?>
    ],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>


