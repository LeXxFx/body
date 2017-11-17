<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->IncludeComponent(
		"bitrix:sale.basket.basket",
		"footer",
		Array(
			"ACTION_VARIABLE" => "basketAction",
			"AUTO_CALCULATION" => "Y",
			"COLUMNS_LIST" => array("NAME","DISCOUNT","WEIGHT","DELETE","DELAY","TYPE","PRICE","QUANTITY"),
			"CORRECT_RATIO" => "N",
			"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
			"GIFTS_CONVERT_CURRENCY" => "N",
			"GIFTS_HIDE_BLOCK_TITLE" => "N",
			"GIFTS_HIDE_NOT_AVAILABLE" => "N",
			"GIFTS_MESS_BTN_BUY" => "Выбрать",
			"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
			"GIFTS_PAGE_ELEMENT_COUNT" => "4",
			"GIFTS_PLACE" => "BOTTOM",
			"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
			"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
			"GIFTS_SHOW_IMAGE" => "Y",
			"GIFTS_SHOW_NAME" => "Y",
			"GIFTS_SHOW_OLD_PRICE" => "N",
			"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
			"HIDE_COUPON" => "N",
			"OFFERS_PROPS" => array(),
			"PATH_TO_ORDER" => "/personal/order.php",
			"PRICE_VAT_SHOW_VALUE" => "N",
			"QUANTITY_FLOAT" => "N",
			"SET_TITLE" => "Y",
			"TEMPLATE_THEME" => "blue",
			"USE_ENHANCED_ECOMMERCE" => "N",
			"USE_GIFTS" => "N",
			"USE_PREPAYMENT" => "N"
		)
	);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>