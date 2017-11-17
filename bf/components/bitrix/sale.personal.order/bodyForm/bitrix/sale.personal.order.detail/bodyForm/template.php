
<?
$arPayments = array_keys($arResult["PAYMENT"]);
$payment = $arResult["PAYMENT"][$arPayments["0"]];
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";
?>
<div class="row">
	<div class="col-md-9">
		<div class="cart-table">
			<table>
				<colgroup>
					<col/>
					<col width="80px"/>
				</colgroup>
				<?foreach ($arResult['BASKET'] as $basketItem):?>
				<tr>
					<td>
						<div class="product-info">
							<a href="product.html">
								<?
								if (strlen($basketItem['PICTURE']['SRC']))
								{
									$imageSrc = $basketItem['PICTURE']['SRC'];
								}
								else
								{
									$imageSrc = $this->GetFolder().'/images/no_photo.png';
								}
								?>
								<img src="<?=$imageSrc?>" alt=""/>
							</a>
							<div class="name">
								<a href="product.html">
									<?=htmlspecialcharsbx($basketItem['NAME'])?>
								</a>
								<div class="prop">
								<?
								if (isset($basketItem['PROPS']) && is_array($basketItem['PROPS']))
								{
									foreach ($basketItem['PROPS'] as $itemProps)
									{
										?>
										<p><?=htmlspecialcharsbx($itemProps['NAME'])?>:<?=htmlspecialcharsbx($itemProps['VALUE'])?></p>
										<?
									}
								}
								?>
								</div>
							</div>
						</div>
					</td>
					<td>
						<div class="price">
							<span class="new"><?=$basketItem['PRICE_FORMATED']?></span>
							<?if($basketItem["DISCOUNT_PRICE_PERCENT"]):?>
							<span class="old"><?= $basketItem['BASE_PRICE_FORMATED'] ?></span>
							<?endif;?>
						</div>
					</td>
				</tr>
			<?endforeach;?>
			</table>
		</div>
	</div>
	<div class="col-md-3">
		<div class="sum">
			<?$sum = roundEx($params['PAYMENT_SHOULD_PAY'], 2);?>
			<p>Доставка: <?=$arResult["SHIPMENT"][0]["PRICE_DELIVERY_FORMATED"]?></p>
			<p>Товары: <?=$arResult["PRODUCT_SUM_FORMATED"]?></p>
			<p><b>Итого к оплате: <?=$payment["PRICE_FORMATED"]?></b></p>
			<p>Доставка: <?=$arResult["SHIPMENT"][0]["DELIVERY_NAME"]?></p>
			<p>Оплата: <?=$payment["PAY_SYSTEM_NAME"]?></p>
			<?if($arResult["PAYED"] == "Y"):?>
			<b><p style="color:green;">Оплачено</p></b>
			<?else:?>
			<p>Оплата не поступала</p>
			<?endif;?>
			<?if($payment["BUFFERED_OUTPUT"]){
				echo $payment["BUFFERED_OUTPUT"];
			}
			?>
		</div>
	</div>
</div>