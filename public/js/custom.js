$(document).ready(function () {
	//comfirm delete
	$(document.body).on('submit','.js-confirm', function(){
		var $el = $(this)
		var text = $el.data('confirm') ? $el.data('confirm') :'Anda yakin melakukan tindakan ini?'
		var c = confirm(text);
		return c;
	});
});

$(document).ready(function(){
	//add selectize to select element
	$('.js-selectize').selectize({
		sortField: 'text'
	});
});