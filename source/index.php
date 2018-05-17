<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="content">
	<?php

		// Вычисляем минимальную и максимальную стоимость тарифа.
		function calcCost ($json, $tariffNumber) {
			$monthPrice = array();
			foreach ($json->tarifs[$tariffNumber]->tarifs as $key => $value) {
				$monthPrice[$key] = $value->price / $value->pay_period;
			}
			return array('min' => min($monthPrice), 'max' => max($monthPrice));
		}

		// Выводим список дополнительных опций
		function showOptions ($json, $tariffNumber) {
			if (array_key_exists("free_options", $json->tarifs[$tariffNumber])) {
				foreach ($json->tarifs[$tariffNumber]->free_options as $value) {
					$string .= "<p class=\"tariff__package-item\">$value</p>";
				}
				return $string;
			}
		}

		//Изменяем цвет скорости 
		function changeSpeedColor ($json, $tariffNumber) {
			 if(stristr($json->tarifs[$tariffNumber]->title, 'Вода') !== FALSE) {
			    return "tariff__speed_blue";
			 } else if(stristr($json->tarifs[$tariffNumber]->title, 'Огонь') !== FALSE) {
			    return "tariff__speed_orange";
			 }
		}

		$json = json_decode(file_get_contents("../assets/data.json"));
		$tarifsNumber =  count($json->tarifs);
		

		for($i = 0; $i < $tarifsNumber; $i++) {
			$currentTarif = $json->tarifs[$i]->title;
			$currentSpeed = $json->tarifs[$i]->speed;
			$currentCostMin = $json->tarifs[$i]->tarifs[0]->speed;
			$price = calcCost($json, $i);
			$freeOptions = showOptions($json, $i);
			$speedColor = changeSpeedColor($json, $i);
			
			echo "
				<div class=\"tariff\">
					<h2 class=\"tariff__header\">Тариф \"$currentTarif\"</h2>
					<div class=\"tariff__flex-container\">
						<div class=\"tariff__left-block\">
							<h3 class=\"tariff__speed $speedColor\">$currentSpeed Мбит/с</h3>
							<h3 class=\"tariff__cost\">$price[min] - $price[max] &#8381;/мес</h3>
							<div class=\"tariff__packages\">
								$freeOptions
							</div>
						</div>
						<svg class=\"tariff__arrow\" viewBox=\"0 0 512 512\">
							<polygon points=\"160,128.4 192.3,96 352,256 352,256 352,256 192.3,416 160,383.6 287.3,256 \"/>
						</svg>
					</div>
					<p class=\"tariff__footer\">узнать подробнее на сайте www.sknt.ru</p>
				</div>
			";
		}
	?>
		

		<!-- <div class="tariff">
			<h2 class="tariff__header">Тариф "Земля"</h2>
			<div class="tariff__flex-container">
				<div class="tariff__left-block">
					<h3 class="tariff__speed">50 Мбит/с</h3>
					<h3 class="tariff__cost">350 - 480 &#8381;/мес</h3>
					<div class="tariff__packages">
						<p class="tariff__package-item">ТВ пакет "Социальный ТВ"</p>
						<p class="tariff__package-item">Антивирус Agnitum Outpost</p>
					</div>
				</div>
				<svg class="tariff__arrow" viewBox="0 0 512 512">
					<polygon points="160,128.4 192.3,96 352,256 352,256 352,256 192.3,416 160,383.6 287.3,256 "/>
				</svg>
			</div>
			<p class="tariff__footer">узнать подробнее на сайте www.sknt.ru</p>
		</div> -->
	</div>


	<script src="js/main.js"></script>
</body>
</html>