function getFeedData(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", "feed.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("request=feedData");
	//alert(xhttp.responseText);
	var record = JSON.parse(xhttp.responseText);
	if(typeof record == "undefined") {
		alert("Table not found.");
		return false;
	}
	return record;
}

function createFeedCards(){
	var div = document.getElementById("feedDiv");
	var data = getFeedData();
	var count = 0;
	//for(var i=0; i<data.username.length; i++){
	for(var i in data.username){
		var photoid = data.photoid[count];
		var table = document.createElement("TABLE");
		table.setAttribute("class", "imgTableFeed");
		
		//Username
		var tableRowUsername = document.createElement("tr");
		var tableDataUsername = document.createElement("td");
		tableDataUsername.setAttribute("align", "left");
		var username = document.createTextNode(data.username[i]);
		table.appendChild(tableRowUsername);
		tableRowUsername.appendChild(tableDataUsername);
		tableDataUsername.appendChild(username);
		
		//Image
		var tableRowImage = document.createElement("tr");
		var tableDataImage = document.createElement("td");
		var image = document.createElement("IMG");
		image.setAttribute("class", "tableImg");
		image.setAttribute("src", data.photo_url[i]);
		table.appendChild(tableRowImage);
		tableRowImage.appendChild(tableDataImage);
		tableDataImage.appendChild(image);
		
		//Likes
		var tableRowLikes = document.createElement("tr");
		var tableDataLikes = document.createElement("td");
		tableDataLikes.setAttribute("align", "left");
		var likes = document.createTextNode(data.likes[i] + " likes");
		table.appendChild(tableRowLikes);
		tableRowLikes.appendChild(tableDataLikes);
		tableDataLikes.appendChild(likes);
		
		//Like Button
		var tableRowLikeButton = document.createElement("tr");
		var tableDataLikeButton = document.createElement("td");
		var tableLikeButton = document.createElement("BUTTON");
		var buttonText = document.createTextNode("Like");
		var liked = likedOrNot(photoid);
		if(liked.likedOrNot == 1){
			tableLikeButton.disabled = true;
		}
		tableLikeButton.setAttribute("id", "likeButton_" + count);
		tableLikeButton.setAttribute("align", "left");
		tableLikeButton.setAttribute("value", "LIKE");
		tableLikeButton.onclick = function(count_f, photoid_f) { 
   			return function() { 
      			addLikes.call(this, count_f, photoid_f); 
      			}; 
   			}(count, photoid);
		table.appendChild(tableRowLikeButton);
		tableRowLikeButton.appendChild(tableDataLikeButton);
		tableDataLikeButton.appendChild(tableLikeButton);
		tableLikeButton.appendChild(buttonText);
		div.appendChild(table);	
		count = count + 1;	
				
	}
}

function addLikes(count, photoid){
	var user = getCurrentUserId();
	var userId = user.CurrentUserId;
	//alert("UserId = "+ userId + " liked photo with ID = " + photoid + " pos = " + count);
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if(this.readyState == 4 && this.status == 200) {
			var response = JSON.parse(this.responseText);
			if(response["Success"] == "True") {
				//alert("Record Updated Successfully!");
			}
			else {
				alert("Update Failed.\nError: " + response["Error"]);
			}
			load();
			document.getElementById("likeButton_" + count).disabled = true;
		}
	}
	xhttp.open("POST", "feed.php", true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send("request=addlike&userId=" + userId + "&photoid=" + photoid);

}

function likedOrNot(photoid){
	var user = getCurrentUserId();
	var userId = user.CurrentUserId;
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", "feed.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("request=likedOrNot&userId=" + userId + "&photoid=" + photoid);
	//alert(xhttp.responseText);
	var likedOrNot = JSON.parse(xhttp.responseText);
	if(typeof likedOrNot == "undefined") {
		alert("Table not found.");
		return false;
	}
	return likedOrNot;
}

function getCurrentUserId(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", "feed.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("request=CurrentUserId");
	//alert(xhttp.responseText);
	var currentUserId = JSON.parse(xhttp.responseText);
	if(typeof currentUserId == "undefined") {
		alert("Table not found.");
		return false;
	}
	return currentUserId;
}

function load() {
	createFeedCards();
}
window.onload = load;
