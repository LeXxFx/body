<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="slider">
<?foreach($arResult["ITEMS"] as $items):?>
    <a href="<?=$items["PROPERTIES"]["236"]["VALUE"]?>">
	<div class="slide">
		<img src="<?=$items["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$items["PROPERTIES"]["234"]["VALUE"]?>"/>
	</div>
	</a>
<?endforeach;?>
</div>


