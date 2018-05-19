//Загрузка вариантов оплаты тарифа
let showTariffOptions = (key) => {
	let xhr = new XMLHttpRequest();
	xhr.open('GET', `tariff-options.php?tariff-id=${key}`);
	xhr.send();
	xhr.onreadystatechange = function() {
		if (this.readyState != 4) return;
		if (this.status != 200) {
		    alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
			return;
		}
		let tmp = document.getElementById('main');
		tmp.innerHTML = this.responseText;

		let optionsArrow = document.getElementById('options-header__arrow');
		optionsArrow.addEventListener('click', () => {
			showTariffList();
		}, false)

		let selectedTariffArrow = document.getElementsByClassName('tariff__arrow_options');
		Array.from(selectedTariffArrow).forEach(function(item, secondKey) {
			selectedTariffArrow[secondKey].addEventListener('click', (event) => {
				let id = document.getElementsByClassName('tariff_options');
				showSelectedTariff(id[secondKey].id, key);
			}, false);
		});
	}
}

//Загрузка выбранного тарифа
let showSelectedTariff = (id, key) => {
	let xhr = new XMLHttpRequest();
	xhr.open('GET', `tariff-selected.php?tariff-id=${id}`);
	xhr.send();
	xhr.onreadystatechange = function() {
		if (this.readyState != 4) return;
		if (this.status != 200) {
		    alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
			return;
		}

		let tmp = document.getElementById('main');
		tmp.innerHTML = this.responseText;

		let optionsArrow = document.getElementById('options-header__arrow');
		optionsArrow.addEventListener('click', () => {
			showTariffOptions(key);
		}, false)
	}

}

//Загрузка списка тарифов
let showTariffList = () => {
	let xhr = new XMLHttpRequest();
	xhr.open('GET', 'tariff-list.php');
	xhr.send();
	xhr.onreadystatechange = function() {
		if (this.readyState != 4) return;
		if (this.status != 200) {
		    alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
			return;
		}
		let tmp = document.getElementById('main');
		tmp.innerHTML = this.responseText;

		let arrow = document.getElementsByClassName('tariff__arrow');
		Array.from(arrow).forEach(function(item, key) {
			arrow[key].addEventListener('click', () => {
				showTariffOptions(key);
			}, false);
		});
	}
}

showTariffList();