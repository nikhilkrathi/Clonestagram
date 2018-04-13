	var modal = document.getElementById('followersModal');
	var followersTxt = document.getElementById('followers');
	var span = document.getElementsByClassName("close")[0];

	followersTxt.onclick = function() {
		modal.style.display = "block";
	}
	
	span.onclick = function() {
		modal.style.display = "none";
	}

	window.onclick = function(event) {
		if (event.target == modal) {
		    modal.style.display = "none";
		}
	}
