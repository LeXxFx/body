window.onerror = function (msg, url, line) {
 alert(msg + "\n" + url + "\n" + "\n" + line);
 return true;
};
var Main = function () {
	var runGoTop = function () {
        jQuery('#gotop').on('click', function (e) {
            jQuery("html, body").animate({
                scrollTop: 0
            }, "slow");
            e.preventDefault();
        });
	};
	var dellBasket = function(){
	$(document).on('click',".btn-remove",function(event){
		console.log('YES');
			element = $(this);
			event.preventDefault();
			var id = $(this).attr("data-basket-id");
			$.ajax({
				url: "/bitrix/templates/bf/php/delete_from_cart.php",
				data: {
					id: $(this).attr("data-basket-id")
				},
				success: function(data) {
					$("[data-delete-id="+id+"]").toggle();
				}
			});
		});
	}

	var advantsCarousel= function () {
		var advants = jQuery(".advants .list");

		if (advants.length > 0) {
			if (advants.find('article').length > 1) {
				advants.slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					autoplay: true,
					fade: true
				});
			}
		}
	};

	var collapser = function () {
		jQuery('.show_more').on('click', '.btn', function () {
			var btn = jQuery(this);
			var titleInit = 'Подробнее';
			var titleCollapsed = 'Свернуть';
			if (!btn.hasClass('collapsed')) {
				if (btn.data('title-init')) {
					titleInit = btn.data('title-init');
				}
				btn.find('span').html(titleInit);
			} else {
				if (btn.data('title-collapsed')) {
					titleCollapsed = btn.data('title-collapsed');
				}
				btn.find('span').html(titleCollapsed);
			}
		});
	};

	var searchBox = function () {
		$('.search .search-input .form-control').on("change paste keyup", function () {
			$(this).parent().addClass('open');
		});
		$(document).mouseup(function (e) {
			var container = $('.search .search-input');
			if (!container.is(e.target)
				&& container.has(e.target).length === 0) {
				$(".search .search-input").removeClass('open')
			}
		});
	};

	var svgConvert = function () {
		jQuery('img.svg').each(function(){
			var $img = jQuery(this);
			var imgID = $img.attr('id');
			var imgClass = $img.attr('class');
			var imgURL = $img.attr('src');

			jQuery.get(imgURL, function(data) {
				// Get the SVG tag, ignore the rest
				var $svg = jQuery(data).find('svg');

				// Add replaced image's ID to the new SVG
				if(typeof imgID !== 'undefined') {
					$svg = $svg.attr('id', imgID);
				}
				// Add replaced image's classes to the new SVG
				if(typeof imgClass !== 'undefined') {
					$svg = $svg.attr('class', imgClass+' replaced-svg');
				}

				// Remove any invalid XML tags as per http://validator.w3.org
				$svg = $svg.removeAttr('xmlns:a');

				// Replace image with new SVG
				$img.replaceWith($svg);

			}, 'xml');

		});
	};

	var initNavi = function () {
		$("#navi > ul > li").on('click', '> a', function (e) {
			//var divObj = $(this);
			//console.log(divObj.data('id'));
			var divObj = $(this).children('.dropdown-menu');
			//console.log(divObj['context']['nextElementSibling']);
			if(divObj['context']['nextElementSibling'] != null){
			e.preventDefault();
			}
			$("#navi > ul > li").removeClass('open')
			$(this).closest('li').toggleClass('open');
		});

		$(document).mouseup(function (e) {
			var container = $('#navi');
			if (!container.is(e.target)
				&& container.has(e.target).length === 0) {
				$("#navi > ul > li").removeClass('open')
			}
		});
	};

	var catalogToggler = function() {
		$('.dropdown-catalog').on('click', function(e) {
			e.preventDefault();
			$('#navi').slideToggle();
		});
	};

	var stickSidebar = function() {
		$('#sidebar aside').stick_in_parent();
		$('.sticky').stick_in_parent()
	};

	var maskedInput = function() {
		$('.masked-phone').mask('9 (999) 999-99-99');
	};

	var masonryList = function() {
		$(window).load(function() {
			var list = jQuery(".masonry-list");

			if (list.length > 0) {
				list.masonry({itemSelector: 'article'});
			}
		});
	};

	var bfSliders = function() {
		var sl = jQuery(".bf-slider .list");
		sl.each(function( index ) {
			if ($(this).find('.sl-item').length > 3) {
				$(this).slick({
					slidesToShow: 3,
					slidesToScroll: 3,
					autoplay: false,
					arrows: true,
					dots: false,
					prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon icon-preview-prev"></i></button>',
					nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon icon-preview-next"></i></button>',
					responsive: [
						{
							breakpoint: 1024,
							settings: {
								slidesToShow: 3,
								slidesToScroll: 3,
								infinite: true,
								dots: true
							}
						},
						{
							breakpoint: 600,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 2
							}
						},
						{
							breakpoint: 480,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 2
							}
						}
					]
				});
			}
		});
	};


	return {
        init: function () {
			runGoTop();
			advantsCarousel();
			dellBasket();
			collapser();
			searchBox();
			//svgConvert();
			initNavi();
			catalogToggler();
			stickSidebar();
			maskedInput();
			masonryList();
			bfSliders();
        }
    };
}();

