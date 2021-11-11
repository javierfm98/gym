	
	function tabClick(evt,link){
		var tablinks = document.getElementsByClassName("button-body");
		var tabcontent = document.getElementsByClassName("tab-box");

		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}

		document.getElementById(link).style.display = "block";

		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active-body", "");
		}
	//	evt.currentTarget.className += " active-body";
		evt.currentTarget.classList.toggle("active-body");
	}
