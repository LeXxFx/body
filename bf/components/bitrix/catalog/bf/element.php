		<div id="wrapper" role="main">
			<div class="container">
				<?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				"bf",
				Array(
					"PATH" => "",
					"SITE_ID" => "s1",
					"START_FROM" => "0"
				)
				);?>
				<div id="product" role="main">
                    <?//Тут продукт?>
					<?
						$elementId = $APPLICATION->IncludeComponent(
							'bitrix:catalog.element',
							'bf',
							array(
								'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
								'IBLOCK_ID' => $arParams['IBLOCK_ID'],
								'PROPERTY_CODE' => $arParams['DETAIL_PROPERTY_CODE'],
								'META_KEYWORDS' => $arParams['DETAIL_META_KEYWORDS'],
								'META_DESCRIPTION' => $arParams['DETAIL_META_DESCRIPTION'],
								'BROWSER_TITLE' => $arParams['DETAIL_BROWSER_TITLE'],
								'SET_CANONICAL_URL' => $arParams['DETAIL_SET_CANONICAL_URL'],
								'BASKET_URL' => $arParams['BASKET_URL'],
								'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
								'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
								'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
								'CHECK_SECTION_ID_VARIABLE' => (isset($arParams['DETAIL_CHECK_SECTION_ID_VARIABLE']) ? $arParams['DETAIL_CHECK_SECTION_ID_VARIABLE'] : ''),
								'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
								'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
								'CACHE_TYPE' => $arParams['CACHE_TYPE'],
								'CACHE_TIME' => $arParams['CACHE_TIME'],
								'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
								'SET_TITLE' => $arParams['SET_TITLE'],
								'SET_LAST_MODIFIED' => $arParams['SET_LAST_MODIFIED'],
								'MESSAGE_404' => $arParams['~MESSAGE_404'],
								'SET_STATUS_404' => $arParams['SET_STATUS_404'],
								'SHOW_404' => $arParams['SHOW_404'],
								'FILE_404' => $arParams['FILE_404'],
								'PRICE_CODE' => $arParams['PRICE_CODE'],
								'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
								'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
								'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
								'PRICE_VAT_SHOW_VALUE' => $arParams['PRICE_VAT_SHOW_VALUE'],
								'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
								'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],
								'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
								'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
								'LINK_IBLOCK_TYPE' => $arParams['LINK_IBLOCK_TYPE'],
								'LINK_IBLOCK_ID' => $arParams['LINK_IBLOCK_ID'],
								'LINK_PROPERTY_SID' => $arParams['LINK_PROPERTY_SID'],
								'LINK_ELEMENTS_URL' => $arParams['LINK_ELEMENTS_URL'],

								'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
								'OFFERS_FIELD_CODE' => $arParams['DETAIL_OFFERS_FIELD_CODE'],
								'OFFERS_PROPERTY_CODE' => $arParams['DETAIL_OFFERS_PROPERTY_CODE'],
								'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
								'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
								'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
								'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],

								'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'],
								'ELEMENT_CODE' => $arResult['VARIABLES']['ELEMENT_CODE'],
								'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
								'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
								'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
								'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
								'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
								'CURRENCY_ID' => $arParams['CURRENCY_ID'],
								'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
								'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
								'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
								'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
								'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
								'STRICT_SECTION_CHECK' => (isset($arParams['DETAIL_STRICT_SECTION_CHECK']) ? $arParams['DETAIL_STRICT_SECTION_CHECK'] : ''),
								'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
								'LABEL_PROP' => $arParams['LABEL_PROP'],
								'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
								'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
								'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
								'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
								'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
								'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
								'DISCOUNT_PERCENT_POSITION' => (isset($arParams['DISCOUNT_PERCENT_POSITION']) ? $arParams['DISCOUNT_PERCENT_POSITION'] : ''),
								'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
								'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
								'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
								'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
								'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
								'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
								'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
								'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
								'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
								'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
								'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
								'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),
								'MESS_PRICE_RANGES_TITLE' => (isset($arParams['~MESS_PRICE_RANGES_TITLE']) ? $arParams['~MESS_PRICE_RANGES_TITLE'] : ''),
								'MESS_DESCRIPTION_TAB' => (isset($arParams['~MESS_DESCRIPTION_TAB']) ? $arParams['~MESS_DESCRIPTION_TAB'] : ''),
								'MESS_PROPERTIES_TAB' => (isset($arParams['~MESS_PROPERTIES_TAB']) ? $arParams['~MESS_PROPERTIES_TAB'] : ''),
								'MESS_COMMENTS_TAB' => (isset($arParams['~MESS_COMMENTS_TAB']) ? $arParams['~MESS_COMMENTS_TAB'] : ''),
								'MAIN_BLOCK_PROPERTY_CODE' => (isset($arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE']) ? $arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE'] : ''),
								'MAIN_BLOCK_OFFERS_PROPERTY_CODE' => (isset($arParams['DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE']) ? $arParams['DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE'] : ''),
								'USE_VOTE_RATING' => $arParams['DETAIL_USE_VOTE_RATING'],
								'VOTE_DISPLAY_AS_RATING' => (isset($arParams['DETAIL_VOTE_DISPLAY_AS_RATING']) ? $arParams['DETAIL_VOTE_DISPLAY_AS_RATING'] : ''),
								'USE_COMMENTS' => $arParams['DETAIL_USE_COMMENTS'],
								'BLOG_USE' => (isset($arParams['DETAIL_BLOG_USE']) ? $arParams['DETAIL_BLOG_USE'] : ''),
								'BLOG_URL' => (isset($arParams['DETAIL_BLOG_URL']) ? $arParams['DETAIL_BLOG_URL'] : ''),
								'BLOG_EMAIL_NOTIFY' => (isset($arParams['DETAIL_BLOG_EMAIL_NOTIFY']) ? $arParams['DETAIL_BLOG_EMAIL_NOTIFY'] : ''),
								'VK_USE' => (isset($arParams['DETAIL_VK_USE']) ? $arParams['DETAIL_VK_USE'] : ''),
								'VK_API_ID' => (isset($arParams['DETAIL_VK_API_ID']) ? $arParams['DETAIL_VK_API_ID'] : 'API_ID'),
								'FB_USE' => (isset($arParams['DETAIL_FB_USE']) ? $arParams['DETAIL_FB_USE'] : ''),
								'FB_APP_ID' => (isset($arParams['DETAIL_FB_APP_ID']) ? $arParams['DETAIL_FB_APP_ID'] : ''),
								'BRAND_USE' => (isset($arParams['DETAIL_BRAND_USE']) ? $arParams['DETAIL_BRAND_USE'] : 'N'),
								'BRAND_PROP_CODE' => (isset($arParams['DETAIL_BRAND_PROP_CODE']) ? $arParams['DETAIL_BRAND_PROP_CODE'] : ''),
								'DISPLAY_NAME' => (isset($arParams['DETAIL_DISPLAY_NAME']) ? $arParams['DETAIL_DISPLAY_NAME'] : ''),
								'IMAGE_RESOLUTION' => (isset($arParams['DETAIL_IMAGE_RESOLUTION']) ? $arParams['DETAIL_IMAGE_RESOLUTION'] : ''),
								'PRODUCT_INFO_BLOCK_ORDER' => (isset($arParams['DETAIL_PRODUCT_INFO_BLOCK_ORDER']) ? $arParams['DETAIL_PRODUCT_INFO_BLOCK_ORDER'] : ''),
								'PRODUCT_PAY_BLOCK_ORDER' => (isset($arParams['DETAIL_PRODUCT_PAY_BLOCK_ORDER']) ? $arParams['DETAIL_PRODUCT_PAY_BLOCK_ORDER'] : ''),
								'ADD_DETAIL_TO_SLIDER' => (isset($arParams['DETAIL_ADD_DETAIL_TO_SLIDER']) ? $arParams['DETAIL_ADD_DETAIL_TO_SLIDER'] : ''),
								'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
								'ADD_SECTIONS_CHAIN' => (isset($arParams['ADD_SECTIONS_CHAIN']) ? $arParams['ADD_SECTIONS_CHAIN'] : 'Y'),
								'ADD_ELEMENT_CHAIN' => (isset($arParams['ADD_ELEMENT_CHAIN']) ? $arParams['ADD_ELEMENT_CHAIN'] : 'Y'),
								'DISPLAY_PREVIEW_TEXT_MODE' => (isset($arParams['DETAIL_DISPLAY_PREVIEW_TEXT_MODE']) ? $arParams['DETAIL_DISPLAY_PREVIEW_TEXT_MODE'] : ''),
								'DETAIL_PICTURE_MODE' => (isset($arParams['DETAIL_DETAIL_PICTURE_MODE']) ? $arParams['DETAIL_DETAIL_PICTURE_MODE'] : array()),
								'ADD_TO_BASKET_ACTION' => $basketAction,
								'ADD_TO_BASKET_ACTION_PRIMARY' => (isset($arParams['DETAIL_ADD_TO_BASKET_ACTION_PRIMARY']) ? $arParams['DETAIL_ADD_TO_BASKET_ACTION_PRIMARY'] : null),
								'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
								'DISPLAY_COMPARE' => (isset($arParams['USE_COMPARE']) ? $arParams['USE_COMPARE'] : ''),
								'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
								'BACKGROUND_IMAGE' => (isset($arParams['DETAIL_BACKGROUND_IMAGE']) ? $arParams['DETAIL_BACKGROUND_IMAGE'] : ''),
								'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
								'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
								'SET_VIEWED_IN_COMPONENT' => (isset($arParams['DETAIL_SET_VIEWED_IN_COMPONENT']) ? $arParams['DETAIL_SET_VIEWED_IN_COMPONENT'] : ''),
								'SHOW_SLIDER' => (isset($arParams['DETAIL_SHOW_SLIDER']) ? $arParams['DETAIL_SHOW_SLIDER'] : ''),
								'SLIDER_INTERVAL' => (isset($arParams['DETAIL_SLIDER_INTERVAL']) ? $arParams['DETAIL_SLIDER_INTERVAL'] : ''),
								'SLIDER_PROGRESS' => (isset($arParams['DETAIL_SLIDER_PROGRESS']) ? $arParams['DETAIL_SLIDER_PROGRESS'] : ''),
								'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
								'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
								'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

								'USE_GIFTS_DETAIL' => $arParams['USE_GIFTS_DETAIL']?: 'Y',
								'USE_GIFTS_MAIN_PR_SECTION_LIST' => $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST']?: 'Y',
								'GIFTS_SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
								'GIFTS_SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
								'GIFTS_DETAIL_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
								'GIFTS_DETAIL_HIDE_BLOCK_TITLE' => $arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE'],
								'GIFTS_DETAIL_TEXT_LABEL_GIFT' => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],
								'GIFTS_DETAIL_BLOCK_TITLE' => $arParams['GIFTS_DETAIL_BLOCK_TITLE'],
								'GIFTS_SHOW_NAME' => $arParams['GIFTS_SHOW_NAME'],
								'GIFTS_SHOW_IMAGE' => $arParams['GIFTS_SHOW_IMAGE'],
								'GIFTS_MESS_BTN_BUY' => $arParams['~GIFTS_MESS_BTN_BUY'],
								'GIFTS_PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
								'GIFTS_SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
								'GIFTS_SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
								'GIFTS_SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

								'GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
								'GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'],
								'GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE'],
							),
							$component
						);
						$GLOBALS['CATALOG_CURRENT_ELEMENT_ID'] = $elementId;
					?>
                </div>
                <!--<section id="complect" class="product-complect">
                    <div class="heading">
                        <div class="title">В комплекте выгоднее!</div>
                        <p>Посмотрите наши уникальные предложения</p>
                    </div>
                    <div class="complect-list clearfix">
                        <article class="complect-item">
                            <div class="wrap">
                                <span class="ribbon">Так выгодней!</span>
                                <div class="item">
                                    <a href="product.html">
                                        <div class="title">
                                            Мяч прыгун с ручками, 65 см
                                        </div>
                                        <div class="photo">
                                            <img src="demo/product_img1.png" alt=""/>
                                        </div>
                                        <div class="price">
                                            <span class="new">457 р.</span>
                                            <span class="old">467 р.</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="plus">
                                    +
                                </div>
                                <div class="item">
                                    <a href="product.html">
                                        <div class="title">
                                            Мяч прыгун с ручками, 65 см
                                        </div>
                                        <div class="photo">
                                            <img src="demo/product_img3.png" alt=""/>
                                        </div>
                                        <div class="price">
                                            <span class="new">321 р.</span>
                                            <span class="old">357 р.</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="price">
                                    <span class="old">824 р.</span>
                                    <span class="equal">=</span>
                                    <span class="new">778 р.</span>
                                </div>
                                <div class="baton">
                                    <button class="btn btn-add-to-cart">Купить</button>
                                </div>
                            </div>
                        </article>
                        <article class="complect-item">
                            <div class="wrap">
                                <span class="ribbon">Так выгодней!</span>
                                <div class="item">
                                    <a href="product.html">
                                        <div class="title">
                                            Мяч прыгун с ручками, 65 см
                                        </div>
                                        <div class="photo">
                                            <img src="demo/product_img1.png" alt=""/>
                                        </div>
                                        <div class="price">
                                            <span class="new">457 р.</span>
                                            <span class="old">467 р.</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="plus">
                                    +
                                </div>
                                <div class="item">
                                    <a href="product.html">
                                        <div class="title">
                                            Мяч прыгун с ручками, 65 см
                                        </div>
                                        <div class="photo">
                                            <img src="demo/product_img3.png" alt=""/>
                                        </div>
                                        <div class="price">
                                            <span class="new">321 р.</span>
                                            <span class="old">357 р.</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="price">
                                    <span class="old">824 р.</span>
                                    <span class="equal">=</span>
                                    <span class="new">778 р.</span>
                                </div>
                                <div class="baton">
                                    <button class="btn btn-add-to-cart">Купить</button>
                                </div>
                            </div>
                        </article>
                        <article class="complect-item">
                            <div class="wrap">
                                <span class="ribbon">Так выгодней!</span>
                                <div class="item">
                                    <a href="product.html">
                                        <div class="title">
                                            Мяч прыгун с ручками, 65 см
                                        </div>
                                        <div class="photo">
                                            <img src="demo/product_img1.png" alt=""/>
                                        </div>
                                        <div class="price">
                                            <span class="new">457 р.</span>
                                            <span class="old">467 р.</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="plus">
                                    +
                                </div>
                                <div class="item">
                                    <a href="product.html">
                                        <div class="title">
                                            Мяч прыгун с ручками, 65 см
                                        </div>
                                        <div class="photo">
                                            <img src="demo/product_img3.png" alt=""/>
                                        </div>
                                        <div class="price">
                                            <span class="new">321 р.</span>
                                            <span class="old">357 р.</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="price">
                                    <span class="old">824 р.</span>
                                    <span class="equal">=</span>
                                    <span class="new">778 р.</span>
                                </div>
                                <div class="baton">
                                    <button class="btn btn-add-to-cart">Купить</button>
                                </div>
                            </div>
                        </article>
                        <article class="complect-item">
                            <div class="wrap">
                                <span class="ribbon">Так выгодней!</span>
                                <div class="item">
                                    <a href="product.html">
                                        <div class="title">
                                            Мяч прыгун с ручками, 65 см
                                        </div>
                                        <div class="photo">
                                            <img src="demo/product_img1.png" alt=""/>
                                        </div>
                                        <div class="price">
                                            <span class="new">457 р.</span>
                                            <span class="old">467 р.</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="plus">
                                    +
                                </div>
                                <div class="item">
                                    <a href="product.html">
                                        <div class="title">
                                            Мяч прыгун с ручками, 65 см
                                        </div>
                                        <div class="photo">
                                            <img src="demo/product_img3.png" alt=""/>
                                        </div>
                                        <div class="price">
                                            <span class="new">321 р.</span>
                                            <span class="old">357 р.</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="price">
                                    <span class="old">824 р.</span>
                                    <span class="equal">=</span>
                                    <span class="new">778 р.</span>
                                </div>
                                <div class="baton">
                                    <button class="btn btn-add-to-cart">Купить</button>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>-->
                <!--<section id="similar">
                    <div class="heading">
                        <div class="title">Похожие товары</div>
                        <p>Мы вручную отобрали схожие по характеристикам товары</p>
                    </div>
                    <div class="products">
                        <div class="list">
                            <div class="products-row clearfix">
                                <article class="product-item">
                                    <div class="wrap">
                                        <div class="tags">
                                            <p class="ribbon"><span class="ribbon-leader">Лидер продаж</span></p>
                                            <span class="percent">-20%</span>
                                        </div>
                                        <div class="img">
                                            <div class="preview-gallery">
                                                <figure class="img-item">
                                                    <img src="demo/product_img1.png" alt=""/>
                                                </figure>
                                                <figure class="img-item">
                                                    <img src="demo/product_img2.png" alt=""/>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <a href="product.html">
                                                <span class="name">Диск здоровья Joerex 4566</span>
                                                        <span class="short">
                                                            Формирует красивую походку и осанку
                                                        </span>
                                            </a>
                                            <div class="rate">
                                                <span class="stars star-4"></span>
                                            </div>
                                        </div>
                                        <div class="price">
                                            <span class="new">690 р.</span>
                                            <span class="old">1100 р.</span>
                                        </div>
                                        <div class="baton">
                                            <button class="btn btn-add-to-cart">Купить</button>
                                        </div>
                                    </div>
                                </article>
                                <article class="product-item has-timer">
                                    <div class="wrap">
                                        <div class="tags">
                                            <p class="ribbon"><span class="ribbon-leader">Лидер продаж</span></p>
                                            <span class="percent">-50%</span>
                                        </div>
                                        <div class="img">
                                            <div class="preview-gallery">
                                                <figure class="img-item">
                                                    <img src="demo/product_img3.png" alt=""/>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <a href="product.html">
                                                <span class="name">Ролик гимнастический одинарный Joerex 7896</span>
                                                        <span class="short">
                                                            Для тренировки мышц живота, спины и рук
                                                        </span>
                                            </a>
                                            <div class="rate">
                                                <span class="stars star-4"></span>
                                            </div>
                                        </div>
                                        <div class="price">
                                            <span>99999 р.</span>
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
                                                     data-due="2016-10-19T22:05"
                                                     data-layout="line"
                                                     data-format="d,h,m,s"
                                                     data-labels-days="день"
                                                     data-labels-hours=":"
                                                     data-labels-minutes=":"
                                                     data-labels-seconds=" ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <article class="product-item has-timer">
                                    <div class="wrap">
                                        <div class="tags">
                                            <p class="ribbon"><span class="ribbon-leader">Лидер продаж</span></p>
                                            <span class="percent">-50%</span>
                                        </div>
                                        <div class="img">
                                            <div class="preview-gallery">
                                                <figure class="img-item">
                                                    <img src="demo/product_img3.png" alt=""/>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <a href="product.html">
                                                <span class="name">Ролик гимнастический одинарный Joerex 7896</span>
                                                        <span class="short">
                                                            Для тренировки мышц живота, спины и рук
                                                        </span>
                                            </a>
                                            <div class="rate">
                                                <span class="stars star-4"></span>
                                            </div>
                                        </div>
                                        <div class="price">
                                            <span>99999 р.</span>
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
                                                     data-due="2016-10-19T22:05"
                                                     data-layout="line"
                                                     data-format="d,h,m,s"
                                                     data-labels-days="день"
                                                     data-labels-hours=":"
                                                     data-labels-minutes=":"
                                                     data-labels-seconds=" ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <article class="product-item has-timer">
                                    <div class="wrap">
                                        <div class="tags">
                                            <p class="ribbon"><span class="ribbon-present">С подарком!</span></p>
                                            <span class="percent">-20%</span>
                                        </div>
                                        <div class="img">
                                            <div class="preview-gallery">
                                                <figure class="img-item">
                                                    <img src="demo/product_img2.png" alt=""/>
                                                </figure>
                                                <figure class="img-item">
                                                    <img src="demo/product_img3.png" alt=""/>
                                                </figure>
                                                <figure class="img-item">
                                                    <img src="demo/product_img1.png" alt=""/>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <a href="product.html">
                                                <span class="name">Упоры для отжиманий XH-9155</span>
                                                        <span class="short">
                                                             Позволяют увеличить амплитуду упражнения
                                                        </span>
                                            </a>
                                            <div class="rate">
                                                <span class="stars star-4"></span>
                                            </div>
                                        </div>
                                        <div class="price">
                                            <span class="new">690 р.</span>
                                            <span class="old">1100 р.</span>
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
                                                     data-due="2016-10-19T23:25"
                                                     data-layout="line"
                                                     data-format="d,h,m,s"
                                                     data-labels-days="день"
                                                     data-labels-hours=":"
                                                     data-labels-minutes=":"
                                                     data-labels-seconds=" ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </section>-->
            </div>
        </div>
    </div>