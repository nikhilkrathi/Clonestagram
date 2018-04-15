var record, success;
function follow() {
	
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", "follow.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("request=follow");
	//alert(xhttp.responseText);
	var success = JSON.parse(xhttp.responseText);
	var followBtn = document.getElementById("followBtn");
	followBtn.disabled = true;
	if (followBtn.textContent=="Follow") followBtn.textContent = "Following";
    		else followBtn.textContent = "Follow";
		followBtn.value = "Following";
	//alert("clicked");
}

function getFollowingData() {
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", "follow.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("request=following");
	//alert(xhttp.responseText);
	record = JSON.parse(xhttp.responseText);
	followButtonEnableDisable();
}

function followButtonEnableDisable(){
	var followBtn = document.getElementById("followBtn");
	if(record[0].followsOrNot == 1){
		followBtn.disabled = true;
		if (followBtn.textContent=="Follow") followBtn.textContent = "Following";
    else followBtn.textContent = "Follow";
		followBtn.value = "Following";
	}
}

function load() {
	getFollowingData();
	
}
window.onload = load;
	
