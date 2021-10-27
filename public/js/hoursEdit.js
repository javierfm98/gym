let $date = $('#datePicker');
let $horario = $('#currentHour');


//console.log($horario.val());

window.onload = loadHours;
$date.change(loadHours);

function loadHours(){
	if(!($date.val() == "")){
		const schedule = $horario.val();
		const selectedDate = $date.val();
		displayHours(selectedDate , schedule);
	}
	
}

function displayHours(date , schedule){
	$.ajax({
		type: 'GET' , 
		url : '/hours' ,
		data:{'date':date , 'schedule' : schedule } ,
		success:function(data){
			$('#horario').html(data);
		} 
	});
}
