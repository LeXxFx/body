var ObjSIze = function(obj) {
	var size = 0, key;
	for (key in obj) {
		if (obj.hasOwnProperty(key)) size++;
	}
	return size;
};
$(function() {
//	window.onload = function () {
//	var prop = $('.item__product-options').find('.sku_prop_value');
	//console.log(prop);
//	prop.addClass("active");
//	}



$(".sku_prop_value").on("click", function () {
		//Ловим hash
		var urlHash = window.location.hash;
		//Чистим его
		urlHash=urlHash.replace('#','');
		//Проверяем есть ли он и запускам скрипт
		if(urlHash !== ''){
			var thisParent = $("#"+urlHash).parent()
			$(thisParent).addClass("active");
			//Чистим hash
			var prop = $(this);
			update_by_sku(prop.closest('#product_container'));
			prop.closest('.product__item').find('.item__input-counter .count').attr('max', prop.data('prop-maxcount'));
			prop.closest('.product-single').find('.item__input-counter .count').attr('max', prop.data('prop-maxcount'));

			CheckMaxQuantity(prop.closest('.product__item').find('.item__input-counter .count'));
			$(window).load(function() {
				var histAPI = !!(window.history && history.pushState);
				if (histAPI && (document.location.hash == "#"+urlHash)) {
					history.replaceState({}, document.title, document.location.pathname + document.location.search)
				}
			});
		}else{
			//В противном случае стандартная работа
			var prop = $(this);
			//console.log(prop);
			prop.siblings().removeClass("active");
			prop.addClass("active");
			update_by_sku(prop.closest('#product_container'));
			prop.closest('.product__item').find('.item__input-counter .count').attr('max', prop.data('prop-maxcount'));
			prop.closest('.product-single').find('.item__input-counter .count').attr('max', prop.data('prop-maxcount'));
		}
	});
		
	function update_by_sku(element_block) {
		let tree = element_block.data('tree'), prod_id = element_block.data('id'),ind;
		//console.log(tree);
		for(ind in tree){}
		if(ObjSIze(tree[ind].TREE)>1){
			//get the largest param
			let max_vals = 0, max_id = 0, pblocks = element_block.find('.prop')
			$.each(pblocks,function(){
				let vals = $(this).find('.value').length;
				if(vals > max_vals){
					max_vals = vals;
					max_id = $(this).closest('.prop').data('prop-id')
				}
			})
			//hide all params, without maxparam
			$.each(pblocks,function(){
				if($(this).closest('.prop').data('prop-id')!==max_id){
					$(this).find('.value').hide();
				}
			})
			//show params, what are compared to max_param
			for(var i in tree){
				var subtree = tree[i].TREE
				if($(".item_"+prod_id+" [data-onevalue="+subtree['PROP_'+max_id]+"]").hasClass('active')){//if max_prop isactive
					for(var j in subtree){
						if(j !== 'PROP_'+max_id){//if not largest
							$(".item_"+prod_id+" [data-onevalue="+subtree[j]+"]").show();
						}
					}
				}
			}
			//
			var flagV = false;
			$.each(pblocks,function(){
				if($(this).closest('.prop').data('prop-id')!==max_id){
					if($(this).find('.value.active').is(':hidden') || !$(this).find('.value.active').length){
						$(this).find('.value.active').removeClass('active');
						$.each($(this).find('.value'),function(){
							console.log($(this).css('display'));
							if($(this).css('display') !== 'none' && !flagV){
                                flagV = true;
                                $(this) .addClass('active');return;
							}
						})
					}
				}
			})
		}
		//console.log("YES");
		var active_props = {};
		element_block.find(" .sku_props .sku_prop").each(function () {
			active_props[$(this).data("prop-id")] = $(this).find(".sku_prop_value.active").data("value-id");
		});
		var data_to_send = {};
		data_to_send["props"] = active_props;
		data_to_send["element_id"] = element_block.find(".sku_props .sku_prop").data("element-id");

		$.ajax({
			url: "/bitrix/templates/bf/php/update_element_by_sku.php",
			data: data_to_send,
			success: function (data) {
				if (data != "null") {
					data = eval("(" + data + ")");
					if (data.price_id)
						element_block.find(".addtobasket").attr("data-price-id", data.price_id);
					if (data.price)
						element_block.find(".price .new").text(data.price+" р.");
					if (data.old_price)
						element_block.find(".price .old").text(data.old_price+" р.");
					if (data.id)
						element_block.find(".buy-card-fast").attr("href", "/include/catalog/element/oneclick.php?id=" + data.id + "&priceid=" + data.price_id);
					 if (data.section_image && element_block.find(".section-item-image").length > 0)
						 element_block.find(".section-item-image").attr("src", data.section_image);
					 if (data.photos_small) {
                        $(".product__item .imgs-list").slick('unslick');
                        element_block.find("ul.pagination").html("");
                        //element_block.find("hidden_photos").html("");
                        element_block.find(".switcher").html('');
                        $.each(data.photos_small, function (key, value) {
                            element_block.find(".switcher").append('<li><a title="" data-source="image" href="' + data.photos_full[key] + '"><img src="' + data.photos_full[key] + '" alt=""/></a></li>');
                        });
                        element_block.find('.player').html('');
						element_block.find('.player').html('<a id="gallery" href="' + data.DETAIL_PICTURE + '" class="MagicZoomPlus" rel="preload-selectors-small:false;preload-selectors-big:false;initialize-on:mouseover;smoothing-speed:70;fps:40;selectors-effect:false;show-title:false;loading-msg:Загрузка...;background-opacity:10;zoom-width:420;zoom-height:420;zoom-distance:5;hint-text:;selectors-class:current;buttons:hide;caption-source:span;"><img src="' + data.DETAIL_PICTURE + '" alt=""/></a>');

                        MagicZoomPlus.refresh()
						offersPhoto.init();
						console.log(data);
                    }
				}
			}
		});
	}
	$(".addtobasket").on("click", function(event) {
		event.preventDefault();
		var active_props = [];
		console.log($(this));
		$(this).closest('#product_container').find(".sku_prop").each(function() {
		//console.log($(this).find(".name").text().replace(":", ""))
		//console.log($(this).find(".sku_prop_value.active").data("value"))
                    if(typeof $(this).find(".sku_prop_value.active").data("value")!=="undefined"){
			active_prop = {}
			active_prop["NAME"] = $(this).find(".name").text().replace(":", "");
			active_prop["CODE"] = $(this).data("prop-code");
			active_prop["VALUE"] = $(this).find(".sku_prop_value.active").data("value");
			active_props.push(active_prop);
                    }
		});
		//console.log(active_props);
		
		var data_to_send = {};
		data_to_send["props"] = active_props;
		data_to_send["price_id"] = $(this).attr("data-price-id");
		data_to_send["product_id"] = $(this).attr("data-id");
		data_to_send["amount"] = $(this).attr("data-amount");
		//console.log(data_to_send);
		
		var button = $(this);
		//YaAddSku();
		
		$.ajax({
			url: "/bitrix/templates/bf/php/add_to_cart.php",
			data: data_to_send,
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				// if(button.hasClass("elementpage")) {
				// 	// $.fancybox.open([{
				// 	// 	type: 'ajax',
				// 	// 	href: '/bitrix/templates/sport07/php/add2basket_successful.php'
				// 	// }], {
				// 	// 	padding: 20
				// 	// });
				// }
				// small_basket_update();
				console.log("простой товар ушел!!");
				small_basket_update();
				big_basket_update();
			}
		});
		$(this).parent().parent().find(".cover-buy").show();
	});
});
		
var availableTags = [
  "РџСЂРёРјРµСЂ",
  "Р•С‰Рµ РІР°СЂРёР°РЅС‚ РїСЂРёРјРµСЂР°"
];
// $(document).ready(function(){
// $( "#tags" ).autocomplete({source: availableTags});
//	});

	// $(document).ready(function() {
	 
	//	 $("#owl-demo").owlCarousel({
	 
	//	  navigation : true, // Show next and prev buttons
	//	  slideSpeed : 300,
	//	  paginationSpeed : 400,
	//	  singleItem:true,
	//	  loop:true,
	//	smartSpeed:50,
	//	autoplay:true,
	//	autoplayTimeout:4000
	 
	//	  // "singleItem:true" is a shortcut for:
	//	  // items : 1, 
	//	  // itemsDesktop : false,
	//	  // itemsDesktopSmall : false,
	//	  // itemsTablet: false,
	//	  // itemsMobile : false
	 
	//	 });
	 
	// });
	
var offersPhoto = function () {

	var pictureOffers = function () {
		$('#product-gallery .switcher li a').on('click', function (e) {
			e.preventDefault();
			$(this).closest('.switcher').find('li').removeClass("active");
			//console.log($(this).parent());
			$(this).parent().addClass("active");
			var player = $(this).closest('.gallery').find('.player');

			player.height(player.height());
			//player.removeClass('init').html('').addClass('loading');

			if ($(this).data('source') == 'image') {
				player.html('<a id="gallery" class="MagicZoomPlus" rel="preload-selectors-small:false;preload-selectors-big:false;initialize-on:mouseover;smoothing-speed:70;fps:40;selectors-effect:false;show-title:false;loading-msg:Загрузка...;background-opacity:10;zoom-width:420;zoom-height:420;zoom-distance:5;hint-text:;selectors-class:current;buttons:hide;caption-source:span;" ' +
					'href="'+this.href+'"><img /></a>').find('img').attr('src', this.href).load(function () {
					player.removeClass('loading');
					player.find('img').fadeIn('fast');
					player.height('auto');
				});
				MagicZoomPlus.start('gallery');
			} else if ($(this).data('source') == 'youtube') {
				var videoSRC = this.href,
					videoSRCauto = videoSRC + "?autoplay=1&amp;rel=0&amp;controls=0&amp;showinfo=0";
				player.html('<iframe frameborder="0" allowfullscreen />').find('iframe').attr('src', videoSRCauto).load(function () {
					player.removeClass('loading');
					player.height('auto');
				});
			}
			return false;
		});
	};
    return {
        init: function () {
			pictureOffers();
        }
    };
}();

function small_basket_update() {
		$.ajax({
			url: "/bitrix/templates/bf/php/basket_small.php",
			success: function(data) {
				$(".cart-footer").html(data);
				//console.log('обновились');
			}
		});
	}
	function big_basket_update() {
		$.ajax({
			url: "/bitrix/templates/bf/php/basket_big.php",
			success: function(data) {
				$(".cart").empty();
				$(".cart").html(data);
			}
		});
	}
	
	function small_basket_full_price_update() {
		$.ajax({
			url: "/bitrix/templates/sp07restail/php/get_total_price.php",
			success: function(data) {
				var isactive = $(".small-basket .basket").hasClass('active');
				$(".small-basket").html(data)
				if(isactive){
					$(".small-basket .basket").addClass('active');
					$(".small-basket .list-order").show();
				}
//wrong data format for this action. 
//				data = eval("(" + data + ")");
//				$(".small-basket .basket b").html(data.count);
//				$(".bottom-order .order-price").html(data.total);
//				$(".small-basket .num-amount").html(data.count);
//				$(".bottom-order .new-price").html(data.total);
			}
		});
	console.log("update");
	}