
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
        name: 'Objetivo Peso',
        dashStyle: 'ShortDash',
        data: @json($goalWeightCount)
    }, {
        name: 'Obj % Grasa corporal',
        dashStyle: 'ShortDash',
        data: @json($goalBodyFatCount)
    } , {
    	name: 'Peso',
    	pointStart: @json($pointStartWeight),
    	data: @json($arrayWeight)
    }, {
    	name: '% Grasa corporal',
    	pointStart: @json($pointStartBodyFat),
    	data: @json($arrayBodyFat)
    }]
	});
</script>