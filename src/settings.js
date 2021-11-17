function loadMonsters() {
	let sUrl = "php/monsterRouter.php?q=loadIntoDb";
	let elem = document.getElementById("monsterLoadDone");
	let eBtn = document.getElementById("btnLoadMonster");
	fetch(sUrl)
	.then(response => response.json())
	.then(response => {
		console.log(response);
	});

	eBtn.disabled = true;
	elem.textContent = "✔";

}