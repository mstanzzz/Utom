jQuery(document).ready(function ($) {

	let item = $(".selectable")
	let selectAllLabel = $(".checkbox__select-all__label")

	$("#checkbox__select-all").click(function() {
		item.prop("checked", $(this).prop("checked"));
		selectAllLabel.text('Delete All');
	});

	item.click(function() {
		if (!$(this).prop("checked")) {
			$("#checkbox__select-all").prop("checked", false);
			selectAllLabel.text('Select All')
		}
	});
});
