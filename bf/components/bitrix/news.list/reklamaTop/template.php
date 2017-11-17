<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["ITEMS"] as $items):?>
	<a href="<?=$items["PROPERTIES"]["SLIDER_LINK"]["VALUE"]?>">
		<img src="<?=$items["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$items["PROPERTIES"]["SLIDER_VALUE"]["VALUE"]?>"/>
	</a>
<?endforeach;?>


