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

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BASIS_PRICE' => $strMainID.'_basis_price',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'BASKET_ACTIONS' => $strMainID.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
	'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);

reset($arResult['MORE_PHOTO']);
$arFirstPhoto = current($arResult['MORE_PHOTO']);

// $arOffs=array();
// foreach ($arResult['OFFERS'] as $arsku){
//	   foreach( $arsku['DISPLAY_PROPERTIES'] as $key => $val){
//		   $arOff['ID']=$val['ID'];
//		   $arOff['VALUE']=$val['DISPLAY_VALUE'];
//		   $arOffs[$key]['ITEMS'][]=$arOff;
//		   $arOffs[$key]['NAME']=$val['NAME'];
//	   }
// }

// $this->addExternalJS("/bitrix/templates/sp07restail/js/basket.js");
$this->addExternalJS("/bitrix/templates/bf/js/element.js");
$this->addExternalCSS("/bitrix/templates/bf/assets/plugins/magiczoomplus/magiczoomplus.css");
$this->addExternalJS("/bitrix/templates/bf/assets/plugins/magiczoomplus/magiczoomplus.js");
?>
<?
	$valueDate = $arResult["PROPERTIES"]["DATE_TO_OFFER"]["VALUE"];
	$date = date("Y-m-d", strtotime($valueDate));
	$str = $arResult["PROPERTIES"]["DATE_TO_OFFER"]["VALUE"];
	$result = substr(strstr($str, ' '), 1, strlen($str));
	$time = mb_strimwidth($result, 0, 5);
?>
<?
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";
?>
<div class="item_<?=$arResult['ID']?>" id="product_container" data-id="<?=$arResult['ID']?>" data-tree='<?= json_encode($arResult['JS_OFFERS'])?>'>
<div class="title"><h1 class="name"><?=$arResult["NAME"]?></h1></div>
				<div class="row-content">
					<div class="col-price">
						<div class="panel">
							<div class="panel-top">
								<?if(!isset($arResult["OFFERS"]) || empty($arResult["OFFERS"])):?>
								<?if($arResult["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"] >= 1):?>
								<span class="discount">-<?=$arResult["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"]?>%</span>
								<?endif;?>
								<div class="price">
									<?if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]):?>
									<span class="new"><?=$arResult["MIN_PRICE"]["DISCOUNT_VALUE"]?> р.</span>
									<span class="old"><?=$arResult["MIN_PRICE"]["VALUE"]?> р.</span>
									<?else:?>
									<span class="new"><?=$arResult["MIN_PRICE"]["VALUE"]?> р.</span>
									<?endif;?>
								</div>
								<?else:?>
								<?
								$minPrice = 999999;
								foreach($arResult["OFFERS"] as $offerMinPrice){
									if($minPrice >= $offerMinPrice["MIN_PRICE"]["VALUE"]){
										$minPrice = $offerMinPrice["MIN_PRICE"]["VALUE"];
										$minDiscount = $offerMinPrice["MIN_PRICE"]["DISCOUNT_VALUE"];
										$minDiscountPercent = $offerMinPrice["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"];
									}
								}?>
								<?if($minDiscountPercent >= 1):?>
								<span class="discount">-<?=$minDiscountPercent?>%</span>
								<?endif;?>
								<div class="price">
									<?if($minPrice > $minDiscount):?>
									<span class="new"><?=$minDiscount?> р.</span>
									<span class="old"><?=$minPrice?> р.</span>
									<?else:?>
									<span class="new"><?=$minPrice?> р.</span>
									<?endif;?>
								</div>
								<?endif;?>
								<?
								// зададим дату
								$dateAction = $arResult["PROPERTIES"]["ELEMENT_AKCIYA"]["VALUE"];
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
								<div class="btns">
									<button data-dismiss="modal" data-toggle="modal" data-target="#buy_product" class="btn btn-add-to-cart addtobasket" data-amount="1" data-id="<?=$arResult["ID"]?>" data-price-id="<?=$arResult['OFFERS'][0]['CATALOG_PRICE_ID_2'];?>">Купить</button>
									<button data-dismiss="modal" data-toggle="modal" data-target="#modal_buy_one_click" class="btn btn-buy-one-click">Купить в 1 клик</button>
								</div>
							</div>
							<ul class="delivary">
								<li class="item-1">Доставка по России без предоплаты. </li>
								<li class="item-2">250 пунктов самовывоза по всей России</li>
								<li class="item-3">Подарочная карта со скидкой 10% для следующих покупок.</li>
								<li class="item-4">Безопасность платежей на сайте гарантируется использованием SSL протокола</li>
							</ul>
						</div>
					</div><?//echo "<pre>";print_r($arResult);echo "</pre>";?>
					<div class="col-main">
						<div class="row-main">
							<div class="col-photo">
								<div id="product-gallery" class="gallery">
									<div class="tags">
										<?if($arResult["PROPERTIES"]["M_LIDER"]["VALUE"] == 'Y'):?><p class="ribbon"><span class="ribbon ribbon-leader">Лидер продаж</span></p><?endif;?>
										<?if($arResult["PROPERTIES"]["M_NEW"]["VALUE"] == 'Y'):?><p class="ribbon"><span class="ribbon-new">Новинка</span></p><?endif;?>
										<?if($arResult["PROPERTIES"]["M_HIT"]["VALUE"] == 'Y'):?><p class="ribbon"><span class="ribbon-hit">Xит продаж</span></p><?endif;?>
										<?if($arResult["PROPERTIES"]["M_PRESENT"]["VALUE"] == 'Y'):?><p class="ribbon"><span class="ribbon-present">С подарком!</span></p><?endif;?>
										<?if($arResult["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"] >= 1):?><span class="percent">-<?=$arResult["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"]?>%</span><?endif;?>
										<div class="rate">
											<!--<span class="stars star-4"></span>-->
											<?$APPLICATION->IncludeComponent(
									   "bitrix:iblock.vote",
									   "stars",
									   Array(
										  "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
										  "IBLOCK_ID" => $arParams["IBLOCK_ID"],
										  "ELEMENT_ID" => $arResult["ID"],
										  "MAX_VOTE" => $arParams["MAX_VOTE"],
										  "VOTE_NAMES" => $arParams["VOTE_NAMES"],
										  "CACHE_TYPE" => $arParams["CACHE_TYPE"],
										  "CACHE_TIME" => $arParams["CACHE_TIME"],
									   ),
									   $component
									);?>
										</div>
									</div>
									<div class="player init">
										<?if(count($arResult['OFFERS'])>0):?>
												<a id="gallery" href="<? echo $arResult['MORE_PHOTO'][0]['SRC']; ?>" class="MagicZoomPlus" rel="preload-selectors-small:false;preload-selectors-big:false;initialize-on:mouseover;smoothing-speed:70;fps:40;selectors-effect:false;show-title:false;loading-msg:Загрузка...;background-opacity:10;zoom-width:420;zoom-height:420;zoom-distance:5;hint-text:;selectors-class:current;buttons:hide;caption-source:span;">
													<img src="<? echo $arResult['MORE_PHOTO'][0]['SRC']; ?>" alt=""/>
												</a>
											<?else:?>
												<a id="gallery" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="MagicZoomPlus" rel="preload-selectors-small:false;preload-selectors-big:false;initialize-on:mouseover;smoothing-speed:70;fps:40;selectors-effect:false;show-title:false;loading-msg:Загрузка...;background-opacity:10;zoom-width:420;zoom-height:420;zoom-distance:5;hint-text:;selectors-class:current;buttons:hide;caption-source:span;">
													<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt=""/>
												</a>
											<?endif;?>
									</div>
									<ul class="switcher clearfix">
												<? 
												foreach ($arResult['MORE_PHOTO'] as &$arOnePhoto)
												{?>
										<li>
											<a title="" data-source="image" href="<?=$arOnePhoto["SRC"]?>">
												<img src="<?=$arOnePhoto["SRC"]?>" alt="foto desc 2" />
											</a>
										</li>
												<?
												}
												unset($arOnePhoto);
												?>
										<!--<li>
											<a title="" data-source="image" href="<?=SITE_TEMPLATE_PATH?>/demo/product_img5.jpg">
												<img src="<?=SITE_TEMPLATE_PATH?>/demo/product_img5-1.jpg" alt="foto desc 2" />
											</a>
										</li>
										<li class="active">
											<a title="" data-source="youtube" href="https://www.youtube.com/embed/NqYHnX0ybHI">
												<img src="<?=SITE_TEMPLATE_PATH?>/demo/product_img1.png" alt="foto desc 1" />
												<i class="icon icon-video"></i>
											</a>
										</li>
										<li>
											<a title="" data-source="image" href="<?=SITE_TEMPLATE_PATH?>/demo/product_img6.png">
												<img src="<?=SITE_TEMPLATE_PATH?>/demo/product_img6-1.png" alt="foto desc 3" />
											</a>
										</li>-->
									</ul>
								</div>
							</div>
							<div class="col-info">
							<? //												 print_r($arResult);
								if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']) && !empty($arResult['OFFERS_PROP']))
								{
									$productType = 1;
									$arSkuProps = array();
								?>
								<div class="item__product-options sku_props product-options" id="<? echo $arItemIDs['PROP_DIV']; ?>">
									<?
										foreach ($arResult['SKU_PROPS'] as &$arProp)
										{
											if (!isset($arResult['OFFERS_PROP'][$arProp['CODE']]))
												continue;
											$arSkuProps[] = array(
												'ID' => $arProp['ID'],
												'SHOW_MODE' => $arProp['SHOW_MODE'],
												'VALUES_COUNT' => $arProp['VALUES_COUNT']
											);
											unset($arProp['VALUES'][0]);
											//echo "<pre>";print_r($arProp);echo "</pre>";
											if ('TEXT' == $arProp['SHOW_MODE'])
											{?><?//echo "<pre>";print_r($arProp);echo "</pre>";?>
												<div class="prop prop-size sku_prop clearfix" data-element-id="<?=$arResult['ID']?>" data-prop-id="<? echo $arProp['ID']?>" data-prop-code="<?=$arProp["CODE"]?>">
													<div class="col-md-5">
													<div class="name">Выберите <? echo htmlspecialcharsex($arProp['NAME']); ?>: </div>
													</div>
													<div class="col-md-7">
														<div class="values">
														<? $index=0; ?>
															<?foreach ($arProp['VALUES'] as $arOneValue){
																$arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);?>
																				<?$curOffer = '';
																				foreach($arResult["OFFERS"] as $offer){
																					if($offer["PROPERTIES"][$arProp["CODE"]]["VALUE"] == $arOneValue['XML_ID']){
																						$curOffer = $offer;
																					}
																				}?>
																<div class="value sku_prop_value" data-product-id="<?=$curOffer["ID"]?>" data-prop-maxcount="<?=$arResult['JS_OFFERS'][$index]['MAX_QUANTITY']?>" data-value="<?=$arOneValue["NAME"]?>" data-value-id="<? echo $arOneValue['XML_ID']; ?>" data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID']; ?>" data-onevalue="<? echo $arOneValue['ID']; ?>">
																	<span id="<?=$curOffer["ID"]?>"><? echo $arOneValue['NAME']; ?></span>
																</div>
																<?$index++;?>
															<?}?>
														</div>
													</div>
												</div>
											<?}
											elseif ('PICT' == $arProp['SHOW_MODE'])
											{?>
											<div class="prop prop-color sku_prop clearfix row" data-element-id="<?=$arResult['ID']?>" data-prop-id="<? echo $arProp['ID']?>" data-prop-code="<?=$arProp["CODE"]?>">
												<div class="col-md-5">
													<div class="name">Выберите <? echo htmlspecialcharsex($arProp['NAME']); ?>: </div>
												</div>
												<div class="col-md-7">
													<div class="values">
															<? $index=0; ?>
														<?foreach ($arProp['VALUES'] as $arOneValue){
															$arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);?>
															<?$curOffer = '';
																foreach($arResult["OFFERS"] as $offer){
																if($offer["PROPERTIES"][$arProp["CODE"]]["VALUE"] == $arOneValue['XML_ID']){
																$curOffer = $offer;
																	}
															}?>
															<div class="value sku_prop_value" data-product-id="<?=$curOffer["ID"]?>" data-prop-maxcount="<?=$arResult['JS_OFFERS'][$index]['MAX_QUANTITY']?>" data-value="<?=$arOneValue["NAME"]?>" data-value-id="<? echo $arOneValue['XML_ID']; ?>" data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID']; ?>" data-onevalue="<? echo $arOneValue['ID']; ?>">
																<span id="<?=$curOffer["ID"]?>">
																<img src="<? echo $arOneValue['PICT']['SRC']; ?>" alt="<? echo $arOneValue['NAME']; ?>" title="<? echo $arOneValue['NAME']; ?>" height="15px" width="15px" />
																</span>
															</div>
															<?$index++;?>
														<?}?>
													</div>
												</div>
											</div>
									<!-- 
										<div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_cont">
											<span class="bx_item_section_name_gray"></span>
											<div class="bx_scu_scroller_container">
												<div class="bx_scu">
													<ul id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;margin-left:0%;">
														<?
														foreach ($arProp['VALUES'] as $arOneValue)
														{
															$arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
															?>
															<li data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID'] ?>" data-onevalue="<? echo $arOneValue['ID']; ?>" style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>; display: none;" >
																<i title="<? echo $arOneValue['NAME']; ?>"></i>
																<span class="cnt"><span class="cnt_item" style="background-image:url('');" title="<? echo $arOneValue['NAME']; ?>"></span></span>
															</li>
															<?
														}
														?>
													</ul>
												</div>
												<div class="bx_slide_left" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
												<div class="bx_slide_right" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>
											</div>
										</div> -->
									<?
											}
										}
										unset($arProp);
									?>
									</div>
									<?
									}else{
										$productType = 0;
									}
									?>
								<!--<div class="product-options">
									<div class="row prop prop-color">
										<div class="col-md-5">
											<div class="name">Выберите цвет:</div>
										</div>
										<div class="col-md-7">
											<div class="values">
												<div class="value">
													<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/color_green.png" alt=""/>
												</div>
												<div class="value active">
													<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/color_grey.png" alt=""/>
												</div>
												<div class="value">
													<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/color_blue.png" alt=""/>
												</div>
												<div class="value">
													<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/color_yellow_brown.png" alt=""/>
												</div>
											</div>
										</div>
									</div>
									<div class="row prop prop-color">
										<div class="col-md-5">
											<div class="name">Выберите размер:</div>
										</div>
										<div class="col-md-7">
											<div class="values">
												<select class="form-control">
													<option value="">Выбрать</option>
													<option value="">25</option>
													<option value="">40</option>
													<option value="">50</option>
													<option value="">60</option>
												</select>
											</div>
										</div>
									</div>
								</div>-->
								<?
								//echo "<pre>";
								//print_r($arResult);
								//echo "</pre>";
								?>
								<div class="product-post">
									<div class="post">
										<?=$arResult["DETAIL_TEXT"]?>
									</div>
									<!--<div class="post">
										Мяч-попрыгунчик снабжен ручками-рожками, за которые удобно держаться во время прыжков. Ребенок садится верхом на мяч, держится за ручки-рожки и прыгает, отталкиваясь ногами от пола. Мяч с рожками отлично подходит для активных игр и занятий лечебной физкультурой, помогает формировать правильную осанку...
										<div id="fullstory" class="collapse clearfix">
											<p>Некоторые представленные в каталоге интернет-магазина товары можно купить в Москве с различными держателями, в виде рожек или скоб. Эти недорогие по цене модели также подойдут для неопытных пользователей, детей и беременных женщин, чтобы добиться более уверенной фиксации на фитболе.</p>
										</div>
									</div>
									<div class="show_more">
										<button class="btn collapsed" data-toggle="collapse" data-target="#fullstory"><span>Подробнее</span> <i class="icon icon-arrow-down-min"></i></button>
									</div>-->
								</div>
								<div class="product-info-tabs">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab_dalivary" data-toggle="tab">Доставка и оплата</a></li>
										<li><a href="#tab_attributes" data-toggle="tab">характеристики</a></li>
									</ul>
									<div class="tab-content">
										<div  id="tab_dalivary" class="tab-pane active">
											<div class="top">
												Доставка в
												<div class="dropdown">
													<button class="dropdown-toggle" type="button" id="routefrom2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<span>г. Москва?</span>
													</button>
													<div class="dropdown-menu" aria-labelledby="routefrom2">
														<a class="dropdown-item" href="#">Санкт-Петербург</a>
														<a class="dropdown-item" href="#">Таганрог</a>
														<a class="dropdown-item" href="#">Нижний Новгород</a>
													</div>
												</div>
											</div>
											<ul>
												<li>
													<p><b>Курьерская доставка:</b></p>
													260 р. 26.07.2016 за час позвоним.</li>
												<li>
													<p><b>Самовывоз:</b></p>
													126 р. Доставка до пункта самовывоза 1-2 рабочих дня. Посмотреть <a href="#">пункты выдачи.</a></li>
												<li>
												<p><b>Бесплатно:</b></p>
												Самовывоз по адресу г. Москва, ул. Дубнинская, д. 10, корп. 1 (с пн - по пт с 9.00 до 18.00)</li>
											</ul>
											<div class="bot">
												Подробнее в разделе <a href="#">Доставка.</a>
											</div>
										</div>
										<div  id="tab_attributes" class="tab-pane">
											Характеристики
										</div>
									</div>
								</div>
								<div class="payments">
									<div class="heading">
										Способы оплаты
									</div>
									<ul class="list-payments">
										<li><a href="#"><span><i class="icon icon-payment-nal"></i></span>
											Наличные деньги</a></li>
										<li><a href="#"><span><i class="icon icon-payment-kiwi"></i></span>
											Из кошелька Киви</a></li>
										<li><a href="#"><span><i class="icon icon-payment-sb"></i></span>
											Сбербанк Онлайн</a></li>
										<li><a href="#"><span><i class="icon icon-payment-wm"></i></span>
											Из кошелька Webmoney</a></li>
										<li><a href="#"><span><i class="icon icon-payment-card"></i></span>
											Банковские карты</a></li>
									</ul>
									<div class="bot">
										Подробнее в разделе <a href="#">Оплата.</a>
									</div>
								</div>
							</div>
						</div>
						<!--<section class="user-activity">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_reviews" data-toggle="tab">Отзывы о товаре <span>(5)</span></a></li>
								<li><a href="#tab_quest" data-toggle="tab">Вопросы <span>(0)</span></a></li>
							</ul>
							<div class="tab-content">
								<div  id="tab_reviews" class="tab-pane active">
									<div class="product-reviews">
										<div class="reviews-list">
											<article>
												<div class="top">
													<span class="name">Светлана Махмудова</span> <span class="date">(3 недели назад)</span>
													<div class="rate">
														<span class="stars star-4"></span>
													</div>
												</div>
												<p>Мяч классный! Качество супер.Очень удобный, легкий.	Взяла 65 см	 очень нравится.  Я очень довольна. Доставка на 5+. Спасибо Bodyform за скидку.</p>
											</article>
											<article>
												<div class="top">
													<span class="name">Ирина</span> <span class="date">(месяц назад)</span>
													<div class="rate">
														<span class="stars star-5"></span>
													</div>
												</div>
												<p>Впечатление с непривычки: легкий, скрипит по ковролину, паркету и плитке. Надеюсь, что через время станет удобнее и привычнее.</p>
											</article>
										</div>
										<div class="panel-pager clearfix">
											<div class="col-sm-6 col-pagination">
												<div class="pagination">
													<a href="#" class="active">1</a>
													<a href="#">2</a>
													<a href="#">3</a>
												</div>
											</div>
											<div class="col-sm-6 col-button">
												<button class="btn btn-add-review" data-dismiss="modal" data-toggle="modal" data-target="#modal_add_review">оставить свой</button>
											</div>
										</div>
									</div>
								</div>
								<div  id="tab_quest" class="tab-pane">

								</div>
							</div>
						</section>-->
					</div>
				</div>
				<script type="text/javascript">
var viewedCounter = {
    path: '/bitrix/components/bitrix/catalog.element/ajax.php',
    params: {
        AJAX: 'Y',
        SITE_ID: "<?= SITE_ID ?>",
        PRODUCT_ID: "<?= $arResult['ID'] ?>",
        PARENT_ID: "<?= $arResult['ID'] ?>"
    }
};
BX.ready(
    BX.defer(function(){
        BX.ajax.post(
            viewedCounter.path,
            viewedCounter.params
        );
    })
);
</script>