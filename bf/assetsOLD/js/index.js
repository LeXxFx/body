var Index = function () {

	var homeSlider = function () {
		var sl = jQuery("#sl .slider");

		if (sl.length > 0) {
			if (sl.find('.slide').length > 1) {
				sl.slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					autoplay: true,
					arrows: true,
					dots: true,
					prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="icon icon-prev"></i></button>',
					nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="icon icon-next"></i></button>',
				});
			}
		}
	};

    return {
        init: function () {
			homeSlider();
        }
    };
}();