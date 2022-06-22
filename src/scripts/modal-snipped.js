$(document).on("show.bs.modal", '.modal', function (event) {
	// console.log("Global show.bs.modal fire");
	var zIndex = 1040 + (10 * $(".modal:visible").length);
	$(this).css("z-index", zIndex);
	setTimeout(function () {
		$(".modal-backdrop").not(".modal-stack").first().css("z-index", zIndex - 1).addClass("modal-stack");
	}, 0);
}).on("hidden.bs.modal", '.modal', function (event) {
	// console.log("Global hidden.bs.modal fire");
	$(".modal:visible").length && $("body").addClass("modal-open");
});
$(document).on('inserted.bs.tooltip', function (event) {
	// console.log("Global show.bs.tooltip fire");
	var zIndex = 1045 + (10 * $(".modal:visible").length);
	var tooltipId = $(event.target).attr("aria-describedby");
	$("#" + tooltipId).css("z-index", zIndex);
});
$(document).on('inserted.bs.popover', function (event) {
	// console.log("Global inserted.bs.popover fire");
	var zIndex = 1045 + (10 * $(".modal:visible").length);
	var popoverId = $(event.target).attr("aria-describedby");
	$("#" + popoverId).css("z-index", zIndex);
});