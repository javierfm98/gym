
<div id="grafica"></div>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
	Highcharts.chart('grafica', {
	    chart: {
	        type: 'line'
	    },
	    title: {
	        text: 'Mi cuerpo'
	    },
	    xAxis: {
	        categories: @json($countMonths)
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
        name: 'Objetivo Peso (Kg)',
        dashStyle: 'ShortDash',
        data: @json($goalWeightCount)
    }, {
        name: 'Objetivo % Grasa corporal',
        dashStyle: 'ShortDash',
        data: @json($goalBodyFatCount)
    } , {
    	name: 'Peso (Kg)',
    	pointStart: @json($pointStartWeight),
    	data: @json($arrayWeight)
    }, {
    	name: '% Grasa corporal',
    	pointStart: @json($pointStartBodyFat),
    	data: @json($arrayBodyFat)
    }]
	});
</script>