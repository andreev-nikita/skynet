<?php

	$tariffId =  $_GET["tariff-id"];
	$json = json_decode(file_get_contents("http://sknt.ru/job/frontend/data.json"));

	foreach ($json->tarifs as $key => $value) {
		foreach ($json->tarifs[$key]->tarifs as $secondKey => $secondValue) {
			if ($tariffId == $json->tarifs[$key]->tarifs[$secondKey]->ID) {
				$currentTarif = $json->tarifs[$key]->title;
				$payPeriod = $json->tarifs[$key]->tarifs[$secondKey]->pay_period;
				$price = $json->tarifs[$key]->tarifs[$secondKey]->price;
				$currentPricePerMonth = $price / $payPeriod;
				$payday = date('d.m.Y', $json->tarifs[$key]->tarifs[$secondKey]->new_payday);
			}
		}
	}

	switch ($payPeriod) {
	    case 1:
	        $month = "месяц";
	        break;
	    case 3:
	        $month = "месяца";
	        break;
	    case 6:
	        $month = "месяцев";
	        break;
	    case 12:
	        $month = "месяцев";
	        break;
	}

	echo "
		<div class=\"content-options\">
			<div class=\"options-header\">
					<svg id=\"options-header__arrow\" class=\"options-header__arrow\" viewBox=\"0 0 512 512\"><polygon points=\"352,128.4 319.7,96 160,256 160,256 160,256 319.7,416 352,383.6 224.7,256 \"/>
					</svg>
				<h2 class=\"options-header__header\">Выбор тарифа</h2>
			</div> ";

	echo "
			<div class=\"tariff tariff_options\">
				<h2 class=\"tariff__header\">Тариф \"$currentTarif\"</h2>
				<div class=\"tariff__flex-container\">
					<div class=\"tariff__left-block\">
						<h3 class=\"tariff__cost\">Период оплаты - $payPeriod $month</h3>
						<h3 class=\"tariff__cost\">$currentPricePerMonth &#8381;/мес</h3>
						<div class=\"tariff__packages\">
							<p class=\"tariff__package-item\">разовый платеж - $price &#8381;</p>
							<p class=\"tariff__package-item\">со счета спишеться - $price &#8381;</p>
						</div>
						<div class=\"tariff__packages tariff__packages_selected\">
							<p class=\"tariff__package-item tariff__package-item_selected\">вступит в силу - сегодня</p>
							<p class=\"tariff__package-item tariff__package-item_selected\">активно до - $payday</p>
						</div>
					</div>
				</div>
			<div class=\"confirm-button\">
				Выбрать
			</div>
			</div>
		</div>
	";

	?>