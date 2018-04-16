var record;
function follow() {

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
	}
}

function load() {
	getFollowingData();
	
}
window.onload = load;
	
