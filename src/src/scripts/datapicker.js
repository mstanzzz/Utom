const {on} = require("process");
const {contains} = require("jquery");

jQuery(document).ready(function ($) {

	var datapickerBlock = $('#home-consult__modal-datepicker');
	let mobileSecondHomeConsultForm = $('#mobile-second-home-consult-form')


	if ($(datapickerBlock).length >= 1) {
		$(datapickerBlock).datepicker('setDate', new Date())
	}

	if ($(window).width() < 992) {
		var myOrderDateStart = $('#mobile-my-order-from-date'),
			myOrderDateStartContainer = $('.mobile-from-date'),
			myOrderDateEnd = $('#mobile-my-order-end-date'),
			myOrderDateEndContainer = $('.mobile-end-date');
	} else {
		var myOrderDateStart = $('#my-order-from-date'),
			myOrderDateStartContainer = $('.from-date'),
			myOrderDateEnd = $('#my-order-end-date'),
			myOrderDateEndContainer = $('.end-date');
	}

	if (myOrderDateStart.length >= 1 || myOrderDateEnd.length >= 1 || myOrderDateStartContainer.length >= 1 || myOrderDateEndContainer.length >= 1) {

		$(myOrderDateStart).datepicker({
				autoclose: true,
				todayHighlight: true,
				format: 'mm/dd/yyyy',
				weekStart: 1,
				container: $(myOrderDateStartContainer)
			}
		).on('changeDate', function (e) {
			ConfigureToDate();
		});

		$(myOrderDateEnd).datepicker({
			autoclose: true,
			todayHighlight: true,
			format: 'mm/dd/yyyy',
			weekStart: 1,
			container: $(myOrderDateEndContainer)
		});

		function ConfigureToDate() {
			$(myOrderDateEnd).val("").datepicker("update");
			$(myOrderDateEnd).datepicker('setStartDate', $(myOrderDateStart).val());
		}
	}


	$(mobileSecondHomeConsultForm).scroll(
		function () {
			$('.home-consult-form__input.date-pikcer').blur();
		});


});
