var modal1 = document.getElementById('followersModal');
var modal2 = document.getElementById('followingModal');
var span1 = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[1];

span1.onclick = function() {
	modal1.style.display = "none";
}

span2.onclick = function() {
	modal2.style.display = "none";
}

window.onclick = function(event) {
	if (event.target == modal1) {
	    modal1.style.display = "none";
	}
	if (event.target == modal2) {
	    modal2.style.display = "none";
	}
}

function displayModal(modalId, textId){
	var modal = document.getElementById(modalId);
	var text = document.getElementById(textId);

	text.onclick = function() {
		modal.style.display = "block";
	}
}

function loadTable(){
	
}

function getFollowersData(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", "modal.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("request=followers");
	//alert(xhttp.responseText);
	var record = JSON.parse(xhttp.responseText);
	if(typeof record == "undefined") {
		alert("Table not found.");
		return false;
	}
	return record;
}

function getFollowingData(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", "modal.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("request=following");
	//alert(xhttp.responseText);
	var record = JSON.parse(xhttp.responseText);
	if(typeof record == "undefined") {
		alert("Table not found.");
		return false;
	}
	return record;
}

function createTable(flag) {
	if(flag == 0){
		var tableId = document.getElementById("followersTable");
	
		//Heading
		var tableRow = document.createElement("tr");
		var tableHeader = document.createElement("th");
		var tableType = document.createElement("H3");
		var tableCell = document.createTextNode("People who follow you");
		tableId.appendChild(tableRow);
		tableRow.appendChild(tableHeader);
		tableHeader.appendChild(tableType);
		tableType.appendChild(tableCell);
	
		var db = getFollowersData();	
	
		for(var i=0; i<db.length; i++){
			var row = tableId.insertRow(1);
			var cell = row.insertCell(-1);
			var centerTag = document.createElement("P");
			var centerText = document.createTextNode(db[i].fullname);
			centerTag.setAttribute("id", "row_fwers_" + i);
			centerTag.setAttribute("align","center");
			centerTag.appendChild(centerText);
			cell.appendChild(centerTag);
		}
	}
	
	else if(flag == 1){
		var tableId = document.getElementById("followingTable");
	
		//Heading
		var tableRow = document.createElement("tr");
		var tableHeader = document.createElement("th");
		var tableType = document.createElement("H3");
		var tableCell = document.createTextNode("People you follow");
		tableId.appendChild(tableRow);
		tableRow.appendChild(tableHeader);
		tableHeader.appendChild(tableType);
		tableType.appendChild(tableCell);
	
		var db = getFollowingData();	
	
		for(var i=0; i<db.length; i++){
			var row = tableId.insertRow(1);
			var cell = row.insertCell(-1);
			var centerTag = document.createElement("P");
			var centerText = document.createTextNode(db[i].fullname);
			centerTag.setAttribute("id", "row_fwing_" + i);
			centerTag.setAttribute("align","center");
			centerTag.appendChild(centerText);
			cell.appendChild(centerTag);
		}
	}
}

function load() {
	//loadTable();
	createTable(0);
	createTable(1);
}
window.onload = load;
	

		
