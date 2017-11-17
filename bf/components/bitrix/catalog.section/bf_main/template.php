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
// echo "<pre>";
// print_r($APPLICATION->GetCurPageParam(true));
// echo "</pre>";
$this->addExternalJS("/bitrix/templates/bf/js/section.js");

?>
<?
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";?>
<?
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);
$skuTemplate = array();
if (!empty($arResult['SKU_PROPS']))
{
	foreach ($arResult['SKU_PROPS'] as $arProp)
	{
		$propId = $arProp['ID'];
		$skuTemplate[$propId] = array(
			'SCROLL' => array(
				'START' => '',
				'FINISH' => '',
			),
			'FULL' => array(
				'START' => '',
				'FINISH' => '',
			),
			'ITEMS' => array()
		);

		$templateRow = '';
		if ('TEXT' == $arProp['SHOW_MODE'])
		//if ('TSVET' != $arProp['CODE'])
		{
			$skuTemplate[$propId]['SCROLL']['START'] = '<div class="prop prop-size sku_prop clearfix" data-element-id="#ELEMENT_ID#" data-prop-id="'.$arProp['ID'].'" data-prop-code="'.$arProp["CODE"].'"><div class="name">'.htmlspecialcharsex($arProp['NAME']).': </div><div class="values">';
			$skuTemplate[$propId]['SCROLL']['FINISH'] = '</div></div>';

			$skuTemplate[$propId]['FULL']['START'] = '<div class="prop prop-size sku_prop clearfix" data-element-id="#ELEMENT_ID#" data-prop-id="'.$arProp['ID'].'" data-prop-code="'.$arProp["CODE"].'"><div class="name">'.htmlspecialcharsex($arProp['NAME']).': </div><div class="values">';
			$skuTemplate[$propId]['FULL']['FINISH'] = '</div></div>';				

			// $skuTemplate[$propId]['FULL']['START'] = '<div class="bx_item_detail_size" id="#ITEM#_prop_'.$propId.'_cont">'.
			// 	'<span class="bx_item_section_name_gray">'.htmlspecialcharsbx($arProp['NAME']).'</span>'.
			// 	'<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_'.$propId.'_list" style="width: #WIDTH#;">';;
			// $skuTemplate[$propId]['FULL']['FINISH'] = '</ul></div>'.
			// 	'<div class="bx_slide_left" id="#ITEM#_prop_'.$propId.'_left" data-treevalue="'.$propId.'" style="display: none;"></div>'.
			// 	'<div class="bx_slide_right" id="#ITEM#_prop_'.$propId.'_right" data-treevalue="'.$propId.'" style="display: none;"></div>'.
			// 	'</div></div>';
			foreach ($arProp['VALUES'] as $arOneValue)
			{
				$arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
				//$skuTemplate[$propId]['ITEMS'][$value['ID']] = '<li data-treevalue="'.$propId.'_'.$value['ID'].'" data-onevalue="'.$value['ID'].'" style="width: #WIDTH#;" title="'.$value['NAME'].'"><i></i><span class="cnt">'.$value['NAME'].'</span></li>';
				$skuTemplate[$propId]['ITEMS'][$arOneValue['ID']] = '<div class="value sku_prop_value" data-prop-maxcount="#MAX_QUANTITY#" data-value="'.$arOneValue["NAME"].'" data-value-id="'.$arOneValue['XML_ID'].'" data-treevalue="'.$arProp['ID'].'_'.$arOneValue['ID'].'" data-onevalue="'.$arOneValue['ID'].'"><span>'.$arOneValue['NAME'].'</span></div>';

			}
			unset($value);
		}
		elseif ('PICT' == $arProp['SHOW_MODE'])
		{
			$skuTemplate[$propId]['SCROLL']['START'] = '<div class="prop prop-color sku_prop clearfix" data-element-id="#ELEMENT_ID#" data-prop-id="'.$arProp['ID'].'" data-prop-code="'.$arProp["CODE"].'"><div class="name">'.htmlspecialcharsex($arProp['NAME']).': </div><div class="values">';
			$skuTemplate[$propId]['SCROLL']['FINISH'] = '</div></div>';
			$skuTemplate[$propId]['FULL']['START'] = '<div class="prop prop-color sku_prop clearfix" data-element-id="#ELEMENT_ID#" data-prop-id="'.$arProp['ID'].'" data-prop-code="'.$arProp["CODE"].'"><div class="name">'.htmlspecialcharsex($arProp['NAME']).': </div><div class="values">';
			$skuTemplate[$propId]['FULL']['FINISH'] = '</div></div>';				

			foreach ($arProp['VALUES'] as $arOneValue)
			{
				$arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
				$skuTemplate[$propId]['ITEMS'][$arOneValue['ID']] = '<div class="value sku_prop_value" data-prop-maxcount="#MAX_QUANTITY#" data-value="'.$arOneValue["NAME"].'" data-value-id="'.$arOneValue['XML_ID'].'" data-treevalue="'.$arOneValue['ID'].'" data-onevalue="'.$arOneValue['ID'].'" style="height: 40px;"><img width="40px" src="'.$arOneValue['PICT']['SRC'].'" alt="'.$arOneValue["NAME"].'" title="'.$arOneValue["NAME"].'" /></div>';
			}
			unset($value);
		}
	}
	unset($templateRow, $arProp);
}
if ($arParams["DISPLAY_TOP_PAGER"])
{
	?>
	<?
}

$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>
					<?
						$countItems = 0;
					?>
					<?
					foreach ($arResult['ITEMS'] as $key => $arItem)
					{
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
						$strMainID = $this->GetEditAreaId($arItem['ID']);

						$arItemIDs = array(
							'ID' => $strMainID,
							'PICT' => $strMainID.'_pict',
							'SECOND_PICT' => $strMainID.'_secondpict',
							'STICKER_ID' => $strMainID.'_sticker',
							'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
							'QUANTITY' => $strMainID.'_quantity',
							'QUANTITY_DOWN' => $strMainID.'_quant_down',
							'QUANTITY_UP' => $strMainID.'_quant_up',
							'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
							'BUY_LINK' => $strMainID.'_buy_link',
							'BASKET_ACTIONS' => $strMainID.'_basket_actions',
							'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
							'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
							'COMPARE_LINK' => $strMainID.'_compare_link',

							'PRICE' => $strMainID.'_price',
							'DSC_PERC' => $strMainID.'_dsc_perc',
							'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
							'PROP_DIV' => $strMainID.'_sku_tree',
							'PROP' => $strMainID.'_prop_',
							'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
							'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
						);

						$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

						$productTitle = (
							isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
							? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
							: $arItem['NAME']
						);
						$imgTitle = (
							isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
							? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
							: $arItem['NAME']
						);

						$minPrice = false;
						if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
							$minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);

						?>
					<article class="product-item has-timer product__item">
					<div class="item_<?=$arItem['ID']?>" id="product_container" data-block-type="catalog" data-id="<?=$arItem['ID']?>" data-tree='<?= json_encode($arItem['JS_OFFERS'])?>'>
						<div class="wrap">
							<div class="tags">
								<?if($arItem["PROPERTIES"]["M_LIDER"]["VALUE"] == 'Y'):?><p class="ribbon"><span class="ribbon ribbon-leader">Лидер продаж</span></p><?endif;?>
								<?if($arItem["PROPERTIES"]["M_NEW"]["VALUE"] == 'Y'):?><p class="ribbon"><span class="ribbon-new">Новинка</span></p><?endif;?>
								<?if($arItem["PROPERTIES"]["M_HIT"]["VALUE"] == 'Y'):?><p class="ribbon"><span class="ribbon-hit">Xит продаж</span></p><?endif;?>
								<?if($arItem["PROPERTIES"]["M_PRESENT"]["VALUE"]):?><p class="ribbon"><span class="ribbon-present">С подарком!</span></p><?endif;?>
								<?if($arItem["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"] >= 1):?><span class="percent">-<?=$arItem["MIN_BASIS_PRICE"]["DISCOUNT_DIFF_PERCENT"]?>%</span><?endif;?>
							</div>
							<div class="img">
								<div class="preview-gallery">
								<?//echo "<pre>";print_r($arItem);echo "</pre>";?>
									<figure class="img-item">
										<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt=""/>
									</figure>
								</div>
							</div>
							<div class="info">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
									<span class="name"><?=$arItem["NAME"]?></span>
									<span class="short">
										 <?=$arItem["PREVIEW_TEXT"]?>
									</span>
								</a>
								<div class="rate">
									<span class="stars star-4"></span>
								</div>
							</div>
							<div class="price item__price">
								<span class="new"><? echo round($arItem['MIN_PRICE']['DISCOUNT_VALUE'],0); ?> р.</span>
								<?if($arItem["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"] >= 1):?>
								<span class="old"><?=$arItem["MIN_PRICE"]["VALUE"]?> р.</span>
								<?endif;?>
							</div>
							<div class="baton">
								<button class="btn btn-add-to-cart addtobasket">Купить</button>
							</div>
							<?
							// зададим дату
							$dateAction = $arItem["PROPERTIES"]["ELEMENT_AKCIYA"]["VALUE"];
							$stmp = MakeTimeStamp($dateAction, "DD.MM.YYYY HH:MI:SS");
							$dateNow = $_SERVER['REQUEST_TIME'];
							if($dateNow <= $stmp):
							?>
							<?
							$dateOver = date('Y-m-d H:i', $stmp);
							$dateOver = str_replace(' ', 'T', $dateOver);?>
							<div class="akcia">
								<span>
									<i class="icon icon-timer"></i>
									до конца акции:</span>
								<div class="timer">
									<div class="soon"
										 data-due="<?=$dateOver?>"
										 data-layout="line"
										 data-format="d,h,m,s"
										 data-labels-days="день"
										 data-labels-hours=":"
										 data-labels-minutes=":"
										 data-labels-seconds=" ">
									</div>
								</div>
							</div>
							<?endif;?>
							<div class="product-options item__product-options sku_props">
								<?//print_r($skuTemplate);
	                                	$PropIndex = 0;
						                foreach ($skuTemplate as $propId => $propTemplate)
										{
											if (!isset($arItem['SKU_TREE_VALUES'][$propId]))
												continue;
											$valueCount = count($arItem['SKU_TREE_VALUES'][$propId]);
											if ($valueCount > 5)
											{
												$fullWidth = 'auto';
												$itemWidth = 'auto';
												$rowTemplate = $propTemplate['SCROLL'];
											}
											else
											{
												$fullWidth = 'auto';
												$itemWidth = 'auto';
												$rowTemplate = $propTemplate['FULL'];
											}
											unset($valueCount);
											echo '<div>', str_replace(array('#ITEM#_prop_', '#WIDTH#', '#ELEMENT_ID#'), array($arItemIDs['PROP'], 'auto', $arItem['ID']), $rowTemplate['START']);
											foreach ($propTemplate['ITEMS'] as $value => $valueItem)
											{
												if (!isset($arItem['SKU_TREE_VALUES'][$propId][$value]))
													continue;
												// echo str_replace(array('#ITEM#_prop_', '#WIDTH#', '#ELEMENT_ID#'), array($arItemIDs['PROP'], 'auto', $arItem['ID']), $valueItem);
												echo str_replace(array('#ITEM#_prop_', '#WIDTH#', '#ELEMENT_ID#', '#MAX_QUANTITY#'), array($arItemIDs['PROP'], 'auto', $arItem['ID'],trim($arItem['OFFERS'][$PropIndex]['CATALOG_QUANTITY'])), $valueItem);
												$PropIndex++;
//                                                                                        debug($valueItem);
											}
											unset($value, $valueItem);
											echo str_replace('#ITEM#_prop_', $arItemIDs['PROP'], $rowTemplate['FINISH']), '</div>';
										}
										unset($propId, $propTemplate);
										foreach ($arResult['SKU_PROPS'] as $arOneProp)
										{
											if (!isset($arItem['OFFERS_PROP'][$arOneProp['CODE']]))
												continue;
											$arSkuProps[] = array(
												'ID' => $arOneProp['ID'],
												'SHOW_MODE' => $arOneProp['SHOW_MODE'],
												'VALUES_COUNT' => $arOneProp['VALUES_COUNT']
											);
										}
										foreach ($arItem['JS_OFFERS'] as &$arOneJs)
										{
											if (0 < $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'])
											{
												$arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] = '-'.$arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'].'%';
												$arOneJs['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = '-'.$arOneJs['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'].'%';
											}
										}
										unset($arOneJs);
										?>
							</div>
						</div>
						</div>
					</article>
					<?}?>
<script>
(function($){
    if ($('#wrap-news').length && $('#wrap-news font.text').length) {
        $('#wrap-news').showMorePlugin({
            item: '.list',
            wrapNavigation: '.pagination',
            buttonClass: 'show-more',
            divButtonClass: 'div-show-more',
        });
    }
})(jQuery);
</script>