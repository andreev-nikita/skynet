
let arrow = document.getElementsByClassName('tariff__arrow');

Array.from(arrow).forEach(function(item, key) {
	arrow[key].addEventListener('click', () => {
		showTariffOptions(key);
	}, false);
});

let showTariffOptions = (key) => {
	let xhr = new XMLHttpRequest();
	xhr.open('GET', `tariff-options.php?tariff-id=${key}`);
	xhr.send();
	xhr.onreadystatechange = function() {
	  if (this.readyState != 4) return;

	  // по окончании запроса доступны:
	  // status, statusText
	  // responseText, responseXML (при content-type: text/xml)

	  if (this.status != 200) {
	    // обработать ошибку
	    alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
	    return;
	  }
	 // alert(this.responseText);
	  let tmp = document.getElementsByClassName('main');
	  tmp[0].innerHTML = this.responseText;
	  // получить результат из this.responseText или this.responseXML
	}
}