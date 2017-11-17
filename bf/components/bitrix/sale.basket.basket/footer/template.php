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

//echo "<pre>";
//print_r($arResult);
//echo "</pre>";
$k = count($arResult["GRID"]["ROWS"])
?>
					<div class="cart-inner">
						<i class="icon icon-cart-light"></i>
						<a href="/personal/order/make/" class="btn btn-checkout hidden-xs hidden-sm">Оформить заказ</a>
						<a href="/personal/cart/" class="link-cart">В корзине <?=$k?> товара на сумму <?=$arResult["allSum_FORMATED"]?><!--<strong class="hidden-xs hidden-sm">и подарок</strong>--></a>
						<a href="#header" id="gotop"><i class="icon icon-gotop"></i></a>
					</div>