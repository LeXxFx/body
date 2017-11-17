<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
//print_r($arResult["ITEMS"]);
$frame = $this->createFrame()->begin();

if (!empty($arResult['ITEMS']))
{?>
				<div class="col-xs-2 col-sm-4 col-lg-2 col-viewed">
					<a href="#" class="link-viewed"><i class="fa fa-eye hidden-lg hidden-sm hidden-sm" aria-hidden="true"></i>
						<span class="hidden-xs">Просмотренные товары</span></a>
					<div class="viewed-list">
						<div class="list clearfix">
							<?foreach($arResult["ITEMS"] as $item):?>
							<?
							//echo "<pre>";
							//print_r($item);
							//echo "</pre>";
							?>
							<div class="item">
								<a href="<?=$item["DETAIL_PAGE_URL"]?>">
									<div class="title">
										<?=$item["NAME"]?>
									</div>
									<div class="photo">
										<img src="<?=$item["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$item["NAME"]?>"/>
									</div>
									<div class="price">
										<span>от <?=$item["MIN_PRICE"]["VALUE"]?> р.</span>
									</div>
								</a>
							</div>
							<?endforeach;?>
						</div>
					</div>
				</div>
<?
}
?>
<?$frame->beginStub();?>
<?$frame->end();