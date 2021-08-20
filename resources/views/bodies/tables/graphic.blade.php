
<div id="container" class="mt-4"></div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
	Highcharts.chart('container', {
	    chart: {
	        type: 'line'
	    },
	    title: {
	        text: 'Mi cuerpo'
	    },
	    xAxis: {
	        categories: @json($countMouths)
	    },
	    yAxis: {
	        title: {
	            text: 'Valor'
	        }
	    },
	    plotOptions: {
	        line: {
	            dataLabels: {
	                enabled: false
	            },
	            enableMouseTracking: true
	        }
	    },
	    series: [{
        name: 'Peso',
        pointStart: 0,
        data: [7.0, 6.9, 9.5]
    }, {
        name: '% Grasa',
        pointStart: 2,
        data: [3.9]
    }]
	});
</script>