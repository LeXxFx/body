<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
?>
<?
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";
?>
<?
if(isset($_GET['product'])){
	switch($_GET['product']){
		case 'new':
			$arrFilterCustom = "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"OR\",\"True\":\"True\"},\"CHILDREN\":{\"1\":{\"CLASS_ID\":\"CondIBProp:4:75\",\"DATA\":{\"logic\":\"Equal\",\"value\":22}}}}";
			break;
		case 'lider':
			$arrFilterCustom = "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"OR\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:4:74\",\"DATA\":{\"logic\":\"Equal\",\"value\":21}}]}";
			break;
		case 'sale':
			$arrFilterCustom = "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"OR\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:4:80\",\"DATA\":{\"logic\":\"Equal\",\"value\":25}},{\"CLASS_ID\":\"CondIBProp:4:76\",\"DATA\":{\"logic\":\"Equal\",\"value\":23}}]}";
			break;
	}
?>
<div id="wrapper" class="has-sidebar" role="main">
		<div class="inner">
			<div id="content" role="main">
			<?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				"bf",
				Array(
					"PATH" => "",
					"SITE_ID" => "s1",
					"START_FROM" => "0"
				)
				);?>
				<section class="products">
					<header class="title">
						<div class="name">
							Распродажа и товары дня
							<span class="lbl">скидки до 70%</span>
						</div>
					</header>
					<div class="panel-pager clearfix">
						<div class="col-md-7 col-sorting">
                            <div class="sorting">
                                <span>Сортировать по:</span>
                                <a href="?SECTION_ID=<?=$_GET['SECTION_ID']?>&order=price&sort=max">цене возр.</a> <span>|</span>
								<a href="?SECTION_ID=<?=$_GET['SECTION_ID']?>&order=price&sort=min">цене убыв.</a> <span>|</span>
                            </div>
                        </div>
                    </div>
					<div class="list clearfix">
					<?
if($_GET['order'] == 'price'){
	if($_GET["sort"] == "min"){
		$arParams["ELEMENT_SORT_FIELD"] = "property_MINIMUM_PRICE";
		$arParams["ELEMENT_SORT_ORDER"]= "desc";
		}
		if($_GET["sort"] == "max"){
			$arParams["ELEMENT_SORT_FIELD"] = "property_MAXIMUM_PRICE";
			$arParams["ELEMENT_SORT_ORDER"]= "asc";
			}
}elseif($_GET['order'] == 'action'){
	$arParams["ELEMENT_SORT_FIELD"] = "property_M_ACTION";
	$arParams["ELEMENT_SORT_ORDER"]= "desc";
}elseif($_GET['order'] == 'new'){
	$arParams["ELEMENT_SORT_FIELD"] = "created_date";
	$arParams["ELEMENT_SORT_ORDER"] = "desc";
}else{
	$arParams["ELEMENT_SORT_FIELD"] = "sort";
	$arParams["ELEMENT_SORT_ORDER"] = "asc";
}
?>
<?
	$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"bf_grid", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BRAND_PROPERTY" => "-",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"CUSTOM_FILTER" => $arrFilterCustom,
		"DATA_LAYER_NAME" => "dataLayer",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"ENLARGE_PROP" => "-",
		"FILTER_NAME" => "",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "1c_catalog",
		"INCLUDE_SUBSECTIONS" => "N",
		"LABEL_PROP" => array(
		),
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "top-left",
		"LAZY_LOAD" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => array(
			0 => "VES",
			1 => "DLINA",
			2 => "RAZMER",
			3 => "NAGRUZKA",
			4 => "TSVET",
			5 => "CML2_ARTICLE",
			6 => "CML2_BASE_UNIT",
			7 => "CML2_MANUFACTURER",
			8 => "CML2_TRAITS",
			9 => "ROST",
			10 => "CML2_TAXES",
			11 => "CML2_ATTRIBUTES",
			12 => "CML2_BAR_CODE",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "0",
		"OFFERS_PROPERTY_CODE" => array(
			0 => "VES",
			1 => "DLINA",
			2 => "RAZMER",
			3 => "NAGRUZKA",
			4 => "TSVET",
			5 => "CML2_ARTICLE",
			6 => "CML2_BASE_UNIT",
			7 => "MORE_PHOTO",
			8 => "CML2_MANUFACTURER",
			9 => "CML2_TRAITS",
			10 => "ROST",
			11 => "CML2_TAXES",
			12 => "FILES",
			13 => "CML2_ATTRIBUTES",
			14 => "CML2_BAR_CODE",
			15 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"OFFER_TREE_PROPS" => array(
			0 => "VES",
			1 => "RAZMER",
			2 => "DLINA",
			3 => "TSVET",
			4 => "NAGRUZKA",
			5 => "CML2_MANUFACTURER",
			6 => "ROST",
		),
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "99",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "Для сайта (САЙТ цена)",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE_MOBILE" => array(
		),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "N",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "",
		"USE_ENHANCED_ECOMMERCE" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "bf_grid",
		"DISPLAY_COMPARE" => "N"
	),
	false
);?>
		</div>
		<div id="sidebar">
                <aside>
                    <div class="catalog-list">
                        <?
if(preg_match("/\/store\/(?<section>[^\/]+)\//si",$_SERVER['REQUEST_URI'],$out))
{
	// $res = CIBlockSection::GetByID($_GET["GID"]);
	// if($ar_res = $res->GetNext())
	// $section_id=$ar_res['IBLOCK_SECTION_ID'];

	$res = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "CODE" => $out['section']), false, array('ID','IBLOCK_SECTION_ID'));
    if($ar_res = $res->GetNext())
		$section_id=$ar_res['ID'];

}else{
	$section_id='';
}
//echo $section_id;
?>

	 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"bf_subleft",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COUNT_ELEMENTS" => "Y",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "1c_catalog",
		"SECTION_CODE" => '',
		"SECTION_FIELDS" => array("",""),
		"SECTION_ID" => $section_id,
		"SECTION_URL" => "#SITE_DIR#/store/#SECTION_CODE#/",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "LIST",
		"USE_FILTER" => "Y",
		"FILTER_NAME" =>  $arParams["FILTER_NAME"],
		"FILTER_VIEW_MODE" => "VERTICAL",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PRICE_CODE" => array(
			0 => "Для сайта (САЙТ цена)",
		),
		"FILTER_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_OFFERS_PROPERTY_CODE" => array(
			0 => "VES",
			1 => "DLINA",
			2 => "DLINA_2",
			3 => "RAZMER",
			4 => "RAZMER_3",
			5 => "NAGRUZKA",
			6 => "ROST",
			7 => "TSVET",
			8 => "TSVET_1",
			9 => "TSVET_2",
			10 => "",
		),
	),
$component
);?>
                    </div>
                    <!--<div id="filters">
                        <div class="filter-item">
                            <div class="head">
                                <span>
                                    Размер
                                    <i class="icon icon-arrow-down-aside"></i>
                                </span>
                                <a href="#" class="filter-item-clear">сбросить фильтр</a>
                            </div>
                            <div class="options-list options-inline">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="txt">18</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="txt">25</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="txt">45</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="txt">55</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="txt">65</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="txt">75</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="head">
                                <span>
                                    Тип
                                    <i class="icon icon-arrow-down-aside"></i>
                                </span>
                                <a href="#" class="filter-item-clear">сбросить фильтр</a>
                            </div>
                            <div class="options-list">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="txt">Гимнастический</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="txt">Массажный</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="txt">С рожками</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span class="txt">Медбол</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-buttons">
                            <div class="row">
                                <div class="col-xs-6 col-sm-12 col-md-6">
                                    <a href="#" class="btn btn-filter-show">Показать</a>
                                </div>
                                <div class="col-xs-6 col-sm-12 col-md-6">
                                    <a href="#" class="btn btn-filter-cancel">Cбросить</a>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </aside>
            </div>
	</div>
</div>
<?}?>
<?
if ($arParams["USE_COMPARE"] === "Y"){
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	".default",
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
		"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
		"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
		"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
		"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
	),
	$component,
	array("HIDE_ICONS" => "Y")
);
}

if ($arParams["USE_COMPARE"] === "Y")
{
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.compare.list",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NAME" => $arParams["COMPARE_NAME"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
			"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action")."_ccl",
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			'POSITION_FIXED' => isset($arParams['COMPARE_POSITION_FIXED']) ? $arParams['COMPARE_POSITION_FIXED'] : '',
			'POSITION' => isset($arParams['COMPARE_POSITION']) ? $arParams['COMPARE_POSITION'] : ''
		),
		$component,
		array("HIDE_ICONS" => "Y")
	);
}

if ($arParams["SHOW_TOP_ELEMENTS"] !== "N")
{
	if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] === 'Y')
	{
		$basketAction = isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '';
	}
	else
	{
		$basketAction = isset($arParams['TOP_ADD_TO_BASKET_ACTION']) ? $arParams['TOP_ADD_TO_BASKET_ACTION'] : '';
	}

	$APPLICATION->IncludeComponent(
		"bitrix:catalog.top",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ELEMENT_SORT_FIELD" => $arParams["TOP_ELEMENT_SORT_FIELD"],
			"ELEMENT_SORT_ORDER" => $arParams["TOP_ELEMENT_SORT_ORDER"],
			"ELEMENT_SORT_FIELD2" => $arParams["TOP_ELEMENT_SORT_FIELD2"],
			"ELEMENT_SORT_ORDER2" => $arParams["TOP_ELEMENT_SORT_ORDER2"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
			"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
			"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
			"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
			"ELEMENT_COUNT" => $arParams["TOP_ELEMENT_COUNT"],
			"LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
			"PROPERTY_CODE" => $arParams["TOP_PROPERTY_CODE"],
			"PROPERTY_CODE_MOBILE" => $arParams["TOP_PROPERTY_CODE_MOBILE"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
			"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
			"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
			"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
			"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
			"OFFERS_FIELD_CODE" => $arParams["TOP_OFFERS_FIELD_CODE"],
			"OFFERS_PROPERTY_CODE" => $arParams["TOP_OFFERS_PROPERTY_CODE"],
			"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
			"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
			"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
			"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
			"OFFERS_LIMIT" => $arParams["TOP_OFFERS_LIMIT"],
			'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			'CURRENCY_ID' => $arParams['CURRENCY_ID'],
			'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
			'VIEW_MODE' => (isset($arParams['TOP_VIEW_MODE']) ? $arParams['TOP_VIEW_MODE'] : ''),
			'ROTATE_TIMER' => (isset($arParams['TOP_ROTATE_TIMER']) ? $arParams['TOP_ROTATE_TIMER'] : ''),
			'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),

			'LABEL_PROP' => $arParams['LABEL_PROP'],
			'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
			'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
			'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
			'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
			'PRODUCT_BLOCKS_ORDER' => $arParams['TOP_PRODUCT_BLOCKS_ORDER'],
			'PRODUCT_ROW_VARIANTS' => $arParams['TOP_PRODUCT_ROW_VARIANTS'],
			'ENLARGE_PRODUCT' => $arParams['TOP_ENLARGE_PRODUCT'],
			'ENLARGE_PROP' => isset($arParams['TOP_ENLARGE_PROP']) ? $arParams['TOP_ENLARGE_PROP'] : '',
			'SHOW_SLIDER' => $arParams['TOP_SHOW_SLIDER'],
			'SLIDER_INTERVAL' => isset($arParams['TOP_SLIDER_INTERVAL']) ? $arParams['TOP_SLIDER_INTERVAL'] : '',
			'SLIDER_PROGRESS' => isset($arParams['TOP_SLIDER_PROGRESS']) ? $arParams['TOP_SLIDER_PROGRESS'] : '',

			'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
			'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
			'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
			'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
			'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
			'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
			'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
			'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
			'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'],
			'ADD_TO_BASKET_ACTION' => $basketAction,
			'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
			'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],

			'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : '')
		),
		$component
	);
	unset($basketAction);
}?>