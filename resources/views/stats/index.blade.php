@extends('layouts.menu')

@section('title', 'Estadisticas gimnasio')
@section('content')
		<div class="no-wrapper">
			<h3>Estadisticas del gimnasio</h3>
		</div>
		<div class="wrapper">
			<h3 class="title">Clientes</h3>
			<div class="container-chart">
				<div id="total" class="chart-size"></div>
				<div id="paid" class="chart-size"></div>
				<div id="unpaid" class="chart-size"></div>
				<div id="pending" class="chart-size"></div>
			</div>
		</div>
		<div class="wrapper">
			<div id="profits"></div>
		</div>
		<div class="wrapper">
			<div id="rates"></div>
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
			    text: 'Clientes por tarifas'
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
			    },
			    series:{
			    	pointWidth: 50
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
				Highcharts.chart('total',{
    chart: {
      type: 'pie',
      renderTo: 'container'
    },
    title: {
      verticalAlign: 'middle',
      floating: true,
      text: '<span class="text-bold">{{ $totalClients }}</span><br>TOTAL'
    },
    plotOptions: {
      pie: {
        innerSize: '90%',
        dataLabels: {
        	enabled:false
        }
      },
      series:{
      	states:{
      		hover:{
      			enabled:false
      		},
      		inactive:{
      			opacity: 1
      		}
      	}
      }
    },

    tooltip:{
    	enabled:false
    },

    series: [{
      	data: [
            	{  y: 100, color: '#00b8ff' },
            	{  y: 0, color: '#ececec' },
      	]
    }],
        exporting: {
    	enabled: false
    },credits: {
    enabled: false
}
  });
		</script>


<script>
		Highcharts.chart('paid',{
    chart: {
      type: 'pie',
      renderTo: 'container'
    },
    title: {
      verticalAlign: 'middle',
      floating: true,
      text: '<span class="text-bold">{{ $paidClients }}</span><br>PAGADOS'
    },
    plotOptions: {
      pie: {
        innerSize: '90%',
        dataLabels: {
        	enabled:false
        }
      },
      series:{
      	states:{
      		hover:{
      			enabled:false
      		},
      		inactive:{
      			opacity: 1
      		}
      	}
      }
    },

        tooltip:{
 			formatter: function() {
		        if(!this.point.noTooltip) {
		            return '<br/>Porcentaje: <b>'+Highcharts.numberFormat(this.point.y,1,',','.')+
		                   '</b> %<br/>';
        		}
   
       		 	return false;
    		},
    		hideDelay: 150	
      },

    series: [{
      	data: @json($paidClientsJSON)
    }],
        exporting: {
    	enabled: false
    },credits: {
    enabled: false
}
  });

</script>


<script>
		Highcharts.chart('unpaid',{
    chart: {
      type: 'pie',
      renderTo: 'container'
    },
    title: {
      verticalAlign: 'middle',
      floating: true,
      text: '<span class="text-bold">{{ $unpaidClients }}</span><br>IMPAGOS'
    },
    plotOptions: {
      pie: {
        innerSize: '90%',
        dataLabels: {
        	enabled:false
        }
      },
      series:{
      	states:{
      		hover:{
      			enabled:false
      		},
      		inactive:{
      			opacity: 1
      		}
      	}
      }
    },

    tooltip:{
 			formatter: function() {
		        if(!this.point.noTooltip) {
		            return '<br/>Porcentaje: <b>'+Highcharts.numberFormat(this.point.y,1,',','.')+
		                   '</b> %<br/>';
        		}
   
       		 	return false;
    		},
    		hideDelay: 150
    },

    series: [{
      	data: @json($unpaidClientsJSON)
    }],
        exporting: {
    	enabled: false
    },credits: {
    enabled: false
}
  });

</script>


<script>
		Highcharts.chart('pending',{
    chart: {
      type: 'pie',
      renderTo: 'container'
    },
    title: {
      verticalAlign: 'middle',
      floating: true,
      text: '<span class="text-bold">{{ $pendingClients }}</span><br>PENDIENTES'
    },
    plotOptions: {
      pie: {
        innerSize: '90%',
        dataLabels: {
        	enabled:false
        }
      },
      series:{
      	states:{
      		hover:{
      			enabled:false
      		},
      		inactive:{
      			opacity: 1
      		}
      	}
      }
    },

    tooltip:{
 			formatter: function() {
		        if(!this.point.noTooltip) {
		            return '<br/>Porcentaje: <b>'+Highcharts.numberFormat(this.point.y,1,',','.')+
		                   '</b> %<br/>';
        		}
   
       		 	return false;
    		},

    		hideDelay: 150
    },

    series: [{
      	data: @json($pendingClientsJSON)
    }],
        exporting: {
    	enabled: false
    },credits: {
    enabled: false
}
  });

</script>


		<script>
			
Highcharts.chart('profits', {
			  chart: {
			    type: 'column'
			  },
			  title: {
			    text: 'Ingresos del gimnasio (1 año)'
			  },
			  xAxis: {
			    categories: @json($dateProfitFormat),
			    crosshair: true
			  },
			  yAxis: {
			    min: 0,
			    title: {
			      text: 'Euros'
			    }
			  },
			  	tooltip:{
 					pointFormat: 'Ingresos: <span class="text-bold">{point.y} €</span> '
    			},
			  plotOptions: {
			    column: {
			      pointPadding: 0.2,
			      borderWidth: 0
			    },
			    series:{
			    	pointWidth: 50
			    }
			  },
			  series: [{
			  	showInLegend: false,
			    name: 'Clientes',
			    data: @json($profitsArray),
			    color: '#00b8ff'
			  }]
});

		</script>


	
@endsection