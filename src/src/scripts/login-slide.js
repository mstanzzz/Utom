jQuery(document).ready(function ($) {
	var toggleRegister = $('[data-role="toggle-el"]');
	var toggleRegisterTarget = $('[data-role="toggle-el-target"]');

	toggleRegister.click(function () {
		$('.nav-link').removeClass('active');
		$(this).addClass('active');
		toggleRegisterTarget.slideToggle();
	})

});
