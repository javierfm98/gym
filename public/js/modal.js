	let open = document.getElementById('open-modal')
	let close = document.getElementById('close-modal');
	let modalC = document.getElementById('modal-container');
	let modal = document.getElementById('modal');
	let training_id = document.getElementById("trainingId");

	open.trainingId = training_id.value;
	


	open.addEventListener("click", function(e){
		e.preventDefault();
		var id_training = document.getElementById("id_training");
 		id_training.value = e.currentTarget.trainingId;
 		searchClient();
		modalC.style.opacity = "1";
		modalC.style.visibility = "visible";
		modal.classList.toggle("hidden-modal");
	});


	close.addEventListener("click", function(){
		closeModal();
	});

	window.addEventListener("click", function(e){
		if(e.target == modalC){
			closeModal();
		}
	});

	function closeModal() {
		modal.classList.toggle("hidden-modal");
		setTimeout(function(){
			modalC.style.opacity = "0";
			modalC.style.visibility = "hidden";
		},700);
	}



$(document).ready(function(){
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
	} 

	});
}


function func2(img) {
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
}

