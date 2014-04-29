function changeTaglib(id) {
	var array = ["index", "goubuy", "service", "case", "join", "link"];
	for (var i = 0; i < array.length; i++) {
		if(id==array[i]){
			document.getElementById(id).className = 'nav_yes nav_Text';
			return;
		}/*else{
			document.getElementById(id).className = 'nav_Text';
		}*/
	}
}
