jQuery(document).ready(function ($) {

	$('.js-pay-card-number').on('input', function (e) {
		var target = e.target,
			position = target.selectionEnd,
			length = target.value.length;

		target.value = target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
		target.selectionEnd = position += ((target.value.charAt(position - 1) === ' ' && target.value.charAt(length - 1) === ' ' && length !== target.value.length) ? 1 : 0);
	})

	$('.js-pay-card-date').on('input', function (e) {
		var target = e.target,
			position = target.selectionEnd,
			length = target.value.length;

		target.value = target.value.replace(/[^\dA-Z]/g, '').replace(/(.{2})/g, '$1/').trim().substr(0, 5);
		target.selectionEnd = position += ((target.value.charAt(position - 1) === '/') ? 1 : 0);
	})
	$('.js-pay-card-cv').on('input', function (e) {
		var target = e.target;
		target.value = target.value.replace(/[^\dA-Z]/g, '');
	})
});
