function roll(sDie) {
	let sUrl = "php/dice.php?d=";
	let elem = document.getElementById(sDie + "Result");

	switch(sDie) {
		case "d20":
			sUrl = sUrl + 20;
			break;
		case "d12":
			sUrl = sUrl + 12;
			break;
		case "d10":
			sUrl = sUrl + 10;
			break;
		case "d8":
			sUrl = sUrl + 8;
			break;
		case "d6":
			sUrl = sUrl + 6;
			break;
		case "d4":
			sUrl = sUrl + 4;
			break;
		case "d100":
			sUrl = sUrl + 100;
			break;
	}

	fetch(sUrl)
	.then(response => response.json())
	.then(response => {
		console.log(response);
		elem.textContent = response;
	});
}
