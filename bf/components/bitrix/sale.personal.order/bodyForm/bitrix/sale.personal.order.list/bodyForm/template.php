<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;?>
<div id="wrapper" role="main">
        <div class="container">
            <div id="breadcumbs">
                <a href="#">Главная</a><span class="sep">/</span> <span class="current">Личный кабинет</span>
            </div>
            <div id="account">
                <ul class="nav nav-tabs">
                    <li><a href="/personal/profile/"><span>Личные даные</span></a></li>
                    <li class="active"><a href="cabinet-history.html"><span>История заказов</span></a></li>
                </ul>
                <div class="account-history row">
                    <div class="col-sm-12">
                        <div id="history">
									<?
									//echo "<pre>";
									//print_r($arResult);
									//echo "</pre>";
									?>
							<?foreach ($arResult["ORDERS"] as $order):?>
                            <?
							//echo "<pre>";
							//print_r($order);
							//echo "</pre>";
							?>
							<div class="item">
                                <div class="panel">
                                    <div class="row">
                                        <div class="col-md-6 col-number">
                                            <a data-toggle="collapse" data-parent="#history" href="#zakaz-<?=$order["ORDER"]["ID"]?>" class="collapsed">
                                                <i class="icon icon-arrow-order"></i>
                                                <span>Заказ №<?=" ".$order["ORDER"]["ID"]." ";?> <b>от<?=" ".$order['ORDER']['DATE_INSERT']->format($arParams['ACTIVE_DATE_FORMAT'])?></b></span>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-status">
                                            <div class="status">
                                                Статус: <strong>
												<?
												foreach($arResult["INFO"]["STATUS"] as $arStatus){
													if($arStatus["ID"] == $order["ORDER"]["STATUS_ID"]){
														echo $arStatus["NAME"];
													};
													//break;
												}
												?></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="zakaz-<?=$order["ORDER"]["ID"]?>" class="order-list collapse">
								<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order.detail","bodyForm",Array(
										"PATH_TO_LIST" => "order_list.php",
										"PATH_TO_CANCEL" => "order_cancel.php",
										"PATH_TO_PAYMENT" => "payment.php",
										"PATH_TO_COPY" => "",
										"ID" => $order["ORDER"]["ID"],
										"CACHE_TYPE" => "A",
										"CACHE_TIME" => "3600",
										"CACHE_GROUPS" => "Y",
										"SET_TITLE" => "Y",
										"ACTIVE_DATE_FORMAT" => "d.m.Y",
										"PICTURE_WIDTH" => "110",
										"PICTURE_HEIGHT" => "110",
										"PICTURE_RESAMPLE_TYPE" => "1",
										"CUSTOM_SELECT_PROPS" => array(),
										"PROP_1" => Array(),
										"PROP_2" => Array()
									)
								);?>
                                </div>
                            </div>
							<?endforeach;?>
                        </div>
                    </div>
                    <!--<div class="col-sm-4">
                        <div class="panel-help">
                            <div class="top">Вам нужна помощь?</div>
                            <div class="tels">
                                <div class="tel">
                                    <a href="#">8 (800) 555-20-82</a>
                                    <span>(для абонентов из регионов)</span>
                                </div>
                                <div class="tel">
                                    <a href="#">8 (495) 215-12-07</a>
                                    <span>(для абонентов из Москвы)</span>
                                </div>
                            </div>
                            <p>Приготовьтесь назвать номер вашего заказа.</p>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>