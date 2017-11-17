<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav id="navi">
<ul>

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>
<?
	$strImg = '';
	if(intval($items["PARAMS"]["PICTURE"])>0 && $items["DEPTH_LEVEL"]==1){
		$img = CFile::GetPath($items["PARAMS"]["PICTURE"]); 
		$strImg = '<img alt="" src="'.$img.'" />';
	}
	echo $strImg;
?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li><a href="<?=$arItem["LINK"]?>">
			<div class="navi-icon">
                                <?=$strImg?>
                            </div>
			<span><?=$arItem["TEXT"]?></span></a>
				<div class="dropdown-menu">
				<div class="img">
                                <img src="demo/product_img1.png" alt=""/>
                            </div>
				<ul>
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="простой">
				<a href="<?=$arItem["LINK"]?>">
				<div class="navi-icon">
                                <img class="svg" src="demo/icons/3.svg" alt=""/>
                            </div>
				<span><?=$arItem["TEXT"]?></span></a></li>
			<?else:?>
				<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href=""title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<div class="menu-clear-left"></div>
<?endif;?>
</nav>