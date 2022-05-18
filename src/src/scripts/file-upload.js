jQuery(document).ready(function ($) {
	$(document).on('change', '.custom-file-input', function () {
		var inputValue = this.value;
		var label = $('.custom-file-label__text');
		label.text(inputValue.substr(inputValue.lastIndexOf('\\') + 1));
	});
});
