jQuery(document).ready(function ($) {
	let feature = $('[data-feature]');
	let featureReplaceImage = $('[data-feature="replace-image"] img');
	let chooseItemBtn = $('[data-select="choose-item-btn"]');
	let chooseItemReturn = $('[data-select="choose-item-btn-return"]');
	let bodyTag = $('[data-markup="body"]');
	let chooseItems = $('[data-filters="choose-item"]');
	let sortBy = $('[data-filters="sort-by"]');
	let sortByBtn = $('[data-select="sort-by-btn"]');
	let sortByBtnReturn = $('[data-select="sort-by-btn-return"]');
	let featureItem = $('[data-select="feature-item"]');
	let featureItemDetail = $('[data-filters="feature-item"]');
	let chooseTypesBtn = $('[data-filters="choose-types-btn"]');
	let chooseTypes = $('[data-filters="choose-types"]');
	let chooseTypeReturn = $('[data-select="choose-type-btn-return"]');
	let activateFeatureItem = $('.show-filters__item');
	let chooseItemsMainLabel = $('.category-block__filters__mobile .my-customs-select__trigger__main-label')
	let selectedSortByFilters = [];
	let sortByFilterCheckbox = $('.checkbox__ch-card__checkbox')
	let sortByFilterLabel = $('.select-custom_mobile .select-custom__option__text')
	let iconFavAnimation = $('.add-to-fav__icon_over-galery')
	let iconFavAnimationOverGalery = $('.add-to-fav__icon_save')
	let iconFavAnimationK = $('.add-to-fav__icon')


	let letBackBtn = $('.home-mobile-buttons-block__mimic .back-link')
	let featureImage;

	$(feature).on('click', function () {
		featureImage = $(this).find('img').attr('src');
		$(this).parents('.card-feature').find(featureReplaceImage).attr('src', featureImage);
		$(this).parents('.phantom-actions__dropdowns').find(feature).removeClass('active');


		if (!$(this).parents('.collapse').length) {
			$(this).parents('.phantom-actions__dropdowns').find('.collapse').collapse('hide');
			$(this).parents('.phantom-actions__dropdowns').removeClass('active')
			$(this).parents('.phantom-actions__dropdowns').find('.feature-detail__item-drop').removeClass('active')
		}

		$(this).addClass('active');

	})

	$(iconFavAnimationK).on('click', function () {
		$(this).addClass('.animate')
		$(this).toggle({effect: "scale"})
		$(this).parents().find('.img-check__icon').toggle({effect: "scale"})
		setTimeout(() => {
			$(this).parents().find('.img-check__icon').animate({opacity: 1}, 300)
		}, 500)
	})

	$(iconFavAnimation).on('click', function () {
		$(this).addClass('.animate')
		$(this).toggle({effect: "scale"})

		$('.img-check__icon').fadeIn()
	})

	$(iconFavAnimationOverGalery).on('click', function () {
		$(this).addClass('.animate')
		$(this).toggle({effect: "scale"})
		$('.img-check__icon_v2').fadeIn()
	})


	if (window.innerWidth > 991) {
		return null
	} else {

		function getSortFilters() {
			// on mobile check if "Sort By" has checked filters
			//if there aren't any, the text will be 'Sort by'
			//if we select some filters, then add them into array, that show the filters in the "Sort by" place
			if (selectedSortByFilters.length <= 0) {
				$(sortByFilterLabel).text('Sort by')
			} else {
				let chosenFilters = selectedSortByFilters.join(', ')
				$(sortByFilterLabel).text(chosenFilters)
			}
		}

		getSortFilters()

		$(chooseTypesBtn).on('click', function () {
			$(bodyTag).addClass('show-filters').removeClass('show-feature-item')
			$(featureItemDetail).removeClass('d-block')
			$(chooseTypes).addClass('d-block')
		})

		$(chooseTypeReturn).on('click', function () {
			$(bodyTag).removeClass('show-filters').addClass('show-feature-item')
			$(featureItemDetail).find('img').attr('src', $(this).find('img').attr('src'));
			$(chooseTypes).removeClass('d-block')
			$(featureItemDetail).addClass('d-block')


			setTimeout(() => {
				$(this).parents('.show-filters').find('.collapse').collapse('hide')
			}, 200)

		})


		$(chooseItemBtn).on('click', function () {
			$(bodyTag).addClass('show-filters')
			$(chooseItems).addClass('d-block')
		})

		$(chooseItemReturn).on('click', function () {
			$(bodyTag).removeClass('show-filters')
			$(chooseItems).removeClass('d-block')
			let textFromFilter = $(this).find('.text').text().trim();
			$(chooseItemsMainLabel).text(textFromFilter);
			// $(chooseItemsSmallLabel).removeClass('d-none').addClass('d-block');
		})


		$(sortByBtn).on('click', function () {
			$(bodyTag).addClass('show-filters')
			$(sortBy).addClass('d-block')
		})

		$(sortByBtnReturn).on('click', function () {
			$(bodyTag).removeClass('show-filters')
			$(sortBy).removeClass('d-block')
		})

		$(featureItem).on('click', function () {
			$(bodyTag).addClass('show-feature-item')
			$(featureItemDetail).addClass('d-block')
		})

		$(letBackBtn).on('click', function (e) {
			e.preventDefault();
			if ($('body').hasClass('show-feature-item')) {
				$(bodyTag).removeClass('show-feature-item')
				$(featureItemDetail).removeClass('d-block')
				$(chooseTypes).removeClass('d-block')
			} else {
				window.location.href = "features-category.html";
			}


		})

		$(activateFeatureItem).on('click', function () {
			if (!$(this).attr('data-select')) {
				return null
			} else {
				$(this).parents('.show-filters').find('.show-filters__item').removeClass('active')
				setTimeout(() => {
					$(this).addClass('active')
				}, 200)

			}

		})


		$(sortByFilterCheckbox).on('click', function () {
			if ($(this).is(':checked')) {
				selectedSortByFilters.push($(this).val())
			} else {
				//get the index of the unselected item
				let remIndex = jQuery.inArray($(this).val(), selectedSortByFilters)
				//remove the unselected item from array
				selectedSortByFilters.splice(remIndex, 1)
			}

			getSortFilters()
		})

		window.addEventListener('click', function (e) {
			// console.log($(e.target).hasClass('icon__back-link'));
		})
	}


});
