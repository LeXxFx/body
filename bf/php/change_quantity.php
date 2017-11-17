<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('sale');

$arFields = array(
	"QUANTITY" => intval($_GET["quantity"]),
);
$res = CSaleBasket::Update(intval($_GET["id"]), $arFields);

$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	"ajax", 
	array(
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "PROPS",
			3 => "DELETE",
			4 => "DELAY",
			5 => "PRICE",
			6 => "QUANTITY",
			7 => "SUM",
		),
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"PATH_TO_ORDER" => "/personal/order/make/",
		"HIDE_COUPON" => "N",
		"QUANTITY_FLOAT" => "N",
		"PRICE_VAT_SHOW_VALUE" => "Y",
		"TEMPLATE_THEME" => "site",
		"SET_TITLE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"OFFERS_PROPS" => array(
		),
		"COMPONENT_TEMPLATE" => "ajax",
		"USE_PREPAYMENT" => "N",
		"CORRECT_RATIO" => "N",
		"AUTO_CALCULATION" => "Y",
		"ACTION_VARIABLE" => "basketAction",
		"USE_GIFTS" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N"
	),
	false
);

//echo json_encode($arResult, JSON_UNESCAPED_UNICODE);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>