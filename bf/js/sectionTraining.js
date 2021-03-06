var ObjSIze = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
	console.log(size);
    return size;
};
$(function() {
    // $('.checkout_payment').click();		

    $('.amount .input-number').change(function(){
    	
    	CheckMaxQuantity($(this));

    });

	var updatepanel = function(){
		$.ajax({
    		url: '/bitrix/templates/sp07restail/ajax/PanelBasketUpdate.php',
    		type: 'GET',
    		dataType: 'html',
    	})
    	.done(function(data) {
    		$('.option-panel__cart').html(data);
    	});
		console.log("updateBasketPanelSucces");
	};

    var checkDelivery = function(el){
        $('.delivary__info').html('<div class="info__heading">'+el.data('name')+'</div>');
        $('.delivary__info').append('<p>'+el.data('desc')+'</p>');
        $('.delivary__info').append('<p>Стоимость: <b>'+el.data('price')+'</b></p>');
    };

    var checkPayment = function(el){
        $('.payment__info').html('<div class="info__heading">'+el.data('name')+'</div>');
        $('.payment__info').append('<p>'+el.data('desc')+'</p>');
    };

	var UpdateCheckoutResult = function(){
		var datatosend = {
			delivery: $('.checkout_delivery:checked').attr('data-price-nf'),
			payment: $('.checkout_payment:checked').data('id'),
			sum: $('.checkout-result .suma-tovar').html(),
			discount: $('.checkout-result .discount').html(),
		};
		$.ajax({
			url: '/bitrix/templates/sp07restail/php/checkout_update.php',
			type: 'GET',
			dataType: 'html',
			data: datatosend,
		})
		.done(function(data) {
			$('.checkout-result').html(data);
		});
	};    



	$('.checkout_delivery').click(function(){
		UpdateCheckoutResult();
		checkDelivery($(this));
	});

	$('.checkout_payment').click(function(){
		console.log('test');
		checkPayment($(this));
	});
	window.onload = function () {
	UpdateCheckoutResult();
	}



	//$("#cityselect").chosen();
	
	// SKU
	
	//$(document).ready(function(){
       
        //update_by_sku("oneElement");
		
		//$('.sku_prop_value[data-prop-n=0]').click();
        
//    $(".sku_prop_value").on("click", function () {
//        var prop = $(this);
//        prop.siblings().removeClass("active");
//        prop.addClass("active");
//        let element_block = prop.closest('#product_container');
//        update_by_sku(element_block);
//        prop.closest('.product__item').find('.item__input-counter .count').attr('max', prop.data('prop-maxcount'));
//        prop.closest('.product-single').find('.item__input-counter .count').attr('max', prop.data('prop-maxcount'));

//        CheckMaxQuantity(prop.closest('.product__item').find('.item__input-counter .count'));
//    });

 /*
	При переходе с яндекс маркета в строке содержиться якорь,
	но на сайте не выбирается данное торговое предложение.
	Ловим хэш. Ищем в дереве элемент с этим якорем, делаем его активным.
	После чистим hash.
	*/    
    $(".sku_prop_value").on("click", function () {
		//Ловим hash
		var urlHash = window.location.hash;
		//console.log("findHash");
		//Чистим его
		urlHash=urlHash.replace('#','');
		//console.log("clearHash");
		//Проверяем есть ли он и запускам скрипт
		if(urlHash !== ''){
			//console.log("findDone");
			var thisParent = $("#"+urlHash).parent()
			$(thisParent).addClass("active");
			//console.log("activateProps");
			//Чистим hash
			var prop = $(this);
			update_by_sku(prop.closest('#product_container'));
			prop.closest('.product__item').find('.item__input-counter .count').attr('max', prop.data('prop-maxcount'));
			prop.closest('.product-single').find('.item__input-counter .count').attr('max', prop.data('prop-maxcount'));

			//CheckMaxQuantity(prop.closest('.product__item').find('.item__input-counter .count'));
			$(window).load(function() {
				var histAPI = !!(window.history && history.pushState);
				if (histAPI && (document.location.hash == "#"+urlHash)) {
					history.replaceState({}, document.title, document.location.pathname + document.location.search)
					//console.log("dellHash");
				}
			});
		}else{
			//console.log("hashEmpty");
			//В противном случае стандартная работа
			var prop = $(this);
			//console.log($(this));
			//vat yandexName = $('.active');
			//console.log(yandexName);
			prop.siblings().removeClass("active");
			//console.log("del");
			prop.addClass("active");
			//console.log("add");
			update_by_sku(prop.closest('#product_container'));
			prop.closest('.product__item');
			prop.closest('.product-single');

			//CheckMaxQuantity(prop.closest('.product__item').find('.item__input-counter .count'));
		}
    });
		
    function update_by_sku(element_block) {
		console.log(element_block);
        let tree = element_block.data('tree'), prod_id = element_block.data('id'),ind;
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
                            $(".item_"+prod_id+" [data-onevalue="+subtree[j]+"]").show()
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
         /*
             $.each(pblocks,function(){
             if($(this).closest('.prop').data('prop-id')!==max_id){
             if($(this).find('.value.active').is(':hidden') || !$(this).find('.value.active').length){
             $(this).find('.value.active').removeClass('active');
             $.each($(this).find('.value'),function(){

             })
             }
             }
             })
             */
        }
        var active_props = {};
        element_block.find(" .sku_props .sku_prop").each(function () {
            active_props[$(this).data("prop-id")] = $(this).find(".sku_prop_value.active").data("value-id");
        });
        var data_to_send = {};
        data_to_send["props"] = active_props;
        data_to_send["element_id"] = element_block.find(".sku_props .sku_prop").data("element-id");

        $.ajax({
            url: "/bitrix/templates/sp07restail/php/update_element_by_sku.php",
            data: data_to_send,
            success: function (data) {
                if (data != "null") {
                    //data = eval("(" + data + ")");
                    // console.log(data);
                    if (data.price_id)
                        element_block.find(".addtobasket").attr("data-price-id", data.price_id);
                    if (data.price)
                        element_block.find(".item__price .new").text(data.price);
                    if (data.old_price)
                        element_block.find(".price-old").text(data.old_price);
                    if (data.id)
                        element_block.find(".buy-card-fast").attr("href", "/include/catalog/element/oneclick.php?id=" + data.id + "&priceid=" + data.price_id);
                    if (data.section_image && element_block.find(".section-item-image").length > 0)
                        element_block.find(".section-item-image").attr("src", data.section_image);
                    if (data.photos_small) {
                        $(".product__item .imgs-list").slick('unslick');
                        element_block.find("ul.pagination").html("");
                        element_block.find("hidden_photos").html("");
                        element_block.find(".imgs-list").html('');
                        $.each(data.photos_small, function (key, value) {
                            // element_block.find("ul.pagination").append('<li><a href="'+data.photos_full[key]+'" class="fancybox detail-small-image" rel="gallery"><img src="'+value+'" alt=""></a></li>');
                            element_block.find(".imgs-list").append('<div class="item"><a href="' + data.photos_full[key] + '" data-preview="' + data.photos_full[key] + '" data-source="image"><img src="' + data.photos_full[key] + '" alt=""/></a></div>');
                        });
//                        if(element_block.find('.image__preview img').attr('src') === ""){
//                            element_block.find('.image__preview img').attr('src',data.DETAIL_PICTURE);
//                            element_block.find('.image__preview a').attr('href',data.DETAIL_PICTURE);
//                        }
                        element_block.find('.image__preview').html('');
                        $.each(data.photos_full, function (key, value) {
                            if (key == 0) {
                                element_block.find('.image__preview').html('<a href="' + value + '" class="MagicZoomPlus" rel="preload-selectors-small:false;preload-selectors-big:false;initialize-on:mouseover;smoothing-speed:70;fps:40;selectors-effect:false;show-title:false;loading-msg:Загрузка...;background-opacity:10;zoom-width:420;zoom-height:420;zoom-distance:5;hint-text:;selectors-class:current;buttons:hide;caption-source:span;"><img src="' + value + '" alt=""/></a>');
                                if (element_block.find('.item__image_grid'))
                                    element_block.find('.item__image_grid').html('<img src="' + value + '" alt="">');
                            } else
                                element_block.find(".imgs-list").append('<div class="item"><a href="' + data.photos_full[key] + '" data-preview="' + data.photos_full[key] + '" data-source="image"><img src="' + data.photos_full[key] + '" alt=""/></a></div>');
                            // element_block.find('.item__image').html('<img src="'+value+'" alt=""/>');
                        });

                        //MagicZoomPlus.refresh()
                        // complectSlick();
                        var imgs = $(".product__item .imgs-list");
                        $(".product__item .imgs-list").slick({
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            autoplay: false,
                            vertical: true,
                            verticalSwiping: true,
                            prevArrow: '<a class="slick-prev"><i class="fa fa-angle-up"></i></a>',
                            nextArrow: '<a class="slick-next"><i class="fa fa-angle-down"></i></a>'
                        });
                        // console.log(element_block.data('block-type'));
                        // if (element_block.data('block-type')!=='catalog')
                        //MagicZoomPlus.start('gallery');
                    }
                    // if(data.detail_small_image && element_block.find(".detail-small-image").length > 0) {
                    // 	element_block.find(".detail-small-image img").attr("src", data.detail_small_image);
                    // 	element_block.find(".detail-small-image").attr("href", data.detail_full_image);
                    // }
                    // if(data.detail_full_image && element_block.find(".detail-full-image").length > 0) {
                    // 	element_block.find(".detail-full-image img").attr("src", data.detail_full_image);
                    // 	element_block.find(".detail-full-image").attr("href", data.detail_full_image);
                    // }
                }
            }
        });
    }
	
	//});
	/*
$(window).load(function(){
		
        
        update_by_sku("oneElement");
		 $(".cnt_item").on("click", function(){
		
			update_by_sku($(this).parent().parent().attr("id"));
		});
		
		function update_by_sku(element_block_id) {
			element_block_selector = "#" + element_block_id;
			var element_block = $(element_block_selector);
			var active_props = {};
			var data_to_send = {};
			
			if ($(element_block_selector + " .sku_prop").length) {
				$(element_block_selector + " .sku_prop").each(function() {
					active_props[$(this).data("prop-id")] = $(this).find(".bx_scu_scroller_container .bx_scu .bx_active").data("value-id");
				});
				
				data_to_send["props"] = active_props;
				data_to_send["element_id"] = $(element_block_selector + " .sku_prop").data("element-id");
			}
			else{
				var $sku_prop = $(element_block_selector).parent().parent().parent()();
				active_props[$sku_prop.data("prop-id")] = $(element_block_selector).data("value-id");
				data_to_send["props"] = active_props;
				data_to_send["element_id"] = $sku_prop.data("element-id");
			}
			
            $.ajax({
				url: "/bitrix/templates/sport07/php/update_element_by_sku.php",
				data: data_to_send,
				success: function(data) {
					element_block = $('body');
					if (data != "null") {
					data = eval("(" + data + ")");
					if(data.price_id)
						element_block.find(".addtobasket").attr("data-price-id", data.price_id);
					if(data.price)
						element_block.find(".price").text(data.price);
					if(data.old_price)
						element_block.find(".price-old").text(data.old_price);
					if(data.id)
						element_block.find(".buy-card-fast").attr("href", "/include/catalog/element/oneclick.php?id=" + data.id + "&priceid=" + data.price_id);
					if(data.section_image && element_block.find(".section-item-image").length > 0)
						element_block.find(".section-item-image").attr("src", data.section_image);
					if(data.photos_small) {
						element_block.find("ul.pagination").html("");
						element_block.find("hidden_photos").html("");
						$.each(data.photos_small, function(key, value) {
							element_block.find("ul.pagination").append('<li><a href="'+data.photos_full[key]+'" class="fancybox detail-small-image" rel="gallery"><img src="'+value+'" alt=""></a></li>');
						});
						$.each(data.photos_full, function(key, value) {
							if(key == 0)
								element_block.find(".slides_container").html('<a href="'+value+'" class="fancybox detail-full-image" rel="gallery2"><img src="'+value+'" width="369" alt=""></a>');
							else
								element_block.find(".hidden_photos").append('<a href="'+value+'" class="fancybox detail-small-image" rel="gallery2"></a>');
						});
					}
					if(data.detail_small_image && element_block.find(".detail-small-image").length > 0) {
						element_block.find(".detail-small-image img").attr("src", data.detail_small_image);
						element_block.find(".detail-small-image").attr("href", data.detail_full_image);
					}
					if(data.detail_full_image && element_block.find(".detail-full-image").length > 0) {
						element_block.find(".detail-full-image img").attr("src", data.detail_full_image);
						element_block.find(".detail-full-image").attr("href", data.detail_full_image);
					}
					}
				}
			});
		}
	
	});
*/
	// Home filter
	
	$(".fast-filter select[name='pol']").change(function() {
		var t_pol = $(this).val();
		$.ajax({
			type: "POST",
			url: "/bitrix/templates/sport07/php/filter_lv2.php",
			data: {
				pol: t_pol,
				pol_name: $(".fast-filter select[name='pol'] option:selected").text()
			},
			success: function(data) {
				$(".fast-filter select[name='kind']").html(data);
				$(".fast-filter select[name='section']").html('<option value="0">РўРѕРІР°СЂ</option>');
				$(".fast-filter select[name='size']").html('<option value="0">Р Р°Р·РјРµСЂ</option>');
			}
		});
	});
	
	$(".fast-filter select[name='kind']").change(function() {
		var t_pol = $(".fast-filter select[name='pol']").val();
		var t_kind = $(this).val();
		$.ajax({
			type: "POST",
			url: "/bitrix/templates/sport07/php/filter_lv3.php",
			data: {
				pol: t_pol,
				kind: t_kind
			},
			success: function(data) {
				$(".fast-filter select[name='section']").html(data);
				$(".fast-filter select[name='size']").html('<option value="0">Р Р°Р·РјРµСЂ</option>');
			}
		});
	});
	
	$(".fast-filter select[name='section']").change(function() {
		var t_pol = $(".fast-filter select[name='pol']").val();
		var t_section = $(this).val();
		$.ajax({
			type: "POST",
			url: "/bitrix/templates/sport07/php/filter_lv4.php?" + t_pol + "=Y&set_filter=РџРѕРєР°Р·Р°С‚СЊ",
			data: {
				section: t_section
			},
			success: function(data) {
				$(".fast-filter select[name='size']").html(data);
			}
		});
	});
	
	$(".fast-filter input[type='submit']").click(function(e) {
		e.preventDefault();
		var e_id = $(".fast-filter select[name='section']").val();
		var t_pol = $(".fast-filter select[name='pol']").val();
		var t_size = $(".fast-filter select[name='size']").val();
		$.ajax({
			type: "POST",
			url: "/bitrix/templates/sport07/php/filter_lv5.php",
			data: {
				id: e_id
			},
			success: function(msg) {
				document.location.href = msg + "?" + t_pol + "=Y&" + t_size + "=Y&set_filter=РџРѕРєР°Р·Р°С‚СЊ";
			}
		});
	});
	
	// Fancybox
	
	//$(".fancybox").fancybox();
	
	// Temp Sidebar
	
	var tmpSidebar = $(".to_sidebar");
	if(tmpSidebar) {
		$("header .header-sidebar nav").html(tmpSidebar.html());
		tmpSidebar.hide();
	}
	
	// Amount
	// $(document).on('click',".amount .minus",function(){
	// 	update_amount("m", $(this));
	// });

	// $(document).on('click',".amount .plus",function(){
	// 	update_amount("p", $(this));
	// });
	function update_amount(type, this_v) {
		var buy_block = this_v.closest('.item__panel');
		var amount = this_v.closest('.amount');
		var value = parseInt(amount.find(".num-amount").attr("data-amount"));
		if(type == "m" && value>=1) value--;
		if(type == "p") value++;
		if(!buy_block.hasClass("small-b") && !buy_block.hasClass("big-b")) {
			buy_block.find(".addtobasket").attr("data-amount", value);
			amount.find(".num-amount").attr("data-amount", value);
			amount.find(".num-amount b:first-child").text(value);
			amount.parent().parent().find(".cover-buy p span").text(value);
		} else {
			var item_id = amount.attr("data-item-id");
			$.ajax({
				url: "/bitrix/templates/sport07/php/change_quantity.php",
				data: {
					id: item_id,
					quantity: value
				},
				success: function(data) {
					small_basket_full_price_update();
					big_basket_update();
				}
			});
			$(".amount[data-item-id='"+ item_id +"']").find(".num-amount").attr("data-amount", value);
			$(".amount[data-item-id='"+ item_id +"']").find(".num-amount b:first-child").text(value);
		}
	}
	
	// Small Basket

	$(document).on('click',".del-p",function(event){
		element = $(this);
		event.preventDefault();
		$.ajax({
			url: "/bitrix/templates/sport07/php/delete_from_cart.php",
			data: {
				id: $(this).attr("data-item-id")
			},
			success: function(data) {
				small_basket_full_price_update();
				element.parent().toggle();
			}
		});
	});
	
	$(document).on('click',".del-bakset-page",function(event){
		element = $(this);
		$.ajax({
			url: "/bitrix/templates/sport07/php/delete_from_cart.php",
			data: {
				id: $(this).attr("data-item-id")
			},
			success: function(data) {
				big_basket_update();
			}
		});
	});
/*
	$(".addtobasket").on("click", function(event) {
		event.preventDefault();
		
		var active_props = [];
		$(document).find(".sku_prop").each(function() {
			active_prop = {}
			active_prop["NAME"] = $(this).find(".sku_prop_name").text().replace(":", "");
			active_prop["CODE"] = $(this).data("prop-code");
			active_prop["VALUE"] = $(this).find(".bx_active").data("value");
			active_props.push(active_prop);
		});
		
		var data_to_send = {};
		data_to_send["props"] = active_props;
		data_to_send["price_id"] = $(this).attr("data-price-id");
		data_to_send["amount"] = $(this).attr("data-amount");
		
		var button = $(this);
		
		$.ajax({
			url: "/bitrix/templates/sport07/php/add_to_cart.php",
			data: data_to_send,
			success: function(data) {
				if(button.hasClass("elementpage")) {
					$.fancybox.open([{
						type: 'ajax',
						href: '/bitrix/templates/sport07/php/add2basket_successful.php'
					}], {
						padding: 20
					});
				}
				small_basket_update();
			}
		});
		$(this).parent().parent().find(".cover-buy").show();
	});
*/	
//Отправка статистики в Яндекс комерцию
	function YaAddSku(){
		var productType = $('.product__type').attr("data-product-type");
		var idOffer = $('.active').attr("data-product-id");
		var idProduct = $('.product__id').attr("data-product-id");
		var productName = $('.item__name').attr("data-product-name");
		var productAmount = $(".count").val();
		var productPrice = $(".product-single__price").find(".new");
		productPrice = $(productPrice).html();
		if(productType == 1){
			var id = idOffer;
		}else{
			var id = idProduct;
		}
		dataLayerSp07.push({
					"ecommerce": {
						"add": {
							"products": [
								{
								"id": id,
								"name" : productName,
								"quantity": productAmount,
								"price": productPrice
								},
							]
						}
					}
				});
	}

	$(".addtobasket").on("click", function(event) {
		event.preventDefault();
		//var active_props = [];
		console.log($(this));
		$(this).closest('#product_container').find(".sku_prop").each(function() {
		console.log($(this).find(".name").text().replace(":", ""))
		console.log($(this).find(".sku_prop_value.active").data("value"))
                    if(typeof $(this).find(".sku_prop_value.active").data("value")!=="undefined"){
			active_prop = {}
			active_prop["NAME"] = $(this).find(".name").text().replace(":", "");
			active_prop["CODE"] = $(this).data("prop-code");
			active_prop["VALUE"] = $(this).find(".sku_prop_value.active").data("value");
			active_props.push(active_prop);
                    }
		});
		
		var data_to_send = {};
		data_to_send["props"] = active_props;
		data_to_send["price_id"] = $(this).attr("data-price-id");
		data_to_send["product_id"] = $(this).attr("data-id");
		data_to_send["amount"] = $(this).attr("data-amount");
		//console.log(data_to_send["product_id"]);
		
		var button = $(this);
		//YaAddSku();
		
		$.ajax({
			url: "/bitrix/templates/sp07restail/php/add_to_cart.php",
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
				console.log("простой товар ушел");
				updatepanel();
				YaAddSku();
			}
		});
		$(this).parent().parent().find(".cover-buy").show();
	});

	$(".del-buy").click(function(){
		$(this).parent().hide();
	});

	$(".buy-more").click(function(){
		$(this).parent().hide();
	});

	$(".submit-cupon").on("click", function(event) {
		event.preventDefault();
		$.ajax({
			url: "/bitrix/templates/sport07/php/set_coupon.php",
			data: {
				coupon: $(".input-kupon").val()
			},
			success: function(data) {
				big_basket_update();
			}
		});
	});
	
	function small_basket_update() {
		$.ajax({
			url: "/bitrix/templates/sp07restail/php/basket_small.php",
			success: function(data) {
				$(".small-basket").html(data);
			}
		});
	}
	
	function big_basket_update() {
		$.ajax({
			url: "/bitrix/templates/sp07restail/php/basket_big.php",
			success: function(data) {
				$(".big-basket").html(data);
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
	
	// Other
	
	$(document).on('click','header .basket',function(){
		$(this).toggleClass("active");
		$('header .login-link').removeClass("active");
		$('header .list-order').slideToggle('fast');
		$('header .login-sub').slideUp('fast');
	});

	$(".filter-catalog .title-filter span").click(function(){
		$(this).toggleClass("active");
		$('.main-filter').slideToggle('fast');
	});

	$(".select-color-product div span:first").addClass("active");
	$('.select-color-product span').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
	});

	$('.select-size-product.filter span').click(function(){
		var input = $("input[name='"+$(this).attr("id")+"']");
		if($(this).hasClass("active")) {
			input.attr('checked', false);
			$(this).removeClass("active");
		} else {
			input.attr('checked', true);
			$(this).addClass('active');
		}
	});

	$("header .login-link").click(function(){
		$(this).toggleClass("active");
		$('header .basket').removeClass("active");
		$('header .login-sub').slideToggle('fast');
		$('header .list-order').slideUp('fast');
	});
	
	$(document).on('click','.fixed-header .basket',function(){
		$(this).toggleClass("active");
		$('.fixed-header .login-link').removeClass("active");
		$('.fixed-header .list-order').slideToggle('fast');
		$('.fixed-header .login-sub').slideUp('fast');
	});

	$(".fixed-header .login-link").click(function(){
		$(this).toggleClass("active");
		$('.fixed-header .basket').removeClass("active");
		$('.fixed-header .login-sub').slideToggle('fast');
		$('.fixed-header .list-order').slideUp('fast');
	});

	$(".icon-m-1").click(function(){
		$(".phone-mobile").removeClass("active");
		$(this).toggleClass("active").siblings().removeClass("active");
		$('.hidden-nav').slideToggle("fast");
		$('.hidden-search').slideUp("fast");
		$('.hidden-phone').slideUp("fast");
	});

	$(".icon-m-2").click(function(){
		$(".phone-mobile").removeClass("active");
		$(this).toggleClass("active").siblings().removeClass("active");
		$('.hidden-search').slideToggle("fast");
		$('.hidden-nav').slideUp("fast");
		$('.hidden-phone').slideUp("fast");
	});

	$(".icon-m-3").click(function(){
		$(this).toggleClass("active").siblings().removeClass("active");
		$(".search-mobile").removeClass("active");
		$('.hidden-phone').slideToggle("fast");
		$('.hidden-nav').slideUp("fast");
		$('.hidden-search').slideUp("fast");
	});

	//$("input[type='tel']").inputmask("+7 (999) 999-99-99");//РјР°СЃРєР°


	// $('.owl-carousel').owlCarousel({
	// 	items:1,
	// 	animateOut: 'slideOutDown',
	// 	animateIn: 'flipInX',
	// 	smartSpeed:50,
	// 	loop:true,
	// 	smartSpeed:50,
	// 	autoplay:true,
	// 	autoplayTimeout:4000
	// });

	// $('#products').slides({
	// 	preload: true,
	// 	preloadImage: 'images/loading.gif',
	// 	effect: 'fade',
	// 	crossfade: true,
	// 	slideSpeed: 200,
	// 	fadeSpeed: 500,
	// 	generateNextPrev: false,
	// 	generatePagination: false
	// });

	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});

	$(".tab_content_card").hide(); //Hide all content
	$("ul.tabs_card li:first").addClass("active").show(); //Activate first tab
	$(".tab_content_card:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs_card li").click(function() {
		$("ul.tabs_card li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content_card").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});
        //MagicZoomPlus.refresh()
});
$(function() {

	var marquee = $("#marquee"); 
	marquee.css({"overflow": "hidden", "width": "100%"});

	marquee.wrapInner("<span>");
	marquee.find("span").css({ "width": "50%", "display": "inline-block", "text-align":"center" }); 
	marquee.append(marquee.find("span").clone()); 

	marquee.wrapInner("<div>");
	marquee.find("div").css("width", "200%");

	var reset = function() {
		$(this).css("margin-left", "0%");
		$(this).animate({ "margin-left": "-100%" }, 24000, 'linear', reset);
	};

	reset.call(marquee.find("div"));
        
        $(".imgs-list").on('hover, click','.item a', function(){
//            console.log('qweqwe');
            var preview = $(this).parent().parent().parent().parent().next();
            var href = $(this).attr('href');
            var src = $(this).find('img').attr('src');
//            console.log(preview.find('a'));
//            console.log(href);
//            console.log(src);
            preview.find('a').attr('href',href);
            preview.find('img').attr('src',src);
            MagicZoomPlus.refresh()
            return false;
        })
});
	var q = new Date;
	var year = q.getFullYear();
	var month = q.getMonth();
	var day = q.getDate()+1;
	var hour = 0;
	var minute = 0;
	var sec = 0;
	delete q;
	dateFuture = new Date(year, month, day, hour, minute, sec);
	function CountBox() {
	dateNow = new Date;
	amount = dateFuture.getTime() - dateNow.getTime();
	delete dateNow;
	if (amount < 0) {
	out = "<div class='countbox-space'></div>" +
	"<div class='countbox-num'><div id='countbox-hours1'><span></span>0</div><div id='countbox-hours2'><span></span>0</div><div id='countbox-hours-text'></div></div>" +
	"<div class='countbox-space'></div>" +
	"<div class='countbox-num'><div id='countbox-mins1'><span></span>0</div><div id='countbox-mins2'><span></span>0</div><div id='countbox-mins-text'></div></div>" +
	"<div class='countbox-space'></div>" +
	"<div class='countbox-num'><div id='countbox-secs1'><span></span>0</div><div id='countbox-secs2'><span></span>0</div><div id='countbox-secs-text'></div></div>";
	document.getElementById("countbox").innerHTML = out
	} else {
	days = 0;
	days1 = 0;
	days2 = 0;
	hours = 0;
	hours1 = 0;
	hours2 = 0;
	mins = 0;
	mins1 = 0;
	mins2 = 0;
	secs = 0;
	secs1 = 0;
	secs2 = 0;
	out = "";
	amount = Math.floor(amount / 1e3);
	days = Math.floor(amount / 86400);
	days1 = (days >= 10) ? days.toString().charAt(0) : '0';
	days2 = (days >= 10) ? days.toString().charAt(1) : days.toString().charAt(0);
	amount = amount % 86400;
	hours = Math.floor(amount / 3600);
	hours1 = (hours >= 10) ? hours.toString().charAt(0) : '0';
	hours2 = (hours >= 10) ? hours.toString().charAt(1) : hours.toString().charAt(0);
	amount = amount % 3600;
	mins = Math.floor(amount / 60);
	mins1 = (mins >= 10) ? mins.toString().charAt(0) : '0';
	mins2 = (mins >= 10) ? mins.toString().charAt(1) : mins.toString().charAt(0);
	amount = amount % 60;
	secs = Math.floor(amount);
	secs1 = (secs >= 10) ? secs.toString().charAt(0) : '0';
	secs2 = (secs >= 10) ? secs.toString().charAt(1) : secs.toString().charAt(0);
	out = "<div class='countbox-num'><div id='countbox-hours1'><span></span>" + hours1 + "</div><div id='countbox-hours2'><span></span>" + hours2 + "</div><div id='countbox-hours-text'></div></div>" +
	"<div class='countbox-space'></div>" +
	"<div class='countbox-num'><div id='countbox-mins1'><span></span>" + mins1 + "</div><div id='countbox-mins2'><span></span>" + mins2 + "</div><div id='countbox-mins-text'></div></div>" +
	"<div class='countbox-space'></div>" +
	"<div class='countbox-num'><div id='countbox-secs1'><span></span>" + secs1 + "</div><div id='countbox-secs2'><span></span>" + secs2 + "</div><div id='countbox-secs-text'></div></div>";
	//document.getElementById("countbox").innerHTML = out;
	setTimeout("CountBox()", 1e3)
	}
	}
	window.onload = function () {
	UpdateCheckoutResult()
}
/* $(document).ready(function(){
		$(".fixed-header")
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 150) {
					$('.fixed-header').addClass("fixed");
				} else {
					$('.fixed-header').removeClass("fixed");
					$('.fixed-header .login-link').removeClass("active");
					$('.fixed-header .login-sub').slideUp("fast");
					$('.fixed-header .basket').removeClass("active");
					$('.fixed-header .list-order').slideUp("fast");
				}
			});
		});
	}); */
$('.gotop').on('click', function (e) {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            e.preventDefault();
        });
		$(window).scroll(function () {
			if ($(this).scrollTop() > 200) {
				$('.gotop').fadeIn();
			} else {
				$('.gotop').fadeOut();
			}
		});
		
var availableTags = [
  "РџСЂРёРјРµСЂ",
  "Р•С‰Рµ РІР°СЂРёР°РЅС‚ РїСЂРёРјРµСЂР°"
];
// $(document).ready(function(){
// $( "#tags" ).autocomplete({source: availableTags});
// 	});

	// $(document).ready(function() {
	 
	//   $("#owl-demo").owlCarousel({
	 
	// 	  navigation : true, // Show next and prev buttons
	// 	  slideSpeed : 300,
	// 	  paginationSpeed : 400,
	// 	  singleItem:true,
	// 	  loop:true,
	// 	smartSpeed:50,
	// 	autoplay:true,
	// 	autoplayTimeout:4000
	 
	// 	  // "singleItem:true" is a shortcut for:
	// 	  // items : 1, 
	// 	  // itemsDesktop : false,
	// 	  // itemsDesktopSmall : false,
	// 	  // itemsTablet: false,
	// 	  // itemsMobile : false
	 
	//   });
	 
	// });