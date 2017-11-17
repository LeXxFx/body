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
?>
						<div class="title">
                            <?=$arResult["NAME"]?>
                        </div>
						<?foreach ($arResult["ITEMS"] as $arItem):?>
                        <article class="item">
                            <div class="top">
                                <span><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span> <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                            </div>
                            <div class="img">
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="demo/img1.jpg" alt=""/></a>
                            </div>
                            <div class="short">
                                <?=$arItem["PREVIEW_TEXT"]."..."?><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="link-more">Далее</a>
                            </div>
                        </article>
						<?endforeach;?>
                        <div class="bot">
                            <a href="/news/" class="btn">Читать всё</a>
                        </div>