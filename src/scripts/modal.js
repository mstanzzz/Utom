jQuery(document).ready(function ($) {
	var linkNext = $('.choose__e-type');
	var confirmInit = $('.initialize-confirm');
	var confirmSign = $('[ data-signature="signature-confirmed"]');
	var insertInit = $('[data-confirm="toggle-initialize-confirm"]');
	var btnBack = $('[data-role="back"]');
	var btnSign = $('[data-role="sign"]');
	var btnPlaceholder = $('[data-role="sign-placeholder"]');
	var btnChooseType = $('[data-role="choose-e-type"]');
	var ctaNavFooter = $('#cta-footer-nav');
	var ctaContinueFooter = $('#cta-footer-continue');

	var inputs = $('[data-inputforms="input-forms"]');
	var alertSuccess = $('[data-alert="alert-primary-initialize"]');
	var tabs = $('[data-toggle="pill"]');
	var btnContinue = $('[data-btn="continue"]');
	var btnContinueConfirm = $('[data-role="continue-confirm"]');
	var btnContinueConfirmBtn = $('[data-role="continue-confirm"] .btn');
	var btnInsert = $('[data-btn="insert"]');
	var requiredStarts = $('[data-role="required-star"]');
	var signCheck = $('[data-signature="signature-check"]');
	var alertTac = $('[data-alert="alert-agree-initialize"]');
	var agreeTac = $('[data-role="agree-with-tac"]');
	var signBack = $('[data-role="signBack"]');
	var backToCard = $('[data-role="backToCard"]');

	var isModalValid = false;



	backToCard.on('click', function () {
		signCheck.addClass('d-none');
		confirmSign.addClass('d-none');
		$('#cta-footer-continue').addClass('d-none');
		$('#cta-footer-nav').removeClass('d-none');
		btnPlaceholder.removeClass('d-none');
		btnBack.removeClass('d-none');
	});

	signBack.on('click', function () {
		$(this).addClass('d-none');
		inputs.slideDown();
		signCheck.addClass('d-none');
		confirmSign.addClass('d-none');
		$('[data-role="sign-placeholder"] .btn').addClass('d-none');
		$('#cta-footer-continue').addClass('d-none');
		$('#cta-footer-nav').removeClass('d-none');
		alertSuccess.css('display', 'none');
		inputs.css('margin-top', '0')
	});

	linkNext.on('click', function () {
		$('.modal').modal('hide');
		$('body').addClass('modal-open_custom');
	});

	$('.modal-sign .close-modal').on('click', function () {
		$('.modal').modal('hide');
		$('body').removeClass('modal-open_custom');
	});

	$('.modal').on('click', function (e) {
		if (e.target !== this) {
			return;
		}

		$('.modal').modal('hide');
		$('body').removeClass('modal-open_custom');
	})

	tabs.click(function () {
		if ($(this).is('[data-tab="continue"]')) {
			btnContinue.removeClass('d-none');
			btnInsert.addClass('d-none');
		} else {
			btnContinue.addClass('d-none');
			btnInsert.removeClass('d-none');
		}
	})

	btnSign.click(function () {
		if ($(window).width() < 992) {
			btnSign.addClass('d-none');
			ctaNavFooter.addClass('d-none');
			ctaContinueFooter.removeClass('d-none');
			inputs.css('margin-top', '60px')
		}
		btnPlaceholder.addClass('d-none');
		confirmSign.addClass('border-bottom__70');
		btnBack.addClass('d-none');
		confirmSign.removeClass('d-none');
		inputs.slideDown();
		alertSuccess.slideToggle();
		btnContinue.removeClass('d-none');
		btnContinueConfirm.removeClass('d-none');
	})

	insertInit.click(function (e) {
		e.preventDefault();
		if ($(window).width() > 992) {
			btnChooseType.addClass('d-none');
		}
		inputs.slideUp();
		confirmInit.removeClass('d-none');
		requiredStarts.removeClass('d-none');
		signCheck.removeClass('d-none');
		btnPlaceholder.removeClass('d-none');
		btnBack.removeClass('d-none');
		btnSign.prop("disabled", false).removeClass('d-none');
		signBack.removeClass('d-none');
	})

	agreeTac.click(function (e) {
		alertTac.slideToggle(function () {
			$(this).addClass('d-none');
			isModalValid = true;
			btnContinueConfirmBtn.prop("disabled", false);
		});
		if ($(window).width() < 992) {
			inputs.css('margin-top', '0px')
		}
	})

	btnContinueConfirmBtn.click(function () {
		if (!isModalValid) {
			alertTac.slideToggle();
			alertSuccess.slideToggle();
			btnContinueConfirmBtn.prop("disabled", true);
			if ($(window).width() < 992) {
				inputs.css('margin-top', '120px');
				signBack.addClass('d-none')

			}
		} else {
			$('.modal').modal('hide');
			$('body').removeClass('modal-open_custom');
			$("#modal__e-sign__success").modal("show");
			$('body').addClass('modal-open_custom');

		}
	})
});
