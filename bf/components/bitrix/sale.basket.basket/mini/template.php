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
?>
								<i class="icon icon-cart"></i>
                                <div class="dropdown">
                                    <a href="/personal/cart/">
                                        Корзина
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="minicart">
                                            <div class="products-list">
												<?foreach($arResult["GRID"]["ROWS"] as $grid):?>
                                                <div class="item" data-delete-id="<?=$grid["ID"]?>">
                                                    <div class="row">
                                                        <div class="col-sm-3 img">
                                                            <a href="<?=$grid["DETAIL_PAGE_URL"]?>"><img src="<?=$grid["PREVIEW_PICTURE_SRC"]?>" alt=""/></a>
                                                        </div>
                                                        <div class="col-sm-6 name">
                                                            <a href="<?=$grid["DETAIL_PAGE_URL"]?>"><?=$grid["NAME"]?></a>
                                                            <div class="options">
																<?foreach($grid["PROPS"] as $props):?>
                                                                <p><?=$props["NAME"]?>: <?=$props["VALUE"]?></p>
                                                                <?endforeach;?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 price">
                                                            <span><?=$grid["PRICE_FORMATED"]?></span>
                                                            <div class="input-counter">
                                                                <button type="button" class="btn btn-minus btn-number" data-component="mini" data-type="minus" data-field="mini-<?=$grid["ID"]?>">
                                                                    -
                                                                </button>
                                                                <div class="input-group-text">
                                                                    <input type="text" name="mini-<?=$grid["ID"]?>" class="form-control input-number input-area input-count-mini-<?=$grid["ID"]?>" value="<?=$grid["QUANTITY"]?>" min="1" max="<?=$grid["AVAILABLE_QUANTITY"]?>" data-step="1" disabled="true">
                                                                </div>
                                                                <button type="button" class="btn btn-plus btn-number" data-component="mini" data-type="plus" data-field="mini-<?=$grid["ID"]?>">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-remove" title="Удалить товар с корзины" data-basket-id="<?=$grid["ID"]?>"><i class="icon icon-remove"></i></button>
                                                    </div>
                                                </div>
												<?endforeach;?>
                                            </div>
                                            <div class="sum">
											<?=$arResult["allSum_FORMATED"]?>
											</div>
                                            <div class="row row-bot">
                                                <div class="col-sm-6">
                                                    <a href="/personal/order/make/" class="btn btn-checkout">
                                                        Оформить заказ
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a href="/personal/cart/" class="link-cart">Перейти в корзину</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>