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
$this->setFrameMode(true);
//CUtil::InitJSCore(array('fx'));
//echo "<pre>";print_r($arResult);echo "</pre>";
?>
                <div class="post-content">
                    <h1><?=$arResult["NAME"]?></h1>
                    <div class="date"><?=$arResult["TIMESTAMP_X"]?></div>
                    <div class="post">
                        <p><?=$arResult["DETAIL_TEXT"]?></p>
                        <img src="<?=$arResult["DETAIL_PICTURE_SRC"]?>" alt=""/>
                    </div>
                </div>