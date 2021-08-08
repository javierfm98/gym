let $date = $('#datePicker');


window.onload = loadTrainings;
$date.change(loadTrainings);

function loadTrainings(){

  if(document.getElementById('juan')){
    value = document.getElementById('juan').value;
    console.log(value);
    $date.val(value);
  }

	displayTrainings($date.val());
}

  
function displayTrainings(date){
	$.ajax({
		type: 'GET' , 
		url : '/display-trainings' ,
		data:{'date':date } ,
		success:function(data){
			$('#trainings').html(data);
		} 
	});
}

function func(img) {
  img.parentNode.removeChild(img);

  if($("juan")){
    $("#juan").remove();
  }
}
