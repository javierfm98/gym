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
				<div id="profits"></div>
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
			    categories: [
			      'Mensual',
			      'Trimestral',
			      'Anual'
			    ],
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
			    name: 'Clientes',
			    data: [ 
				    ['Mensual', 24],
		      		['Anual', 20],
		      		['Trimestral', 14]
		  		]

			  }]
			});
		</script>

		<script>
			Highcharts.chart('profits', {
			  chart: {
			    type: 'column'
			  },
			  title: {
			    text: 'Ganancias totales'
			  },
			  xAxis: {
			    categories: [
					'Ene',
					'Feb',
					'Mar',
					'Abr',
					'May',
					'Jun',
					'Jul',
					'Ago',
					'Sept',
					'Oct',
					'Nov',
					'Dic'
			    ],
			    crosshair: true
			  },
			  yAxis: {
			    min: 0,
			    title: {
			      text: 'Euros'
			    }
			  },
			  tooltip: {
			    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
			      '<td style="padding:0"><b>{point.y} €</b></td></tr>',
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
			    name: 'Ganancias',
			    data: [ 
				    ['Enero', 24],
		      		['Febrero', 20],
		      		['Marzo', 14],
		      		['Abril', 23],
		      		['Mayo', 12],
		      		['Junio', 23],
		      		['Julio' , 20],
		      		['Agosto', 23],
		      		['Septiembre', 12],
		      		['Octubre', 34],
		      		['Nobiembre',123],
		      		['Diciembre', 32]
		  		]

			  }]
			});
		</script>

@endsection