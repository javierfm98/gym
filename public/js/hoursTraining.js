let $date = $('#datePicker');
let $baseUrl = $("#url").val();

window.onload = loadHours;
$date.change(loadHours);


function loadHours(){
	if(!($date.val() == "")){

		const selectedDate = $date.val();

		displayHours(selectedDate);
	}
	
}

function displayHours(date){
	$.ajax({
		type: 'GET' , 
		url : $baseUrl+'/hours' ,
		data:{'date':date } ,
		success:function(data){
			$('#schedule').html(data);
		} 
	});
}

