<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
//$arParams["USE_FILTER"] = 'Y';
$this->setFrameMode(true);
//$this->addExternalCss("/bitrix/css/main/bootstrap.css");
?>
<?
if (CModule::IncludeModule("iblock"))
{
    $arFilter = array(
        "ACTIVE" => "Y",
        "GLOBAL_ACTIVE" => "Y",
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    );
    if(strlen($arResult["VARIABLES"]["SECTION_CODE"])>0)
    {
        $arFilter["CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
    }
    elseif($arResult["VARIABLES"]["SECTION_ID"]>0)
    {
        $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
    }
        
    $obCache = new CPHPCache;
    if($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
    {
        $arCurSection = $obCache->GetVars();
    }
    else
    {
        $arCurSection = array();
        $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));
        $dbRes = new CIBlockResult($dbRes);

        if(defined("BX_COMP_MANAGED_CACHE"))
        {
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache("/iblock/catalog");

            if ($arCurSection = $dbRes->GetNext())
            {
                $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
            }
            $CACHE_MANAGER->EndTagCache();
        }
        else
        {
            if(!$arCurSection = $dbRes->GetNext())
                $arCurSection = array();
        }

        $obCache->EndDataCache($arCurSection);
    }
    ?>
	<?
	/*$APPLICATION->IncludeComponent(
			"bitrix:catalog.smart.filter",
			"",
			array(
				"IBLOCK_TYPE" => "1c_catalog",
				"IBLOCK_ID" => 4,
				"SECTION_ID" => $arCurSection["ID"],
				"FILTER_NAME" => "arrFilter",
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SAVE_IN_SESSION" => "N",
				"FILTER_VIEW_MODE" => "VERTICAL",
				"XML_EXPORT" => "Y",
				"SECTION_TITLE" => "NAME",
				"SECTION_DESCRIPTION" => "DESCRIPTION",
				'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
				"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
				'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID' => $arParams['CURRENCY_ID'],
				"SEF_MODE" => $arParams["SEF_MODE"],
				"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
				"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
				"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
			),
			$component,
			array('HIDE_ICONS' => 'Y')
		);*/?>
<?}?>
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
<?
//if ($isVerticalFilter)
	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_vertical.php");
//else
	//include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_horizontal.php");
?>