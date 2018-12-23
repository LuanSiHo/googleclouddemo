$(function () {
	$('.datepicker').datepicker({ format: "yyyy-mm-dd" }).on('changeDate', function (ev) {
		$(this).datepicker('hide');
	});
});