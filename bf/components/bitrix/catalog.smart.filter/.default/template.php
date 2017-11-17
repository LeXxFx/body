<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$this->addExternalJS("/bitrix/templates/bf/js/filter.js");
?>
<?
//echo "<pre>";
//print_r($_GET);
//echo "</pre>";
?>
	<div class="widget widget-filters">
		<form name="<?=$arResult["FILTER_NAME"]."_form"?>" action="<?=$arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
			<?foreach($arResult["HIDDEN"] as $arItem):?>
				<input type="hidden" name="<?=$arItem["CONTROL_NAME"]?>" id="<?=$arItem["CONTROL_ID"]?>" value="<?=$arItem["HTML_VALUE"]?>" />
			<?endforeach;?>
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?if(empty($arItem["VALUES"])) continue;?>
				<div id="filters">
					<?if(!$arItem["PRICE"]):?>
						 <div class="filter-item">
							<div class="head">
								<span>
									<?=$arItem["NAME"]?><i class="icon icon-arrow-down-aside"></i>
                                </span>
								<a href="#" class="filter-item-clear">сбросить фильтр</a>
							</div>
							<div class="options-list options-inline">
								<div class="checkbox">
								<?foreach($arItem["VALUES"] as $arValue):?>
									<label id="<?=$arValue["CONTROL_NAME"]?>"><?//=$arValue["VALUE"]?>
									<input type="checkbox" style="display: none;" name="<?=$arValue["CONTROL_NAME"]?>" value="Y"<?if($arValue["CHECKED"]) echo " checked";?>>
										<span class="txt" id="<?=$arValue["CONTROL_NAME"]?>"><?=$arValue["VALUE"]?></span>
									</label>
								<?endforeach;?>
								</div>
							</div>
						</div>
						<?endif;?>
				</div>
				<div class="buttons-filter">
					<input type="hidden" class="save" name="set_filter" value="Показать">
					<!-- <input type="submit" class="reset" name="del_filter" value="Сбросить"> -->
				</div>
				<?endforeach;?>
		</form>
	</div>