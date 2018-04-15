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
	for(var i=0; i<data.username.length; i++){
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
		tableLikeButton.setAttribute("id", "likeButton_" + i);
		tableLikeButton.setAttribute("align", "left");
		tableLikeButton.setAttribute("value", "LIKE");
		table.appendChild(tableRowLikeButton);
		tableRowLikeButton.appendChild(tableDataLikeButton);
		tableDataLikeButton.appendChild(tableLikeButton);
		tableLikeButton.appendChild(buttonText);
		
		
		div.appendChild(table);		
				
	}
}

function load() {
	createFeedCards();
	//getFeedData();
}
window.onload = load;
