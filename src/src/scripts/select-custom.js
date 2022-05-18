jQuery(document).ready(function ($) {

	var selectBox = $('.select-custom');
	var selectOption = $('.select-option');
	var selectedOptionRender = $('.selected-option');
	var selectedOption = $('.select-custom__option.selected');

	selectBox.on('click', function () {
		$(this).find('.select-custom__list .selected.default').addClass('d-none')
		$(this).find('.select-custom__list').toggleClass('d-block')
		$(this).find('.select-custom__box').toggleClass('active')
		$(this).find('.hover__rotate-angle').toggleClass('rotate')
	})

	function loadDefaultOption() {

		selectBox.each(function () {
			var selected = $(this).find(selectedOption).clone();
			var render = $(this).find(selectedOptionRender);

			render.html(selected);
		})
	}

	loadDefaultOption();

	selectOption.click(function () {
		var option = $(this).clone();
		var render = $(this).closest(selectBox).find(selectedOptionRender);

		render.html(option);
	})


	// my custom select dropdown
	for (const dropdown of document.querySelectorAll(".my-custom-select-wrapper")) {
		dropdown.addEventListener('click', function () {
			this.querySelector('.my-custom-select').classList.toggle('open-select');
		})
	}

	for (const option of document.querySelectorAll(".my-custom-option")) {
		option.addEventListener('click', function () {
			if (!this.classList.contains('selected')) {
				this.parentNode.querySelector('.my-custom-option.selected').classList.remove('selected');
				this.classList.add('selected');
				this.closest('.my-custom-select').querySelector('.my-custom-select__trigger span').textContent = this.textContent;
			}
		})
	}

// window.addEventListener('click', function (e) {
//     const select = document.querySelector('.my-custom-select')
//     if (!select.contains(e.target)) {
//         select.classList.remove('open');
//     }
// });

	window.addEventListener('click', function (e) {
		for (const select of document.querySelectorAll('.my-custom-select')) {
			if (!select.contains(e.target)) {
				select.classList.remove('open-select');
			}
		}
	});


	// select dropdown contains another select dropdowns
	$('.my-custom-select-selects-wrapper').on('click', function () {
		$(this).find('.my-customs-select').toggleClass('opens-select');
	});

	// open inner select dropdown
	$('.my-custom-select-select-wrapper').on('click', function (e) {
		e.stopPropagation();
		$(this)
			.find('.my-customs-select-select')
			.toggleClass('open-second-select')
			.parents('.my-custom-select-select-wrapper')
			.siblings('.my-custom-select-select-wrapper')
			.find('.my-customs-select-select')
			.removeClass('open-second-select');
	});

	// click on the option in general select dropdown
	$('.my-customs-option').on('click', function () {
		$(this).addClass('selected').siblings('.my-customs-option').removeClass('selected');
		$(this).parents('.my-custom-select-selects-wrapper').find('.my-customs-select__trigger span').text($(this).text());

		$(this).parents('.my-custom-select-selects-wrapper').find('.my-custom-select-select-wrapper').each(function () {
			$(this).find('.my-customs-select-select-option').removeClass('selected');
			$(this).find('.my-customs-select-select__trigger').removeClass('opened');
			$(this).find('.my-customs-select-select__trigger span').text($(this).find('.js-default-value').text());
			$(this).find('.my-customs-select-select').removeClass('open-second-select');
		});
	});

	// click on the option on inner select dropdown
	$('.my-customs-select-select-option').on('click', function () {
		$(this).addClass('selected').siblings('.my-customs-select-select-option').removeClass('selected');
		$(this).parents('.my-custom-select-select-wrapper').find('.my-customs-select-select__trigger').addClass('opened');
		$(this).parents('.my-custom-select-select-wrapper').find('.my-customs-select-select__trigger span').text($(this).text());
		$(this).parents('.my-custom-select-select-wrapper').siblings('.my-custom-select-select-wrapper').each(function () {
			$(this).find('.my-customs-select-select__trigger span').text($(this).find('.js-default-value').text());
			$(this).find('.my-customs-select-select-option').removeClass('selected');
			$(this).find('.my-customs-select-select__trigger').removeClass('opened');
		});
		$(this).parents('.my-custom-select-selects-wrapper').find('.my-customs-select__trigger span').text($(this).text());
		$(this).parents('.my-custom-select-selects-wrapper').find('.my-customs-option').removeClass('selected');
		$(this).parents('.my-custom-select-selects-wrapper').find('.my-customs-select').removeClass('opens-select');
	});

	window.addEventListener('click', function (e) {
		for (const secondSelect of document.querySelectorAll('.my-customs-select')) {
			if (!secondSelect.contains(e.target)) {
				secondSelect.classList.remove('opens-select');
			}
		}
	});


	// select dropdown with checkboxes 
	function checkboxDropdown(el) {
		var $el = $(el)

		function updateStatus(label, result) {
			if (!result.length) {
				label.html($el.find('.dropdown-label').attr('data-default-text') + '<span></span>');
			}
		};

		$el.each(function (i, element) {
			var $list = $(this).find('.dropdown-list'),
				$label = $(this).find('.dropdown-label'),
				$inputs = $(this).find('.check'),
				$clearBtn = $(this).siblings('.js-clear-all-product-filters'),
				defaultChecked = $(this).find('input[type=checkbox]:checked'),
				result = [];

			updateStatus($label, result);

			if (defaultChecked.length) {
				defaultChecked.each(function () {
					result.push($(this).next().text());
					$label.html(result.join(", "));
				});
			}

			$label.on('click', () => {
				$(this).toggleClass('open');
			});

			$inputs.on('change', function () {
				var checked = $(this).is(':checked');
				var checkedText = $(this).next().text();
				if (checked) {
					result.push(checkedText);
					$label.html(result.join(",<br>") + '<span class="not-empty"></span>');
				} else {
					let index = result.indexOf(checkedText);
					if (index >= 0) {
						result.splice(index, 1);
					}
					$label.html(result.join(",<br>") + '<span class="not-empty"></span>');
				}
				updateStatus($label, result);
			});

			$clearBtn.on('click', function () {
				$(this).css('display', 'none');
				result.splice(0, result.length);
				$label.html($label.attr('data-default-text') + '<span></span>');
				$inputs.prop('checked', false);
			});

			$(document).on('click touchstart', e => {
				if (!$(e.target).closest($(this)).length) {
					$(this).removeClass('open');
				}
			});
		});
	};

	if ($('.dropdown').length >= 1) {
		$('.dropdown').each(function () {
			checkboxDropdown($(this));
		});
	}


	$('.multiselectbox').selectpicker();

	$('.bootstrap-select__ctg__wrap .js-clear-filter').on('click', () => {
		$('.bootstrap-select__ctg__wrap .multiselectbox').selectpicker('deselectAll');
	})


});
