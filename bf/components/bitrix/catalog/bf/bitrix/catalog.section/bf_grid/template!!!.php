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

//$this->addExternalJS("/bitrix/templates/bf/js/other.js");
?>
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
		//echo "<pre>";
		//print_r($arProp);
		//echo "</pre>";

		$templateRow = '';
		//if ('TEXT' == $arProp['SHOW_MODE'])
		if ('TSVET' != $arProp['CODE'])
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
		else //('PICT' == $arProp['SHOW_MODE'])
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
	?><?// echo $arResult["NAV_STRING"]; ?><?
}

$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>
	<div id="wrapper" class="has-sidebar" role="main">
        <div class="inner">
            <div id="content" role="main">
                <div id="breadcumbs">
                    <a href="#">Главная</a><span class="sep">/</span><span class="current">Мячи фитболы</span>
                </div>
                <section class="products">
                    <header class="title">
                        <div class="name">
                            Мячи фитболы
                            <span class="lbl">скидки до 70%</span>
                        </div>
                    </header>
                    <div class="panel-pager clearfix">
                        <div class="col-md-7 col-sorting">
                            <div class="sorting">
                                <span>Сортировать по:</span>
                                <a href="#" class="active">цене</a> <span>|</span>
                                <a href="#">популярности</a> <span>|</span>
                                <a href="#">акциям</a> <span>|</span>
                                <a href="#">новинкам</a>
                            </div>
                        </div>
                        <div class="col-md-5 col-show-count">
                            <div class="show-count">
                                <span>Показывать по:</span>
                                <a href="#" class="active">24</a> <span>|</span>
                                <a href="#">48</a> <span>|</span>
                                <a href="#">96</a> <span>|</span>
                                <a href="#">Все</a>
                            </div>
                        </div>
                    </div>
                    <div class="list clearfix">
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

						?><?//echo "<pre>";print_r($arItem);echo "</pre>";?>
					<article class="product-item has-timer">
					<div class="item_<?=$arItem['ID']?>" id="product_container" data-block-type="catalog" data-id="<?=$arItem['ID']?>" data-tree='<?= json_encode($arItem['JS_OFFERS'])?>'>
						<div class="wrap">
							<div class="tags">
								<p class="ribbon"><span class="ribbon-present">С подарком!</span></p>
								<span class="percent">-20%</span>
							</div>
							<div class="img">
								<div class="preview-gallery">
									<figure class="img-item">
										<img src="<?=SITE_TEMPLATE_PATH?>/demo/product_img1.png" alt=""/>
									</figure>
									<figure class="img-item">
										<img src="<?=SITE_TEMPLATE_PATH?>/demo/product_img2.png" alt=""/>
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
							<div class="price">
								<span class="new"><? echo round($arItem['MIN_PRICE']['DISCOUNT_VALUE'],0); ?> р.</span>
								<?if($arItem["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"] >= 1):?>
								<span class="old"><?=$arItem["MIN_PRICE"]["VALUE"]?> р.</span>
								<?endif;?>
							</div>
							<div class="baton">
								<button class="btn btn-add-to-cart">Купить</button>
							</div>
							<div class="akcia">
								<span>
									<i class="icon icon-timer"></i>
									до конца акции:</span>
								<div class="timer">
									<div class="soon"
										 data-due="2016-10-17T22:05"
										 data-layout="line"
										 data-format="d,h,m,s"
										 data-labels-days="день"
										 data-labels-hours=":"
										 data-labels-minutes=":"
										 data-labels-seconds=" ">
									</div>
								</div>
							</div>
							<div class="product-options item__product-options sku_props">
							<?
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
					<?if($countItems == 2):?>
					<div class="divider"></div>
					<?$countItems = 0;?>
					<?else:?>
					<?$countItems++;?>
					<?endif;?>
					<?
					}
					?>
                    </div>
                </section>
                <div class="panel-pager clearfix">
                    <div class="col-sm-3 col-pagination">
                        <div class="pagination">
                            <a href="#" class="active">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                        </div>
                    </div>
                    <div class="col-sm-4 col-load">
                        <button class="btn btn-show-load">Показать еще</button>
                    </div>
                    <div class="col-md-5 col-show-count hidden-sm hidden-xs">
                        <div class="show-count">
                            <span>Показывать по:</span>
                            <a href="#" class="active">24</a> <span>|</span>
                            <a href="#">48</a> <span>|</span>
                            <a href="#">96</a> <span>|</span>
                            <a href="#">Все</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sidebar">
                <aside>
                    <div class="catalog-list">
                        <div class="head">
                            <span>
                                Мячи фитболы
                                <i class="icon icon-arrow-down-aside"></i>
                            </span>
                        </div>
                        <ul>
                            <li>
                                <a href="#">
                                    Фитболы
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Мячи-прыгуны
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Мячи медицинские
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div id="filters">
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
                    </div>
                </aside>
            </div>
        </div>
	</div>
	<div class="container">
        <section id="description">
            <div class="post">
                <h1>Подбираете фитбол и не знаете на чем остановиться? H1</h1>
                <img src="<?=SITE_TEMPLATE_PATH?>/demo/img1.jpg" alt="" style="float: left; margin: 0 10px 10px 0"/>
                <h2>Основные типы фитболов H2</h2>
                <ul>
                    <li>обычный надувной, идеально подходит для щадящих детских домашних тренировок и начинающим;</li>
                    <li>массажный <a href="#">мяч для фитнеса</a> с шипами – способствует улучшению кровообращения и снятию усталости;</li>
                    <li>спортивный гимнастический мячик-попрыгун для спины и улучшения осанки.</li>
                </ul>
                <h3>Как купить H3</h3>
                <p>Некоторые представленные в каталоге интернет-магазина товары можно купить в Москве с различными держателями, в виде рожек или скоб. Эти недорогие по цене модели также подойдут для неопытных пользователей, детей и беременных женщин, чтобы добиться более уверенной фиксации на фитболе.</p>
                <div id="fullstory" class="collapse clearfix">
                    <p>Некоторые представленные в каталоге интернет-магазина товары можно купить в Москве с различными держателями, в виде рожек или скоб. Эти недорогие по цене модели также подойдут для неопытных пользователей, детей и беременных женщин, чтобы добиться более уверенной фиксации на фитболе.</p>
                </div>
            </div>
            <div class="show_more">
                <button class="btn collapsed" data-toggle="collapse" data-target="#fullstory"><span>Подробнее</span> <i class="icon icon-arrow-down-min"></i></button>
            </div>
        </section>