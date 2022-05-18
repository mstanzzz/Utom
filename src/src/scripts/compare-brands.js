jQuery(document).ready(function ($) {
		let brandCheck = $('.checkbox-brand');
		let compareBtn = $('.btn-compare');
		let compareBtnMobileWrap = $('.filter__compare__mobile')
		let compareBtnMobile = $('.btn-compare__mobile')
		let clearBtnMobile = $('.clear-selected__mobile')

		let mainTableWrap = $('.comparison .table__brands-comparison')
		let mainTable = $('#main-table')
		let brandCompare = $('#main-table .brand-compare')
		let brandCheckbox = $('#main-table .checkbox-brand')
		let brandCardCheckboxWrap = $('.list__card-brand-comparison')
		let brandCardCheckbox = $('.list__card-brand-comparison .checkbox-brand')
		let brandCardCheckboxTable = $('.brand-compare__header__checkbox')
		let mainSectionPadding = $('.comparison-page .main').css('padding-top');
		let table = $('.table-fixed .table-scroll')
		let btnBackLink = $('[data-btn="back-link"]')

		function isMobile() {
			return $(document).width() < 992
		}

		var $boxes; // array of checked checkboxes

		var tableTHShadow = $("<th scope=\"col\" data-brand-checked=\"brand-1\"\n" +
			"class=\"table-cell__sticky brand-compare brand-compare__header td-shadow\">\n" +
			"<div class=\"table-cell__sticky__header wrap-sticky-row\">\n" +
			"</div>\n" +
			"</th>");

		var tableTDShadow = $("<td class=\"brand-compare td-shadow\" data-brand-checked=\"brand-3\">\n" +
			"<div class=\"wrap-sticky-row\">\n" +
			"<div class=\"second-sticky-column \">\n" +
			"</div>\n" +
			"</div>\n" +
			"</td>")

		var tableTDShadowColorized = $("<td class=\"brand-compare td-shadow\" data-brand-checked=\"brand-3\">\n" +
			"<div class=\"wrap-sticky-row\">\n" +
			"<div class=\"second-sticky-column colorized\">\n" +
			"</div>\n" +
			"</div>\n" +
			"</td>")

		function isCompareBtnDisabled() {
			$boxes = $('.checkbox-brand[type=checkbox]:checked');

			if ($boxes.length === 0) {
				$(brandCompare).removeClass('border-left-0', 'border-right-0')
			}

			if (isMobile() && $boxes.length < 2) {
				$(compareBtnMobileWrap).addClass('disabled').attr('disable', true).removeClass('d-block').addClass('d-none');
				$(clearBtnMobile).addClass('d-none');
			} else if (isMobile() && $boxes.length >= 2) {
				$(compareBtnMobileWrap).removeClass('disabled').attr('disable', false).removeClass('d-none').addClass('d-block')
				$(clearBtnMobile).removeClass('d-none')
			} else {
				if ($boxes.length <= 0) {
					$(compareBtn).addClass('disabled').attr('disable', true)
					$(compareBtn).text('Compare')
				} else {
					$(compareBtn).removeClass('disabled').attr('disable', false)
				}
			}
		}


		isCompareBtnDisabled()


		if (isMobile()) {
			$('#brand-ctg').attr("disabled", "disabled").attr("checked", "checked")
			$(table).css({'height': `calc(100vh - ${mainSectionPadding})`})
		}

		$(brandCheck).on('click', function () {

			isCompareBtnDisabled()

			// console.log($(this).parents('.brand-compare').data('brand-checked'));


			let brandValue = $(this).parents('.brand-compare').data('brand-checked')
			let getThis = $('*[data-brand-checked="' + brandValue + '"]')
			let getPrevCell = getThis.prev('.brand-compare')

			let getNextCell = getThis.next('.brand-compare')


			$('.number-of-checked-brands').text($boxes.length);

			getThis.toggleClass('brand-cell__checked')

			if (isMobile()) {
				//if we click on checkbox on mobile
				//then we trigger the checkbox in actual table
				let getVal = $(this).data('brand-checked').slice(0, -1)
				$('*[data-brand-checked="' + getVal + '"]').trigger('click')
			}


			if ($('#main-table').hasClass('compare-brands') && $boxes.length === 1) {
				$(brandCardCheckboxTable).css({'display': 'none'})
			}

			if ($(this).hasClass('brand-cell__checked') && !$(getPrevCell).hasClass('brand-cell__checked')) {
				$(getPrevCell).addClass('border-right-0')
			} else {
				$(getPrevCell).removeClass('border-right-0')
			}


			if (!$(this).hasClass('brand-cell__checked') && $(getNextCell).hasClass('brand-cell__checked')) {
				$(getThis).addClass('border-right-0')
				$(getNextCell).removeClass('border-left-0')
			}

			if (!$(this).hasClass('brand-cell__checked') && $(getPrevCell).hasClass('brand-cell__checked')) {
				return null
			}

			if ($(this).hasClass('brand-cell__checked') && $(getNextCell).hasClass('brand-cell__checked')) {
				return null
			}

			if ($(this).hasClass('brand-cell__checked') && !$(getNextCell).hasClass('brand-cell__checked')) {
				$(getNextCell).addClass('border-left-0')
			}

		})

		function restTable() {
			// RESET STATE AFTER CLEAR SELECTING BRANDS
			if (!$(mainTable).hasClass('compare-brands')) {

				if ($(brandCompare).hasClass('border-left-0')) {
					$(brandCompare).removeClass('border-left-0')
				}
				if ($(brandCompare).hasClass('border-right-0')) {
					$(brandCompare).removeClass('border-right-0')
				}
				$(brandCompare).removeClass(' brand-cell__checked')
				$(brandCheckbox).removeClass('brand-cell__checked')
				$(brandCheckbox).prop('checked', false);
				$(brandCardCheckbox).prop('checked', false);
				$('.number-of-checked-brands').text('0');
				$(this).text('compare')
				$(brandCardCheckboxTable).css({'display': 'block'})
				$('.td-shadow').remove()
				isCompareBtnDisabled()
			}
		}

		$(compareBtn).on('click', function () {

			$(mainTable).toggleClass('compare-brands')
			$(this).text('Clear selection')

			for (let i = 0; i < 3; i++) {
				(tableTHShadow).clone().appendTo('.main-table thead tr');
				(tableTDShadow).clone().appendTo('.main-table tbody tr:odd');
				(tableTDShadowColorized).clone().appendTo('.main-table tbody tr:even');
			}

			if ($boxes.length === 1) {
				$(brandCardCheckboxTable).css({'display': 'none'})
			}

			$('#table-scroll').scrollLeft(0);


			restTable()
		})


		$(compareBtnMobile).on('click', function () {
			$(mainTable).addClass('compare-brands')
			$(brandCardCheckboxWrap).addClass('d-none')
			$(compareBtnMobileWrap).removeClass('d-block').addClass('d-none')
			$(mainTableWrap).addClass('d-block')
			$('.comparison-page').find('footer').addClass('d-block')
			$(brandCardCheckboxTable).css({'display': 'none'})
			$(clearBtnMobile).addClass('d-none')
			$(btnBackLink).removeClass('d-none')
		})


		$(clearBtnMobile).on('click', function () {
			$(clearBtnMobile).addClass('d-none')
			$(brandCardCheckboxWrap).removeClass('d-none')
			$(mainTableWrap).removeClass('d-block')
			$(mainTable).removeClass('compare-brands')
			$('.comparison-page').find('footer').removeClass('d-block')
			$(brandCardCheckboxTable).css({'display': 'block'})
			restTable()
		})

		$(btnBackLink).on('click', function () {
			$(this).addClass('d-none')
			$(brandCardCheckboxWrap).removeClass('d-none')
			$(mainTableWrap).removeClass('d-block')
			$(mainTable).removeClass('compare-brands')
			$('.comparison-page').find('footer').removeClass('d-block')
			$(brandCardCheckboxTable).css({'display': 'block'})
			restTable()
		})
	}
);
