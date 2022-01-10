let $date = $('#datePicker');
let $baseUrl = $("#url").val();


window.onload = loadTrainings;
$date.change(loadTrainings);

function loadTrainings(){

  if(document.getElementById('flag')){
    value = document.getElementById('flag').value;
    console.log(value);
    $date.val(value);
   
  }

	displayTrainings($date.val());
}

//var refInterval = window.setInterval('displayTrainings($date.val())', 3000); // 30 seconds
  
function displayTrainings(date){
	$.ajax({
		type: 'GET' , 
		url : $baseUrl+'/display-trainings' ,
		data:{'date':date} ,
		success:function(data){
			$('#trainings').html(data);
		} 
	});
}

function func(img) {
  img.parentNode.removeChild(img);

  if($("flag")){
    $("#flag").remove();
  }
}

