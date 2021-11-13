function loadMonsters() {
	let sUrl = "php/loadMonsters.php?";
	let elem = document.getElementById("monsterLoadDone");
	let eBtn = document.getElementById("btnLoadMonster");
	let sData = '';
	fetch(sUrl)
	.then(response => response.json())
	.then(response => {
		console.log(response);
	});

	eBtn.disabled = true;
	elem.textContent = "✔";

}