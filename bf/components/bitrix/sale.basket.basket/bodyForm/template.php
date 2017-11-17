<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
/** @var CBitrixBasketComponent $component */
$APPLICATION->AddHeadScript($templateFolder."/script.js");
?>
	<?
	//echo "<pre>";
	//print_r($arResult);
	//echo "</pre>";
	?>
	<div id="wrapper" role="main">
        <div class="container">
            <div id="breadcumbs">
                <a href="#">Главная</a><span class="sep">/</span> <span class="current">Корзина</span>
            </div>
            <div id="cart">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_products" data-toggle="tab">
                            <span>Ваши покупки</span>
                        </a>
                    </li>
                    <!--<li>
                        <a href="#tab_checkout" data-toggle="tab">
                            <span>Контактная информация</span>
                        </a>
                    </li>
                    <li>
                        <a href="#tab_payment" data-toggle="tab">
                            <span>Доставка и оплата</span>
                        </a>
                    </li>-->
                </ul>
                <div class="tab-content">
                    <div  id="tab_products" class="tab-pane active">
                        <!--<div class="alert-cart sticky">
                            <div class="inner">
                                <button class="btn btn-remove" title="Закрыть"><i class="icon icon-remove"></i></button>
                                <p>До скидки 11% осталось купить на сумму:</p>
                                <span>3891,2 р.</span>
                                <a class="btn btn-shop" href="catalog.html">Продолжить покупки</a>
                            </div>
                        </div>-->
                        <div class="cart-table">
                            <div class="table-responsive">
                                <table>
                                    <colgroup>
                                        <col />
                                        <col width="110" />
                                        <col  width="110"/>
                                        <col width="110" />
                                        <col width="40" />
                                    </colgroup>
                                    <tr>
                                        <th class="th-product">
                                            Наименование товара
                                        </th>
                                        <th>
                                            Цена
                                        </th>
                                        <th>
                                            Количество
                                        </th>
                                        <th>
                                            Сумма
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
									<?foreach($arResult["GRID"]["ROWS"] as $grid):?>
                                    <tr data-delete-id="<?=$grid["ID"]?>">
                                        <td>
                                            <div class="product-info">
                                                <a href="product.html">
                                                    <img src="<?=$grid["PREVIEW_PICTURE_SRC"]?>" alt=""/>
                                                </a>
                                                <div class="name">
                                                    <a href="product.html">
                                                    <?=$grid["NAME"]?>
                                                    </a>
                                                    <div class="prop">
														<?foreach($grid["PROPS"] as $props):?>
                                                        <p><?=$props["NAME"]?>: <?=$props["VALUE"]?></p>
                                                        <?endforeach;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price item__<?=$grid["ID"]?>">
                                                <span class="new"><?=$grid["PRICE_FORMATED"]?></span>
												<?if($grid["DISCOUNT_PRICE_PERCENT"] >= 1):?>
                                                <span class="old"><?=$grid["FULL_PRICE_FORMATED"]?></span>
												<?endif;?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-counter">
                                                <button type="button" class="btn btn-minus btn-number" data-type="minus" data-field="<?=$grid["ID"]?>">
                                                    -
                                                </button>
                                                <div class="input-group-text">
                                                    <input type="text" name="<?=$grid["ID"]?>" class="form-control input-number input-area input-count-<?=$grid["ID"]?>" value="<?=$grid["QUANTITY"]?>" min="1" max="<?=$grid["AVAILABLE_QUANTITY"]?>" data-step="1">
                                                </div>
                                                <button type="button" class="btn btn-plus btn-number" data-type="plus" data-field="<?=$grid["ID"]?>">
                                                    +
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price full_sum_<?=$grid["ID"]?>">
                                                <span class="new"><?=$grid["SUM"]?></span>
												<?if($grid["DISCOUNT_PRICE_PERCENT"] >= 1):?>
                                                <span class="old"><?=$grid["FULL_PRICE"] * $grid["QUANTITY"]." руб."?></span>
												<?endif;?>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-remove" title="Удалить товар с корзины" data-basket-id="<?=$grid["ID"]?>"><i class="icon icon-remove"></i></button>
                                        </td>
                                    </tr>
									<?endforeach;?>
                                    <!--<tr>
                                        <td>
                                            <div class="product-info">
                                                <a href="product.html">
                                                    <img src="demo/card.png" alt=""/>
                                                </a>
                                                <div class="name">
                                                    <a href="product.html">
                                                        Карта покупателя, скидка 10%
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td colspan="4">
                                            <div class="price">
                                                <span class="new">Подарок</span>
                                            </div>
                                        </td>
                                    </tr>-->
                                </table>
                            </div>
                            <div class="bot clearfix">
                                <div class="col-sm-7">
                                    <div class="cupon clearfix loading">
                                        <div class="col-sm-5">
                                            <span>Применить промокод:</span>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-icon">
                                                <input type="text" class="form-control"/>
                                                <i class="fa fa-spinner"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="suma">
                                        <?=$arResult["allSum_FORMATED"]?>
                                    </div>
                                </div>
                            </div>
                            <div class="button clearfix">
                                <a class="btn btn-next" href="/personal/order/make/">Далее - оформить заказ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>