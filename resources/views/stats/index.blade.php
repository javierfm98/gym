@extends('layouts.menu')

@section('title', 'Estadisticas gimnasio')
@section('content')
		<div class="no-wrapper">
			<h3>Estadisticas del gimnasio</h3>
		</div>
		<div class="stat-container">
			<div class="wrapper">
				<div id="rates"></div>
			</div>
			<div class="wrapper">
				<div id="payments"></div>
			</div>			
		</div>


		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/series-label.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
		<script src="https://code.highcharts.com/modules/accessibility.js"></script>

		<script>
			
Highcharts.chart('rates', {
			  chart: {
			    type: 'column'
			  },
			  title: {
			    text: 'Clientes totales por tarifas'
			  },
			  xAxis: {
			    categories: @json($rate),
			    crosshair: true
			  },
			  yAxis: {
			    min: 0,
			    title: {
			      text: 'Clientes'
			    }
			  },
			  tooltip: {
			    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
			      '<td style="padding:0"><b>{point.y}</b></td></tr>',
			    footerFormat: '</table>',
			    shared: true,
			    useHTML: true
			  },
			  plotOptions: {
			    column: {
			      pointPadding: 0.2,
			      borderWidth: 0
			    }
			  },
			  series: [{
			  	showInLegend: false,
			    name: 'Clientes',
			    data: @json($countClientsRates),
			    color: '#00b8ff'
			  }]
});

		</script>

		<script>
			Highcharts.chart('payments', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Clientes estado de pago'
    },
    tooltip: {
        pointFormat: '<span>Porcentaje</span>: <b>{point.y}%</b><br/><span">{series.name}</span>: <b>{point.clients}</b><br/>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
        	colors: ['#28a745', '#dc3545', '#f0ad4e'],
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    	series: @json($chartStatus)
   });

		</script>



	
@endsection