<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
							echo "<pre>";
							print_r($arResult);
							echo "</pre>";
							?>
				<div class="col-xs-2 col-sm-4 col-lg-2 col-viewed">
					<a href="#" class="link-viewed"><i class="fa fa-eye hidden-lg hidden-sm hidden-sm" aria-hidden="true"></i>
						<span class="hidden-xs">Просмотренные товары</span></a>
					<div class="viewed-list">
						<div class="list clearfix">
							<?foreach($arResult as $item):?>
							<?
							echo "<pre>";
							print_r($item);
							echo "</pre>";
							?>
							<div class="item">
								<a href="product.html">
									<div class="title">
										Мяч прыгун с ручками, 65 см
									</div>
									<div class="photo">
										<img src="demo/product_img3.png" alt=""/>
									</div>
									<div class="price">
										<span>457 р.</span>
									</div>
								</a>
							</div>
							<div class="item">
								<a href="product.html">
									<div class="title">
										Мяч прыгун с ручками, 65 см
									</div>
									<div class="photo">
										<img src="demo/product_img2.png" alt=""/>
									</div>
									<div class="price">
										<span class="new">457 р.</span>
										<span class="old">510 р.</span>
									</div>
								</a>
							</div>
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
										<span class="old">510 р.</span>
									</div>
								</a>
							</div>
							<?endforeach;?>
						</div>
					</div>
				</div>

