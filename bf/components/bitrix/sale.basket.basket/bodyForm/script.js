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