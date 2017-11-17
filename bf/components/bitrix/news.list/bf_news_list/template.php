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
?>				<?foreach($arResult["ITEMS"] as $arItem):?>
					<article>
                        <div class="title">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                <?=$arItem["NAME"]?>
                            </a>
                        </div>
                        <div class="date"><?=$arItem["TIMESTAMP_X"]?></div>
                        <div class="short">
                            <?=$arItem["PREVIEW_TEXT"]?>
                        </div>
                        <div class="photo">
                            <img src="<?=$arItem["PREVIEW_PICTURE_SRC"]?>" alt=""/>
                        </div>
                        <div class="details">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                Далее
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </article>
					<?endforeach;?>