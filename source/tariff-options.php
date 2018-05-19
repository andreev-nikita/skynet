<?php
	$tariffId =  $_GET["tariff-id"];
	$json = json_decode(file_get_contents("http://sknt.ru/job/frontend/data.json"));
	$currentTarif = $json->tarifs[$tariffId]->title;

	//Поиск индекса расположения массива с нужным периодом оплаты в JSON файле
	function findPayPeriod ($json, $tariffId, $payPeriod) { 
		foreach ($json->tarifs[$tariffId]->tarifs as $key => $value) {
				if($json->tarifs[$tariffId]->tarifs[$key]->pay_period == $payPeriod) {
					return $key;
				}
			}
	}

	echo "
		<div class=\"content-options\">
			<div class=\"options-header\">
					<svg id=\"options-header__arrow\" class=\"options-header__arrow\" viewBox=\"0 0 512 512\"><polygon points=\"352,128.4 319.7,96 160,256 160,256 160,256 319.7,416 352,383.6 224.7,256 \"/>
					</svg>
				<h2 class=\"options-header__header\">Тариф \"$currentTarif\"</h2>
			</div> ";

	$currentPayPeriod = findPayPeriod($json, $tariffId, 1);
	$priceForOneMonth = $json->tarifs[$tariffId]->tarifs[$currentPayPeriod]->price;
	$id = $json->tarifs[$tariffId]->tarifs[$currentPayPeriod]->ID;

	echo "
			<div id=\"$id\" class=\"tariff tariff_options\">
				<h2 class=\"tariff__header\">1 месяц</h2>
				<div class=\"tariff__flex-container tariff__flex-container_options\">
					<div class=\"tariff__left-block\">
						<h3 class=\"tariff__cost\">$priceForOneMonth &#8381;/мес</h3>
						<div class=\"tariff__packages\">
							<p class=\"tariff__package-item\">разовый платеж - $priceForOneMonth &#8381;</p>
						</div>
					</div>
					<svg class=\"tariff__arrow tariff__arrow_options\" viewBox=\"0 0 512 512\">
						<polygon points=\"160,128.4 192.3,96 352,256 352,256 352,256 192.3,416 160,383.6 287.3,256 \"/>
					</svg>
				</div>
			</div>
	";

	$currentPayPeriod = findPayPeriod($json, $tariffId, 3);
	$currentPrice = $json->tarifs[$tariffId]->tarifs[$currentPayPeriod]->price;
	$currentPricePerMonth = $currentPrice / 3;
	$discount = ($priceForOneMonth - $currentPricePerMonth) * 3;
	$id = $json->tarifs[$tariffId]->tarifs[$currentPayPeriod]->ID;

	echo "
			<div id=\"$id\" class=\"tariff tariff_options\">
				<h2 class=\"tariff__header\">3 месяца</h2>
				<div class=\"tariff__flex-container tariff__flex-container_options\">
					<div class=\"tariff__left-block\">
						<h3 class=\"tariff__cost\">$currentPricePerMonth &#8381;/мес</h3>
						<div class=\"tariff__packages\">
							<p class=\"tariff__package-item\">разовый платеж - $currentPrice &#8381;</p>
							<p class=\"tariff__package-item\">скида - $discount &#8381;</p>
						</div>
					</div>
					<svg class=\"tariff__arrow tariff__arrow_options\" viewBox=\"0 0 512 512\">
						<polygon points=\"160,128.4 192.3,96 352,256 352,256 352,256 192.3,416 160,383.6 287.3,256 \"/>
					</svg>
				</div>
			</div>
	";

	$currentPayPeriod = findPayPeriod($json, $tariffId, 6);
	$currentPrice = $json->tarifs[$tariffId]->tarifs[$currentPayPeriod]->price;
	$currentPricePerMonth = $currentPrice / 6;
	$discount = ($priceForOneMonth - $currentPricePerMonth) * 6;
	$id = $json->tarifs[$tariffId]->tarifs[$currentPayPeriod]->ID;

	echo "
			<div id=\"$id\" class=\"tariff tariff_options\">
				<h2 class=\"tariff__header\">6 месяцев</h2>
				<div class=\"tariff__flex-container tariff__flex-container_options\">
					<div class=\"tariff__left-block\">
						<h3 class=\"tariff__cost\">$currentPricePerMonth &#8381;/мес</h3>
						<div class=\"tariff__packages\">
							<p class=\"tariff__package-item\">разовый платеж - $currentPrice &#8381;</p>
							<p class=\"tariff__package-item\">скида - $discount &#8381;</p>
						</div>
					</div>
					<svg class=\"tariff__arrow tariff__arrow_options\" viewBox=\"0 0 512 512\">
						<polygon points=\"160,128.4 192.3,96 352,256 352,256 352,256 192.3,416 160,383.6 287.3,256 \"/>
					</svg>
				</div>
			</div>
	";

	$currentPayPeriod = findPayPeriod($json, $tariffId, 12);
	$currentPrice = $json->tarifs[$tariffId]->tarifs[$currentPayPeriod]->price;
	$currentPricePerMonth = $currentPrice / 12;
	$discount = ($priceForOneMonth - $currentPricePerMonth) * 12;
	$id = $json->tarifs[$tariffId]->tarifs[$currentPayPeriod]->ID;

	echo "
			<div id=\"$id\" class=\"tariff tariff_options\">
				<h2 class=\"tariff__header\">12 месяцев</h2>
				<div class=\"tariff__flex-container tariff__flex-container_options\">
					<div class=\"tariff__left-block\">
						<h3 class=\"tariff__cost\">$currentPricePerMonth &#8381;/мес</h3>
						<div class=\"tariff__packages\">
							<p class=\"tariff__package-item\">разовый платеж - $currentPrice &#8381;</p>
							<p class=\"tariff__package-item\">скида - $discount &#8381;</p>
						</div>
					</div>
						<svg class=\"tariff__arrow tariff__arrow_options\" viewBox=\"0 0 512 512\">
							<polygon points=\"160,128.4 192.3,96 352,256 352,256 352,256 192.3,416 160,383.6 287.3,256 \"/>
						</svg>
				</div>
			</div>
		</div>
	"
?>