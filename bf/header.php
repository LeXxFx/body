<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CJSCore::Init(array("fx"));
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<script src="/bitrix/templates/bf/assets/js/jquery-2.2.4.min.js"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
	<?$APPLICATION->ShowHead();?>
	<?
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/plugins/bootstrap/css/bootstrap.min.css", true);
	$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/plugins/font-awesome/css/font-awesome.min.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/style.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/plugins/slick/slick.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/plugins/soon-countdown/css/soon.min.css", true);
	?>
	<link rel="shortcut icon" href="/bitrix/templates/bf/assets/images/favicon.png">
	<title><?$APPLICATION->ShowTitle()?></title>
</head>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<body>
	<div id="top">
		<header id="header">
			<div class="top">
				<div class="container">
					<div class="row-top">
						<div class="col-dostavka">
							Город:
							<div class="dropdown">
								<button class="dropdown-toggle" type="button" id="routefrom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span>Москва</span>
								</button>
								<div class="dropdown-menu" aria-labelledby="routefrom">
									<a class="dropdown-item" href="#">Санкт-Петербург</a>
									<a class="dropdown-item" href="#">Таганрог</a>
									<a class="dropdown-item" href="#">Нижний Новгород</a>
								</div>
							</div>
							<span class="val">Доставим 26 июля</span>
						</div>
						<div class="col-advants">
							<div class="advants">
								<div class="list">
									<article>
										<div class="inn">
											Бесплатная доставка и самовывоз в 150 городах России
										</div>
									</article>
									<article>
										<div class="inn">
											2Бесплатная доставка и самовывоз в 150 городах России
										</div>
									</article>
								</div>
							</div>
						</div>
						<div class="col-cart">
							<div class="account">
								<i class="icon icon-user"></i>
								<div class="dropdown">
									<a href="/personal/profile/">Личный кабинет</a>
									<div class="dropdown-menu">
										<?if($USER->IsAuthorized()):?>
										<?//global $USER;?>
										<span><?if($USER->GetFullName()) echo $USER->GetFullName(); else echo $USER->GetLogin();?></span>
										<a href="<?=$APPLICATION->GetCurPage();?>?logout=yes" class="exit-client">Выход</a>
										<?else:?>
										<form class="frm" method="post" action="/auth/index.php?login=yes">
											<input type="hidden" name="AUTH_FORM" value="Y">
											<input type="hidden" name="TYPE" value="AUTH">
												<div class="form-group row">
													<label for="USER_LOGIN" class="control-label col-md-3">Логин:</label>
													<div class="col-md-9"><input type="text" class="form-control" name="USER_LOGIN" maxlength="255" id="USER_LOGIN"/></div>
												</div>
												<div class="form-group row">
													<label for="USER_PASSWORD" class="control-label col-md-3">Пароль:</label>
													<div class="col-md-9"><input type="password" class="form-control" name="USER_PASSWORD" maxlength="255" id="USER_PASSWORD"/></div>
												</div>
												<div class="form-group row">
													<div class="col-sm-6">
														<a href="#">Забыли свой пароль?</a>
														<a href="#">Зарегистрироваться?</a>
													</div>
													<div class="col-sm-6">
														<button type="submit" class="btn btn-default" name="Login" value="Войти" >Войти</button>
													</div>
												</div>
										</form>
										<?endif;?>
									</div>
								</div>
							</div>
							<div class="cart">
								<?$APPLICATION->IncludeComponent(
									"bitrix:sale.basket.basket",
									"mini",
									Array(
										"ACTION_VARIABLE" => "basketAction",
										"AUTO_CALCULATION" => "Y",
										"COLUMNS_LIST" => array("NAME","DISCOUNT","WEIGHT","DELETE","DELAY","TYPE","PRICE","QUANTITY"),
										"CORRECT_RATIO" => "N",
										"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
										"GIFTS_CONVERT_CURRENCY" => "N",
										"GIFTS_HIDE_BLOCK_TITLE" => "N",
										"GIFTS_HIDE_NOT_AVAILABLE" => "N",
										"GIFTS_MESS_BTN_BUY" => "Выбрать",
										"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
										"GIFTS_PAGE_ELEMENT_COUNT" => "4",
										"GIFTS_PLACE" => "BOTTOM",
										"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
										"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
										"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
										"GIFTS_SHOW_IMAGE" => "Y",
										"GIFTS_SHOW_NAME" => "Y",
										"GIFTS_SHOW_OLD_PRICE" => "N",
										"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
										"HIDE_COUPON" => "N",
										"OFFERS_PROPS" => array(),
										"PATH_TO_ORDER" => "/personal/orders/",
										"PRICE_VAT_SHOW_VALUE" => "N",
										"QUANTITY_FLOAT" => "N",
										"SET_TITLE" => "Y",
										"TEMPLATE_THEME" => "blue",
										"USE_ENHANCED_ECOMMERCE" => "N",
										"USE_GIFTS" => "N",
										"USE_PREPAYMENT" => "N"
									)
								);?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="center">
				<div class="col-logo">
					<a href="/" class="logo">
						<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.png" alt=""/>
					</a>
				</div>
				<div class="col-wrap">
					<div class="top">
						<div class="inner">
							<div class="catalog">
								<a href="#" class="dropdown-catalog">
									<i class="icon icon-catalog"></i>
									<span>Каталог</span>
								</a>
							</div>
							<div class="search">
								<div class="search-input">
									<i class="icon icon-eyes"></i>
									<input type="text" placeholder="Поиск среди 3000 товаров" class="form-control"/>
									<button class="btn">
										<i class="icon icon-search"></i>
									</button>
									<div class="dropdown-menu">
										<div class="head">Найдено в разделах каталога:</div>
										<ul>
											<li><a href="#">Фитболы</a></li>
											<li><a href="#">Мячи-прыгуны</a></li>
											<li><a href="#">Мячи медицинские</a></li>
											<li><a href="#">Массажеры</a></li>
										</ul>
										<div class="head">Найдены товары:</div>
										<div class="products-list">
											<div class="item">
												<div class="row">
													<div class="col-sm-2 img">
														<a href="product.html"><img src="<?=SITE_TEMPLATE_PATH?>/demo/product_img1.png" alt=""/></a>
													</div>
													<div class="col-sm-7 name">
														<a href="product.html">Мяч прыгун с ручками, 65 см.</a>
													</div>
													<div class="col-sm-3 price">
														<span>457 р.</span>
													</div>
												</div>
											</div>
											<div class="item">
												<div class="row">
													<div class="col-sm-2 img">
														<a href="product.html"><img src="<?=SITE_TEMPLATE_PATH?>/demo/product_img2.png" alt=""/></a>
													</div>
													<div class="col-sm-7 name">
														<a href="product.html">Мяч прыгун с ручками, 65 см.</a>
													</div>
													<div class="col-sm-3 price">
														<span class="new">457 р.</span>
														<span class="old">510 р.</span>
													</div>
												</div>
											</div>
										</div>
										<a href="#" class="btn">Показать все результаты</a>
									</div>
								</div>
							</div>
							<div class="contact">
								<p>Заказ по телефону:</p>
								<p>8 (495) 215-12-08</p>
							</div>
						</div>
					</div>
					<div class="nav">
						<nav class="inner">
							<ul>
								<li><a href="#">О нас</a></li>
								<li><a href="#">Доставка</a></li>
								<li><a href="#">Оплата</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</header>
		<div class="container">
			<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.section.list",
					"horizontal_menu",
						array(
						"ADD_SECTIONS_CHAIN" => "Y",
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"COUNT_ELEMENTS" => "Y",
						"IBLOCK_ID" => "4",
						"IBLOCK_TYPE" => "1c_catalog",
						"SECTION_CODE" => "",
						"SECTION_FIELDS" => array(
						0 => "",
						1 => "",
								),
								"SECTION_ID" => $_REQUEST["SECTION_ID"],
								"SECTION_URL" => "",
								"SECTION_USER_FIELDS" => array(
								0 => "",
								1 => "",
								),
						"TOP_DEPTH" => "3",
						"COMPONENT_TEMPLATE" => "horizontal_menu",
						"VIEW_MODE" => "LINE",
						"SHOW_PARENT_NAME" => "Y"
						),
					false
				);?>
		</div>
		<?
		$page = $APPLICATION->GetCurPage();
		if($page == '/index.php'):
		?>
		<div id="sl">
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="slider-wrap">
							<?$APPLICATION->IncludeComponent(
								"bitrix:catalog.section", 
								"slider", 
								array(
									"ACTION_VARIABLE" => "action",
									"ADD_PICT_PROP" => "-",
									"ADD_PROPERTIES_TO_BASKET" => "Y",
									"ADD_SECTIONS_CHAIN" => "N",
									"ADD_TO_BASKET_ACTION" => "ADD",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"BACKGROUND_IMAGE" => "-",
									"BASKET_URL" => "/personal/basket.php",
									"BROWSER_TITLE" => "-",
									"CACHE_FILTER" => "N",
									"CACHE_GROUPS" => "Y",
									"CACHE_TIME" => "36000000",
									"CACHE_TYPE" => "A",
									"COMPATIBLE_MODE" => "Y",
									"CONVERT_CURRENCY" => "N",
									"CUSTOM_FILTER" => "",
									"DETAIL_URL" => "",
									"DISABLE_INIT_JS_IN_COMPONENT" => "N",
									"DISPLAY_BOTTOM_PAGER" => "Y",
									"DISPLAY_TOP_PAGER" => "N",
									"ELEMENT_SORT_FIELD" => "sort",
									"ELEMENT_SORT_FIELD2" => "id",
									"ELEMENT_SORT_ORDER" => "asc",
									"ELEMENT_SORT_ORDER2" => "desc",
									"ENLARGE_PRODUCT" => "STRICT",
									"FILTER_NAME" => "arrFilter",
									"HIDE_NOT_AVAILABLE" => "N",
									"HIDE_NOT_AVAILABLE_OFFERS" => "N",
									"IBLOCK_ID" => "6",
									"IBLOCK_TYPE" => "Sliders",
									"INCLUDE_SUBSECTIONS" => "Y",
									"LABEL_PROP" => "",
									"LAZY_LOAD" => "N",
									"LINE_ELEMENT_COUNT" => "3",
									"LOAD_ON_SCROLL" => "N",
									"MESSAGE_404" => "",
									"MESS_BTN_ADD_TO_BASKET" => "В корзину",
									"MESS_BTN_BUY" => "Купить",
									"MESS_BTN_DETAIL" => "Подробнее",
									"MESS_BTN_SUBSCRIBE" => "Подписаться",
									"MESS_NOT_AVAILABLE" => "Нет в наличии",
									"META_DESCRIPTION" => "-",
									"META_KEYWORDS" => "-",
									"OFFERS_LIMIT" => "5",
									"PAGER_BASE_LINK_ENABLE" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "N",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_TEMPLATE" => "slider",
									"PAGER_TITLE" => "Товары",
									"PAGE_ELEMENT_COUNT" => "18",
									"PARTIAL_PRODUCT_PROPERTIES" => "N",
									"PRICE_CODE" => array(
									),
									"PRICE_VAT_INCLUDE" => "Y",
									"PRODUCT_BLOCKS_ORDER" => "",
									"PRODUCT_ID_VARIABLE" => "id",
									"PRODUCT_PROPERTIES" => array(
									),
									"PRODUCT_PROPS_VARIABLE" => "prop",
									"PRODUCT_QUANTITY_VARIABLE" => "quantity",
									"PRODUCT_ROW_VARIANTS" => "",
									"PRODUCT_SUBSCRIPTION" => "Y",
									"PROPERTY_CODE" => array(
										0 => "",
										1 => "",
									),
									"PROPERTY_CODE_MOBILE" => "",
									"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
									"RCM_TYPE" => "personal",
									"SECTION_CODE" => "",
									"SECTION_ID" => $_REQUEST["SECTION_ID"],
									"SECTION_ID_VARIABLE" => "SECTION_ID",
									"SECTION_URL" => "",
									"SECTION_USER_FIELDS" => array(
										0 => "",
										1 => "",
									),
									"SEF_MODE" => "N",
									"SET_BROWSER_TITLE" => "Y",
									"SET_LAST_MODIFIED" => "N",
									"SET_META_DESCRIPTION" => "Y",
									"SET_META_KEYWORDS" => "Y",
									"SET_STATUS_404" => "N",
									"SET_TITLE" => "Y",
									"SHOW_404" => "N",
									"SHOW_ALL_WO_SECTION" => "N",
									"SHOW_CLOSE_POPUP" => "N",
									"SHOW_DISCOUNT_PERCENT" => "N",
									"SHOW_FROM_SECTION" => "N",
									"SHOW_MAX_QUANTITY" => "N",
									"SHOW_OLD_PRICE" => "N",
									"SHOW_PRICE_COUNT" => "1",
									"SHOW_SLIDER" => "Y",
									"TEMPLATE_THEME" => "blue",
									"USE_ENHANCED_ECOMMERCE" => "N",
									"USE_MAIN_ELEMENT_SECTION" => "N",
									"USE_PRICE_COUNT" => "N",
									"USE_PRODUCT_QUANTITY" => "N",
									"COMPONENT_TEMPLATE" => "slider",
									"DISPLAY_COMPARE" => "N"
								),
								false
							);?>
						</div>
					</div>
					<div class="hidden-xs col-sm-3 col-sl-info">
						<div class="item">
							<?$APPLICATION->IncludeComponent(
								"bitrix:news.list", 
								"reklamaTop", 
								array(
									"DISPLAY_DATE" => "N",
									"DISPLAY_NAME" => "N",
									"DISPLAY_PICTURE" => "N",
									"DISPLAY_PREVIEW_TEXT" => "N",
									"AJAX_MODE" => "N",
									"IBLOCK_TYPE" => "Sliders",
									"IBLOCK_ID" => "7",
									"NEWS_COUNT" => "1",
									"SORT_BY1" => "ACTIVE_FROM",
									"SORT_ORDER1" => "DESC",
									"SORT_BY2" => "SORT",
									"SORT_ORDER2" => "ASC",
									"FILTER_NAME" => "",
									"FIELD_CODE" => array(
										0 => "",
										1 => "",
									),
									"PROPERTY_CODE" => array(
										0 => "SLIDER_VALUE",
										1 => "SLIDER_LINK",
										2 => "",
									),
									"CHECK_DATES" => "Y",
									"DETAIL_URL" => "",
									"PREVIEW_TRUNCATE_LEN" => "",
									"ACTIVE_DATE_FORMAT" => "",
									"SET_TITLE" => "N",
									"SET_STATUS_404" => "N",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"ADD_SECTIONS_CHAIN" => "N",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"PARENT_SECTION" => "",
									"PARENT_SECTION_CODE" => "",
									"CACHE_TYPE" => "A",
									"CACHE_TIME" => "36000000",
									"CACHE_NOTES" => "",
									"CACHE_FILTER" => "N",
									"CACHE_GROUPS" => "N",
									"DISPLAY_TOP_PAGER" => "N",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"PAGER_TITLE" => "Слайдер",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_TEMPLATE" => "",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "N",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"COMPONENT_TEMPLATE" => "reklamaTop",
									"TEMPLATE_THEME" => "",
									"SET_BROWSER_TITLE" => "N",
									"SET_META_KEYWORDS" => "N",
									"SET_META_DESCRIPTION" => "N",
									"SET_LAST_MODIFIED" => "N",
									"INCLUDE_SUBSECTIONS" => "N",
									"MEDIA_PROPERTY" => "",
									"SLIDER_PROPERTY" => "",
									"SEARCH_PAGE" => "/search/",
									"USE_RATING" => "N",
									"USE_SHARE" => "N",
									"PAGER_BASE_LINK_ENABLE" => "N",
									"SHOW_404" => "N",
									"MESSAGE_404" => "",
									"STRICT_SECTION_CHECK" => "N"
									),
									false
								);?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?endif;?>
	</div>