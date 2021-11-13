function roll(sDie) {
	let sUrl = "php/dice.php?d=";
	let elem = document.getElementById(sDie + "Result");

	switch(sDie) {
		case "d20":
			sUrl = sUrl + 20;
			break
	}

		
	fetch(sUrl)
	.then(response => response.json())
	.then(response => {
		console.log(response);
		elem.textContent = response;
	});
}
