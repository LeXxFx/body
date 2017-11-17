//Не удалять!!!!!
$(function() {
	$('.sku_prop').each(function(){
		$(this).find('.sku_prop_value:first-child').click();
		console.log("click");
	});
});
var Shop = function () {

	var previewGallery = function() {
		var gal = jQuery(".preview-gallery");
		$(gal).each(function( index ) {
			if ($(this).find('.img-item').length > 1) {
				$(this).slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					autoplay: false,
					arrows: true,
					dots: false,
					prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon icon-preview-prev"></i></button>',
					nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon icon-preview-next"></i></button>',
				});
			}
		});
	};

	var gallery = function () {
		$('#product-gallery .switcher li a').on('click', function (e) {
			e.preventDefault();
			$(this).closest('.switcher').find('li').removeClass("active");
			$(this).parent().addClass("active");
			var player = $(this).closest('.gallery').find('.player');

			player.height(player.height());
			player.removeClass('init').html('').addClass('loading');

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

	var viewedProductPanel = function() {
		var viewedProducts = document.querySelector('#optionbar .viewed-list');
		document.querySelector('body #optionbar .link-viewed').addEventListener('click', function(e) {
			e.preventDefault();
			viewedProducts.classList.toggle('opened');
		});
	};

	var sidebarCollapsing = function() {
		$('#sidebar .head').on('click', '> span', function(e) {
			e.preventDefault();
			var that = $(this);
			var item = that.parent();
			item.parent('div').toggleClass('collapsed');
			item.next().slideToggle(100, function(){
				item.parent('div').toggleClass('closed');
			});
		});
	};

	var stickProductSingle = function() {
		$("#product-gallery").stick_in_parent();
		$("#product .col-price .panel").stick_in_parent();
	};

	var complectSlick = function() {
		var gal = jQuery("#complect .complect-list");
		if (gal.find('.complect-item').length > 3) {
			gal.slick({
				slidesToShow: 3,
				slidesToScroll: 3,
				autoplay: false,
				arrows: true,
				dots: false,
				prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon icon-prev"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon icon-next"></i></button>',
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
							infinite: true,
							dots: true
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		};
	};

	var similarSlick = function() {
		var gal = jQuery("#similar .list .products-row");
		if (gal.find('.product-item').length > 3) {
			gal.slick({
				slidesToShow: 3,
				slidesToScroll: 3,
				autoplay: false,
				arrows: true,
				dots: false,
				prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon icon-prev"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon icon-next"></i></button>',
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
							infinite: true,
							dots: true
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		};
	};
	function number_format(number, decimals, dec_point, thousands_sep) {
	  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	  var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
		  var k = Math.pow(10, prec);
		  return '' + (Math.round(n * k) / k)
			.toFixed(prec);
		};
	  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
		.split('.');
	  if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	  }
	  if ((s[1] || '')
		.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1)
		  .join('0');
	  }
	  return s.join(dec);
	}

	var inputCounter = function () {
		$(document).on('click', '.btn-number', function(e){
			console.log('yes');
			var self = jQuery(this);
			e.preventDefault();
			component = self.attr('data-component');
			if(component == 'mini'){
				fieldName = self.attr('data-field');
				var input = jQuery("input[name='"+fieldName+"']");
				fieldName = fieldName.replace(/mini-/g, " ");
				fieldName = parseFloat(fieldName);
			}else{
				fieldName = self.attr('data-field')
				var input = jQuery("input[name='"+fieldName+"']");
			}
			type      = self.attr('data-type');
			var currentVal = parseInt(input.val().split(" ")[0]);
			if (!isNaN(currentVal)) {
				var unit = '';
				if (input.data('unit')) unit = input.data('unit');
				if (type == 'minus') {
					self.closest('.input-counter').find('.btn-plus').attr('disabled', false);
					if(currentVal > input.attr('min')) {
						input.val(currentVal - input.data('step') + " " + unit).change();
						if(component == 'mini'){
							quantityCount = $('.input-count-mini-'+fieldName+'').val();
						}else{
							quantityCount = $('.input-count-'+fieldName+'').val();
						}
						$.ajax({
								url: "/bitrix/templates/bf/php/change_quantity.php",
								data: {
									id: fieldName,
									quantity: quantityCount
								},
								success: function(data) {
									data = eval("(" + data + ")");
									if(component == 'mini'){
										$('.minicart').find(".sum").empty();
										$('.minicart').find('.sum').append(data.allSum_FORMATED);
									}else{
										$('.suma').empty();
										$('.suma').append(data.allSum_FORMATED);
										var divobj = $('.price.item__'+fieldName+'').find("span");
										var newPrice = parseFloat(divobj[0]['innerHTML']);
										var oldPrice = parseFloat(divobj[1]['innerHTML']);
										newPrice = number_format(newPrice * $('.input-count-'+fieldName+'').val(), 0, ',', ' ');
										oldPrice = number_format(oldPrice * $('.input-count-'+fieldName+'').val(), 0, ',', ' ');
										$('.price.full_sum_'+fieldName+'').find(".new").empty();
										$('.price.full_sum_'+fieldName+'').find(".old").empty();
										$('.price.full_sum_'+fieldName+'').find(".new").append(newPrice+' руб.');
										$('.price.full_sum_'+fieldName+'').find(".old").append(newPrice+' руб.');
									}
								}
							});
									//console.log(fullprice);
					}
					if(parseInt(input.val()) == input.attr('min')) {
						self.attr('disabled', true);
					}
				} else if(type == 'plus') {
					self.closest('.input-counter').find('.btn-minus').attr('disabled', false);
					if(currentVal < input.attr('max')) {
						input.val(currentVal + input.data('step') + " " + unit).change();
						if(component == 'mini'){
							quantityCount = $('.input-count-mini-'+fieldName+'').val();
						}else{
							quantityCount = $('.input-count-'+fieldName+'').val();
						}
						$.ajax({
								url: "/bitrix/templates/bf/php/change_quantity.php",
								data: {
									id: fieldName,
									quantity: quantityCount
								},
								success: function(data) {
									data = eval("(" + data + ")");
									if(component == 'mini'){
										$('.minicart').find(".sum").empty();
										$('.minicart').find('.sum').append(data.allSum_FORMATED);
									}else{
									$('.suma').empty();
									$('.suma').append(data.allSum_FORMATED);
									var divobj = $('.price.item__'+fieldName+'').find("span");
									console.log(divobj);
									var newPrice = parseFloat(divobj[0]['innerHTML']);
									//var oldPrice = parseFloat(divobj[1]['innerHTML']);
									newPrice = number_format(newPrice * $('.input-count-'+fieldName+'').val(), 0, ',', ' ');
									//oldPrice = number_format(oldPrice * $('.input-count-'+fieldName+'').val(), 0, ',', ' ');
									$('.price.full_sum_'+fieldName+'').find(".new").empty();
									//$('.price.full_sum_'+fieldName+'').find(".old").empty();
									$('.price.full_sum_'+fieldName+'').find(".new").append(newPrice+' руб.');
									//$('.price.full_sum_'+fieldName+'').find(".old").append(newPrice+' руб.');
									}
								}
							});		//console.log(component);
									//console.log(fullprice);
					}
					if(parseInt(input.val()) == input.attr('max')) {
						self.attr('disabled', true);
					}
				}
			} else {
				input.val(0);
			}
		});
	};

    return {
        init: function () {
			gallery();
			viewedProductPanel();
			sidebarCollapsing();
			stickProductSingle();
			complectSlick();
			similarSlick();
			inputCounter();
			previewGallery();
        }
    };
}();

