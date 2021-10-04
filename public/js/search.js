/*$(document).ready(function(){
	$('#search-bar').on('keyup' , function(){
		var client = $(this).val();
		if(client != ""){
			searchClient(client);
		}else{
			searchClient();
		}
	});
});


function searchClient(client){
	$.ajax({
	type: 'GET' , 
	url : '/search' ,
	data:{'search':client } ,
	success:function(data){
		$('#result').html(data);
		console.log(data);
	} 

	});
}

function enviarId(id){  
	searchClient();
 	var id_training = document.getElementById("id_training");
 	id_training.value = id;
}

function func2(img) {
	//img.parentNode.removeChild(img);
	var id_training = document.getElementById("id_training").value;
    var inputsTraining = document.getElementsByClassName("entreno");
    var inputsDate = document.getElementsByClassName("current_date");
    let $date = $('#datePicker').val();
    for(var i = 0; i < inputsTraining.length; i++){
      inputsTraining[i].value = id_training;
      inputsDate[i].value = $date;
    }
}

function clearSearchBar(){
	document.getElementById('search-bar').value = ''
	searchClient();
}*/


