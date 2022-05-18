import {each} from "jquery";
import {mobilePredNextButtons} from "./functions";

jQuery(document).ready(function ($) {

	// full mobile about us modals
	$('.modal-open').on('click', function () {
		var texts = $(this).closest('div').siblings('.js-show-text').html().split('<br><br>');
		var modalId = $(this).attr('data-target');
		var imgs = $(this).attr('data-img-path');

		if (texts.length > 1) {
			if (imgs) {
				if (imgs.split(';').length > 1) {
					var splitImgs = imgs.split(';');

					// if separated text is equal to separated images
					if (texts.length === splitImgs.length) {
						for (var i = 0; i < texts.length; i++) {
							$(modalId)
								.find('.modal-body')
								.append('<p class="about-us-modal__text">' + texts[i] + '</p><img src="' + splitImgs[i] + '" alt="" class="about-us-modal__image img-fluid"/>');
						}
					}

					// if separated text is bigger to separated images
					if (texts.length > splitImgs.length) {
						for (var i = 0; i < texts.length; i++) {
							if (splitImgs[i] !== undefined && splitImgs[i] !== "") {
								$(modalId)
									.find('.modal-body')
									.append('<p class="about-us-modal__text">' + texts[i] + '</p><img src="' + splitImgs[i] + '" alt="" class="about-us-modal__image img-fluid"/>');
							} else {
								$(modalId)
									.find('.modal-body')
									.append('<p class="about-us-modal__text">' + texts[i] + '</p>');
							}
						}
					}

					// if separated text is smaller to separated images
					if (texts.length < splitImgs.length) {
						for (var i = 0; i < splitImgs.length; i++) {
							if (texts[i] !== undefined && texts[i] !== "") {
								$(modalId)
									.find('.modal-body')
									.append('<img src="' + splitImgs[i] + '" alt="" class="about-us-modal__image img-fluid"/><p class="about-us-modal__text">' + texts[i] + '</p>');
							} else {
								$(modalId)
									.find('.modal-body')
									.append('<img src="' + splitImgs[i] + '" alt="" class="about-us-modal__image img-fluid"/>');
							}
						}
					}
				}
				// if we have only on imaga
				else {
					for (var i = 0; i < texts.length; i++) {
						if (i === 0) {
							$(modalId)
								.find('.modal-body')
								.append('<p class="about-us-modal__text">' + texts[i] + '</p><img src="' + imgs + '" alt="" class="about-us-modal__image img-fluid"/>');
						} else {
							$(modalId).find('.modal-body').append('<p class="about-us-modal__text">' + texts[i] + '</p>');
						}
					}
				}
			}
			// without images
			else {
				for (var i = 0; i < texts.length; i++) {
					$(modalId).find('.modal-body').append('<p class="about-us-modal__text">' + texts[i] + '</p>');
				}
			}
		}
	});

	//open mobile team gallery
	$('#js-team-galery-btn').on('click', function (e) {
		e.preventDefault();
		var modalId = $(this).attr('data-target'),
			cloneTeam = $('#js-team-galery').clone(),
			cloneTeamFirstText = $('.js-team-galery-first-test').clone(),
			cloneTeamSecondText = $('.js-team-galery-second-test').clone();

		$(modalId).find('.modal-body').append(cloneTeam).append(cloneTeamFirstText).append(cloneTeamSecondText);

		$(modalId).find('.modal-body').find('.desktop-show').removeClass('desktop-show');
		$(modalId).find('.js-team-galery-second-test').css('background', '#ffffff')
		$(modalId).find('.modal-body').find('.simple-block__border').addClass('p-0');
	});

	//open mobile timeline
	$('#js-mobile-time-line-btn').on('click', function (e) {
		e.preventDefault();
		var modalId = $(this).attr('data-target');
		var cloneTimeLine = $('#js-show-mobile-time-line').clone();
		$(modalId).find('.modal-body').append(cloneTimeLine);
		$(modalId).find('.mobile-content').removeClass('mobile-content');
		$(modalId).find('.mobile-small-text').removeClass('mobile-small-text');
		$(modalId).find('.js-remove-for-modal').remove();
	});

	//open mobile catalog
	$('.js-show-mobile-catalog-btn').on('click', function (e) {
		e.preventDefault();
		var modalId = $(this).attr('data-target'),
			mobileCatalogContent = $('#js-show-mobile-catalog').clone();

		$(modalId).find('.modal-body').append(mobileCatalogContent);
	});

	//clear mobile modals
	$('.about-us-modal-close').on('click', function (e) {
		e.preventDefault();
		$(this).parent().siblings('.modal-body').empty();
	});

	$('body').on('click', function () {
		$(this).find('.custom-fixed-modal').removeClass('active');
		$(this).find('.four-elements-block__wrapper--image img').removeClass('bordered-img');
	});

	$('body').on('click', '.custom-fixed-modal', function (event) {
		event.stopPropagation();
	});

	//open custom fixed element for more information about the employee
	$('body').on('click', '.js-open-custom-modal', function (event) {
		event.stopPropagation();

		var elem = $(this).attr('data-custom-modal-id');

		$(this).parents('#js-team-galery').find('.four-elements-block__wrapper--img').removeClass('bordered-img');
		$(this).parents('figure.four-elements-block__wrapper').find('.four-elements-block__wrapper--img').addClass('bordered-img');
		$(elem).addClass('active');
		$(elem).find('.js-hide-custom-fixed-modal').attr('data-employee-ID', $(this).attr('data-employee-ID'));
	});

	// close custom fixed element for more information about the employee
	$('.js-hide-custom-fixed-modal').on('click', function () {
		var elem = $(this).attr('data-custom-modal-id'),
			btn = $('button.js-open-custom-modal[data-employee-ID="' + $(this).attr('data-employee-ID') + '"]');

		$(btn).siblings('img').removeClass('bordered-img');
		$(elem).removeClass('active');
	});


	const container = document.getElementById('infinite-block');
	const loading = document.querySelector('.loading');

	// getPost();
	// getPost();
	// getPost();

	window.addEventListener('scroll', () => {
		const {scrollTop, scrollHeight, clientHeight} = document.documentElement;

		//  console.log( { scrollTop, scrollHeight, clientHeight });

		if (clientHeight + scrollTop >= scrollHeight - 5) {
			// show the loading animation
			showLoading();
		}
	});

	function showLoading() {
		loading.classList.add('show');

	// load more data
	// setTimeout(getPost, 100)
		setTimeout(getPost)
	}

	async function getPost() {
		const postResponse = await fetch(`https://jsonplaceholder.typicode.com/posts/${getRandomNr()}`);
		const postData = await postResponse.json();

		// return postData
		const userResponse = await fetch('https://randomuser.me/api');
		const userData = await userResponse.json();

		const data = {post: postData, user: userData.results[0]};

		addDataToDOM(data);
	}

	// getPost().then(post => {
	// 	console.log(post);
	// })

	function getRandomNr() {
		return Math.floor(Math.random() * 100) + 1;
	}

	function addDataToDOM(data) {
		const postElement = document.createElement('ul');
		postElement.classList.add('blog-post');
		postElement.setAttribute('data-sub-html', 'Product description 1');
		postElement.innerHTML = `
		<ul id="html5-products" class="accessories-products">
		<li data-sub-html="Product description 1">
		   <div>
			  <div class="product-image">
				 <img src="images/accessories-product-1.png"
					alt=""
					class="">
			  </div>
			  <p class="product-title">Lorem ipsum dolor sit amet, consetetur sadipscing</p>
			  <p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>
			  <div class="share-product-accessories">
				 <a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
					   <defs>
						  <style>.share-no-background{fill:#384765;}</style>
					   </defs>
					   <g transform="translate(0)">
						  <path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
						  <path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
						  <path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
						  <path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
						  <path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
						  <path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
						  <path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
						  <path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
					   </g>
					</svg>
				 </a>
                           <div class="animating-imgs__wrap showroom-detail-view-product-page idea-folder __square" data-toggle="modal" data-target="#saveToIdeaFolder">
                              <div class="icons icon-share__circle icon-share__circle__fff add-to-fav animate-pulse add-to-fav__icon_over-galery">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="24"
                                   height="28" viewBox="0 -2 25.6 23.023">
                                   <path id="Path_205" data-name="Path 205"
                                     d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
                                     transform="translate(0 -0.963)"
                                     fill="#fff"></path>
                                   <path id="Path_207" data-name="Path 207"
                                     d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
                                     fill="#18c4c7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav img-check__icon"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="33"
                                   height="34"
                                   viewBox="-5 -6 36.189 40.043">
                                   <path id="Path_419" class="icon__scale-down"
                                     data-name="Path 419"
                                     d="M26.825,5.154v7.964a1.048,1.048,0,0,1-1.048,1.048H25.2a1.048,1.048,0,0,1-.759-.325L19.882,9.06,11.764,19.423a1.048,1.048,0,0,1-.825.4h0a1.048,1.048,0,0,1-.825-.4L7.342,15.876,5.859,17.8A1.048,1.048,0,0,1,4.2,16.525l2.306-3a1.048,1.048,0,0,1,.826-.409h0a1.048,1.048,0,0,1,.826.4l2.779,3.556,8.04-10.263a1.048,1.048,0,0,1,1.583-.077l4.167,4.369V5.154a2.1,2.1,0,0,0-2.1-2.1H4.191a2.1,2.1,0,0,0-2.1,2.1v14.67a2.1,2.1,0,0,0,2.1,2.1h6.863a1.048,1.048,0,0,1,0,2.1H4.191A4.2,4.2,0,0,1,0,19.825V5.154A4.2,4.2,0,0,1,4.191.963H22.634A4.2,4.2,0,0,1,26.825,5.154ZM4.191,7.879a3.144,3.144,0,1,1,3.144,3.144A3.147,3.147,0,0,1,4.191,7.879Zm2.1,0A1.048,1.048,0,1,0,7.335,6.831,1.049,1.049,0,0,0,6.287,7.879Z"
                                     fill="#fff"/>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="16" height="14"
                                     rx="2"
                                     fill="#18c4c7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_460" class="icon__scale-up"
                                     data-name="Path 460"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-idea-folder __square">
                                 <div class="icon">
                                   <img src="images/idea-folder-icon.png">
                                 </div>
                                 <span>Save to My Inspirations</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                            </div>
                            <div class="animating-imgs__wrap showroom-detail-view-product-page save-to-specs-sheet __square" data-toggle="modal" data-target="#saveToSpecSheet">
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav animate-pulse add-to-fav__icon_save">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="6 6 24 24">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#fff"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#fff"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" fill="#18C4C7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 save-v2 add-to-fav img-check__icon_v2"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="40"
                                   height="40"
                                   viewBox="2 4 27.189 27.043">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="17" cy="17" r="15" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#18c4c7" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_2319" class="bg-plus" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"></path>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="12" height="12"
                                     rx="55"
                                     fill="#18C4C7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_4600" class="icon__scale-up"
                                     data-name="Path 460"
                                     fill="#fff"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-spec-folder __square">
                                 <div class="icon">
                                   <img src="images/spec-folder-icon.png">
                                 </div>
                                 <span>Save to spec folder</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                           </div> 
			  </div>
			  <div class="see-detail-product-accessories">
				 <p><a href="product-detail-view.html">See details</a></p>
			  </div>
			  <div class="stars-review-price-btn">
				 <div class=" stars-product-accessories">
					<div class="stars-container">
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <img src="images/stars.svg" alt="">
					</div>
				 </div>
				 <div class="reviews-counter-product-accessories">
					<p>115 reviews</p>
				 </div>
				 <div class="price">
					<p>Price: $10</p>
				 </div>
				 <div class="btn-add-to-cart">
					<span class="card-el__hide-on-md">
					quick add to cart
					</span>
				 </div>
			  </div>
		   </div>
		</li>
		<li data-sub-html="Product description 1">
		   <div>
			  <div class="product-image">
				 <img src="images/accessories-product-2.png"
					alt=""
					class="">
			  </div>
			  <p class="product-title">Lorem ipsum dolor sit amet, consetetur sadipscing</p>
			  <p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>
			  <div class="share-product-accessories">
				 <a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
					   <defs>
						  <style>.share-no-background{fill:#384765;}</style>
					   </defs>
					   <g transform="translate(0)">
						  <path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
						  <path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
						  <path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
						  <path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
						  <path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
						  <path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
						  <path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
						  <path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
					   </g>
					</svg>
				 </a>
                           <div class="animating-imgs__wrap showroom-detail-view-product-page idea-folder __square" data-toggle="modal" data-target="#saveToIdeaFolder">
                              <div class="icons icon-share__circle icon-share__circle__fff add-to-fav animate-pulse add-to-fav__icon_over-galery">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="24"
                                   height="28" viewBox="0 -2 25.6 23.023">
                                   <path id="Path_205" data-name="Path 205"
                                     d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
                                     transform="translate(0 -0.963)"
                                     fill="#fff"></path>
                                   <path id="Path_207" data-name="Path 207"
                                     d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
                                     fill="#18c4c7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav img-check__icon"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="33"
                                   height="34"
                                   viewBox="-5 -6 36.189 40.043">
                                   <path id="Path_419" class="icon__scale-down"
                                     data-name="Path 419"
                                     d="M26.825,5.154v7.964a1.048,1.048,0,0,1-1.048,1.048H25.2a1.048,1.048,0,0,1-.759-.325L19.882,9.06,11.764,19.423a1.048,1.048,0,0,1-.825.4h0a1.048,1.048,0,0,1-.825-.4L7.342,15.876,5.859,17.8A1.048,1.048,0,0,1,4.2,16.525l2.306-3a1.048,1.048,0,0,1,.826-.409h0a1.048,1.048,0,0,1,.826.4l2.779,3.556,8.04-10.263a1.048,1.048,0,0,1,1.583-.077l4.167,4.369V5.154a2.1,2.1,0,0,0-2.1-2.1H4.191a2.1,2.1,0,0,0-2.1,2.1v14.67a2.1,2.1,0,0,0,2.1,2.1h6.863a1.048,1.048,0,0,1,0,2.1H4.191A4.2,4.2,0,0,1,0,19.825V5.154A4.2,4.2,0,0,1,4.191.963H22.634A4.2,4.2,0,0,1,26.825,5.154ZM4.191,7.879a3.144,3.144,0,1,1,3.144,3.144A3.147,3.147,0,0,1,4.191,7.879Zm2.1,0A1.048,1.048,0,1,0,7.335,6.831,1.049,1.049,0,0,0,6.287,7.879Z"
                                     fill="#fff"/>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="16" height="14"
                                     rx="2"
                                     fill="#18c4c7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_460" class="icon__scale-up"
                                     data-name="Path 460"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-idea-folder __square">
                                 <div class="icon">
                                   <img src="images/idea-folder-icon.png">
                                 </div>
                                 <span>Save to My Inspirations</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                            </div>
                            <div class="animating-imgs__wrap showroom-detail-view-product-page save-to-specs-sheet __square" data-toggle="modal" data-target="#saveToSpecSheet">
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav animate-pulse add-to-fav__icon_save">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="6 6 24 24">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#fff"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#fff"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" fill="#18C4C7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 save-v2 add-to-fav img-check__icon_v2"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="40"
                                   height="40"
                                   viewBox="2 4 27.189 27.043">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="17" cy="17" r="15" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#18c4c7" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_2319" class="bg-plus" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"></path>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="12" height="12"
                                     rx="55"
                                     fill="#18C4C7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_4600" class="icon__scale-up"
                                     data-name="Path 460"
                                     fill="#fff"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-spec-folder __square">
                                 <div class="icon">
                                   <img src="images/spec-folder-icon.png">
                                 </div>
                                 <span>Save to spec folder</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                           </div> 
			  </div>
			  <div class="see-detail-product-accessories">
				 <p><a href="product-detail-view.html">See details</a></p>
			  </div>
			  <div class="stars-review-price-btn">
				 <div class=" stars-product-accessories">
					<div class="stars-container">
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <img src="images/stars.svg" alt="">
					</div>
				 </div>
				 <div class="reviews-counter-product-accessories">
					<p>115 reviews</p>
				 </div>
				 <div class="price">
					<p>Price: $10</p>
				 </div>
				 <div class="btn-add-to-cart">
					<span class="card-el__hide-on-md">
					quick add to cart
					</span>
				 </div>
			  </div>
		   </div>
		</li>
		<li data-sub-html="Product description 1">
		   <div>
			  <div class="product-image">
				 <img src="images/accessories-product-3.png"
					alt=""
					class="">
			  </div>
			  <p class="product-title">Lorem ipsum dolor sit amet, consetetur sadipscing</p>
			  <p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>
			  <div class="share-product-accessories">
				 <a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
					   <defs>
						  <style>.share-no-background{fill:#384765;}</style>
					   </defs>
					   <g transform="translate(0)">
						  <path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
						  <path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
						  <path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
						  <path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
						  <path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
						  <path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
						  <path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
						  <path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
					   </g>
					</svg>
				 </a>
                           <div class="animating-imgs__wrap showroom-detail-view-product-page idea-folder __square" data-toggle="modal" data-target="#saveToIdeaFolder">
                              <div class="icons icon-share__circle icon-share__circle__fff add-to-fav animate-pulse add-to-fav__icon_over-galery">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="24"
                                   height="28" viewBox="0 -2 25.6 23.023">
                                   <path id="Path_205" data-name="Path 205"
                                     d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
                                     transform="translate(0 -0.963)"
                                     fill="#fff"></path>
                                   <path id="Path_207" data-name="Path 207"
                                     d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
                                     fill="#18c4c7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav img-check__icon"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="33"
                                   height="34"
                                   viewBox="-5 -6 36.189 40.043">
                                   <path id="Path_419" class="icon__scale-down"
                                     data-name="Path 419"
                                     d="M26.825,5.154v7.964a1.048,1.048,0,0,1-1.048,1.048H25.2a1.048,1.048,0,0,1-.759-.325L19.882,9.06,11.764,19.423a1.048,1.048,0,0,1-.825.4h0a1.048,1.048,0,0,1-.825-.4L7.342,15.876,5.859,17.8A1.048,1.048,0,0,1,4.2,16.525l2.306-3a1.048,1.048,0,0,1,.826-.409h0a1.048,1.048,0,0,1,.826.4l2.779,3.556,8.04-10.263a1.048,1.048,0,0,1,1.583-.077l4.167,4.369V5.154a2.1,2.1,0,0,0-2.1-2.1H4.191a2.1,2.1,0,0,0-2.1,2.1v14.67a2.1,2.1,0,0,0,2.1,2.1h6.863a1.048,1.048,0,0,1,0,2.1H4.191A4.2,4.2,0,0,1,0,19.825V5.154A4.2,4.2,0,0,1,4.191.963H22.634A4.2,4.2,0,0,1,26.825,5.154ZM4.191,7.879a3.144,3.144,0,1,1,3.144,3.144A3.147,3.147,0,0,1,4.191,7.879Zm2.1,0A1.048,1.048,0,1,0,7.335,6.831,1.049,1.049,0,0,0,6.287,7.879Z"
                                     fill="#fff"/>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="16" height="14"
                                     rx="2"
                                     fill="#18c4c7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_460" class="icon__scale-up"
                                     data-name="Path 460"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-idea-folder __square">
                                 <div class="icon">
                                   <img src="images/idea-folder-icon.png">
                                 </div>
                                 <span>Save to My Inspirations</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                            </div>
                            <div class="animating-imgs__wrap showroom-detail-view-product-page save-to-specs-sheet __square" data-toggle="modal" data-target="#saveToSpecSheet">
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav animate-pulse add-to-fav__icon_save">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="6 6 24 24">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#fff"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#fff"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" fill="#18C4C7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 save-v2 add-to-fav img-check__icon_v2"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="40"
                                   height="40"
                                   viewBox="2 4 27.189 27.043">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="17" cy="17" r="15" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#18c4c7" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_2319" class="bg-plus" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"></path>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="12" height="12"
                                     rx="55"
                                     fill="#18C4C7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_4600" class="icon__scale-up"
                                     data-name="Path 460"
                                     fill="#fff"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-spec-folder __square">
                                 <div class="icon">
                                   <img src="images/spec-folder-icon.png">
                                 </div>
                                 <span>Save to spec folder</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                           </div> 
			  </div>
			  <div class="see-detail-product-accessories">
				 <p><a href="product-detail-view.html">See details</a></p>
			  </div>
			  <div class="stars-review-price-btn">
				 <div class=" stars-product-accessories">
					<div class="stars-container">
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <img src="images/stars.svg" alt="">
					</div>
				 </div>
				 <div class="reviews-counter-product-accessories">
					<p>115 reviews</p>
				 </div>
				 <div class="price">
					<p>Price: $10</p>
				 </div>
				 <div class="btn-add-to-cart">
					<span class="card-el__hide-on-md">
					quick add to cart
					</span>
				 </div>
			  </div>
		   </div>
		</li>
		<li data-sub-html="Product description 1">
		   <div>
			  <div class="product-image">
				 <img src="images/accessories-product-4.png"
					alt=""
					class="">
			  </div>
			  <p class="product-title">Lorem ipsum dolor sit amet, consetetur sadipscing</p>
			  <p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>
			  <div class="share-product-accessories">
				 <a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
					   <defs>
						  <style>.share-no-background{fill:#384765;}</style>
					   </defs>
					   <g transform="translate(0)">
						  <path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
						  <path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
						  <path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
						  <path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
						  <path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
						  <path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
						  <path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
						  <path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
					   </g>
					</svg>
				 </a>
                           <div class="animating-imgs__wrap showroom-detail-view-product-page idea-folder __square" data-toggle="modal" data-target="#saveToIdeaFolder">
                              <div class="icons icon-share__circle icon-share__circle__fff add-to-fav animate-pulse add-to-fav__icon_over-galery">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="24"
                                   height="28" viewBox="0 -2 25.6 23.023">
                                   <path id="Path_205" data-name="Path 205"
                                     d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
                                     transform="translate(0 -0.963)"
                                     fill="#fff"></path>
                                   <path id="Path_207" data-name="Path 207"
                                     d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
                                     fill="#18c4c7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav img-check__icon"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="33"
                                   height="34"
                                   viewBox="-5 -6 36.189 40.043">
                                   <path id="Path_419" class="icon__scale-down"
                                     data-name="Path 419"
                                     d="M26.825,5.154v7.964a1.048,1.048,0,0,1-1.048,1.048H25.2a1.048,1.048,0,0,1-.759-.325L19.882,9.06,11.764,19.423a1.048,1.048,0,0,1-.825.4h0a1.048,1.048,0,0,1-.825-.4L7.342,15.876,5.859,17.8A1.048,1.048,0,0,1,4.2,16.525l2.306-3a1.048,1.048,0,0,1,.826-.409h0a1.048,1.048,0,0,1,.826.4l2.779,3.556,8.04-10.263a1.048,1.048,0,0,1,1.583-.077l4.167,4.369V5.154a2.1,2.1,0,0,0-2.1-2.1H4.191a2.1,2.1,0,0,0-2.1,2.1v14.67a2.1,2.1,0,0,0,2.1,2.1h6.863a1.048,1.048,0,0,1,0,2.1H4.191A4.2,4.2,0,0,1,0,19.825V5.154A4.2,4.2,0,0,1,4.191.963H22.634A4.2,4.2,0,0,1,26.825,5.154ZM4.191,7.879a3.144,3.144,0,1,1,3.144,3.144A3.147,3.147,0,0,1,4.191,7.879Zm2.1,0A1.048,1.048,0,1,0,7.335,6.831,1.049,1.049,0,0,0,6.287,7.879Z"
                                     fill="#fff"/>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="16" height="14"
                                     rx="2"
                                     fill="#18c4c7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_460" class="icon__scale-up"
                                     data-name="Path 460"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-idea-folder __square">
                                 <div class="icon">
                                   <img src="images/idea-folder-icon.png">
                                 </div>
                                 <span>Save to My Inspirations</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                            </div>
                            <div class="animating-imgs__wrap showroom-detail-view-product-page save-to-specs-sheet __square" data-toggle="modal" data-target="#saveToSpecSheet">
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav animate-pulse add-to-fav__icon_save">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="6 6 24 24">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#fff"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#fff"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" fill="#18C4C7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 save-v2 add-to-fav img-check__icon_v2"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="40"
                                   height="40"
                                   viewBox="2 4 27.189 27.043">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="17" cy="17" r="15" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#18c4c7" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_2319" class="bg-plus" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"></path>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="12" height="12"
                                     rx="55"
                                     fill="#18C4C7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_4600" class="icon__scale-up"
                                     data-name="Path 460"
                                     fill="#fff"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-spec-folder __square">
                                 <div class="icon">
                                   <img src="images/spec-folder-icon.png">
                                 </div>
                                 <span>Save to spec folder</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                           </div> 
			  </div>
			  <div class="see-detail-product-accessories">
				 <p><a href="product-detail-view.html">See details</a></p>
			  </div>
			  <div class="stars-review-price-btn">
				 <div class=" stars-product-accessories">
					<div class="stars-container">
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <img src="images/stars.svg" alt="">
					</div>
				 </div>
				 <div class="reviews-counter-product-accessories">
					<p>115 reviews</p>
				 </div>
				 <div class="price">
					<p>Price: $10</p>
				 </div>
				 <div class="btn-add-to-cart">
					<span class="card-el__hide-on-md">
					quick add to cart
					</span>
				 </div>
			  </div>
		   </div>
		</li>
		<li data-sub-html="Product description 1">
		   <div>
			  <div class="product-image">
				 <img src="images/accessories-product-5.png"
					alt=""
					class="">
			  </div>
			  <p class="product-title">Lorem ipsum dolor sit amet, consetetur sadipscing</p>
			  <p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>
			  <div class="share-product-accessories">
				 <a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
					   <defs>
						  <style>.share-no-background{fill:#384765;}</style>
					   </defs>
					   <g transform="translate(0)">
						  <path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
						  <path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
						  <path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
						  <path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
						  <path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
						  <path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
						  <path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
						  <path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
					   </g>
					</svg>
				 </a>
                           <div class="animating-imgs__wrap showroom-detail-view-product-page idea-folder __square" data-toggle="modal" data-target="#saveToIdeaFolder">
                              <div class="icons icon-share__circle icon-share__circle__fff add-to-fav animate-pulse add-to-fav__icon_over-galery">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="24"
                                   height="28" viewBox="0 -2 25.6 23.023">
                                   <path id="Path_205" data-name="Path 205"
                                     d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
                                     transform="translate(0 -0.963)"
                                     fill="#fff"></path>
                                   <path id="Path_207" data-name="Path 207"
                                     d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
                                     fill="#18c4c7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav img-check__icon"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="33"
                                   height="34"
                                   viewBox="-5 -6 36.189 40.043">
                                   <path id="Path_419" class="icon__scale-down"
                                     data-name="Path 419"
                                     d="M26.825,5.154v7.964a1.048,1.048,0,0,1-1.048,1.048H25.2a1.048,1.048,0,0,1-.759-.325L19.882,9.06,11.764,19.423a1.048,1.048,0,0,1-.825.4h0a1.048,1.048,0,0,1-.825-.4L7.342,15.876,5.859,17.8A1.048,1.048,0,0,1,4.2,16.525l2.306-3a1.048,1.048,0,0,1,.826-.409h0a1.048,1.048,0,0,1,.826.4l2.779,3.556,8.04-10.263a1.048,1.048,0,0,1,1.583-.077l4.167,4.369V5.154a2.1,2.1,0,0,0-2.1-2.1H4.191a2.1,2.1,0,0,0-2.1,2.1v14.67a2.1,2.1,0,0,0,2.1,2.1h6.863a1.048,1.048,0,0,1,0,2.1H4.191A4.2,4.2,0,0,1,0,19.825V5.154A4.2,4.2,0,0,1,4.191.963H22.634A4.2,4.2,0,0,1,26.825,5.154ZM4.191,7.879a3.144,3.144,0,1,1,3.144,3.144A3.147,3.147,0,0,1,4.191,7.879Zm2.1,0A1.048,1.048,0,1,0,7.335,6.831,1.049,1.049,0,0,0,6.287,7.879Z"
                                     fill="#fff"/>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="16" height="14"
                                     rx="2"
                                     fill="#18c4c7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_460" class="icon__scale-up"
                                     data-name="Path 460"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-idea-folder __square">
                                 <div class="icon">
                                   <img src="images/idea-folder-icon.png">
                                 </div>
                                 <span>Save to My Inspirations</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                            </div>
                            <div class="animating-imgs__wrap showroom-detail-view-product-page save-to-specs-sheet __square" data-toggle="modal" data-target="#saveToSpecSheet">
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav animate-pulse add-to-fav__icon_save">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="6 6 24 24">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#fff"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#fff"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" fill="#18C4C7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 save-v2 add-to-fav img-check__icon_v2"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="40"
                                   height="40"
                                   viewBox="2 4 27.189 27.043">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="17" cy="17" r="15" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#18c4c7" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_2319" class="bg-plus" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"></path>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="12" height="12"
                                     rx="55"
                                     fill="#18C4C7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_4600" class="icon__scale-up"
                                     data-name="Path 460"
                                     fill="#fff"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-spec-folder __square">
                                 <div class="icon">
                                   <img src="images/spec-folder-icon.png">
                                 </div>
                                 <span>Save to spec folder</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                           </div> 
			  </div>
			  <div class="see-detail-product-accessories">
				 <p><a href="product-detail-view.html">See details</a></p>
			  </div>
			  <div class="stars-review-price-btn">
				 <div class=" stars-product-accessories">
					<div class="stars-container">
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <img src="images/stars.svg" alt="">
					</div>
				 </div>
				 <div class="reviews-counter-product-accessories">
					<p>115 reviews</p>
				 </div>
				 <div class="price">
					<p>Price: $10</p>
				 </div>
				 <div class="btn-add-to-cart">
					<span class="card-el__hide-on-md">
					quick add to cart
					</span>
				 </div>
			  </div>
		   </div>
		</li>
	 </ul>
	 <ul id="html5-videos" class="accessories-products landscape-accessories-products">
		<li data-sub-html="Product description 1" data-html="#video1">
			<div>
			<div>
				<img class="landscape-images" src="images/accessories-product-6.png" alt="">
			</div>
			<p class="product-title">Lorem ipsum dolor sit amet...</p>
			<p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elit,invid ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd</p>
			</div>
			<div class="stars-review-counter-accessories">
			<div class="stars-container">
				<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
					<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
				</svg>
				<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
					<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
				</svg>
				<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
					<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
				</svg>
				<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
					<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
				</svg>
				<img src="images/stars.svg" alt="">
			</div>
			<div class="reviews-counter-product-accessories">
				<p>115 reviews</p>
			</div>
			<div class="price">
				<p>Price: $10</p>
			</div>
			</div>
			<div class="see-detail-product-accessories">
			<a href="#">
				<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
					<defs>
						<style>.share-no-background{fill:#384765;}</style>
					</defs>
					<g transform="translate(0)">
						<path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
						<path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
						<path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
						<path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
						<path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
						<path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
						<path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
						<path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
					</g>
				</svg>
			</a>
			<div class="animating-imgs__wrap showroom-detail-view-product-page idea-folder __square" data-toggle="modal" data-target="#saveToIdeaFolder">
				<div class="icons icon-share__circle icon-share__circle__fff add-to-fav animate-pulse add-to-fav__icon_over-galery">
					<svg id="Save" xmlns="http://www.w3.org/2000/svg" width="24"
					height="28" viewBox="0 -2 25.6 23.023">
					<path id="Path_205" data-name="Path 205"
						d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
						transform="translate(0 -0.963)"
						fill="#18c4c7"></path>
					<path id="Path_207" data-name="Path 207"
						d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
						fill="#18c4c7"></path>
					</svg>
				</div>
				<div class="icons icon-share__circle icon-share__circle__18C4C77 add-to-fav img-check__icon"
					style="display: none">
					<svg id="img-check" class="img-check" data-name="Group 781"
					xmlns="http://www.w3.org/2000/svg" width="36"
					height="36"
					viewBox="-2 -2 32.189 34.043">
					<path id="Path_419" class="icon__scale-down"
						data-name="Path 419"
						d="M26.825,5.154v7.964a1.048,1.048,0,0,1-1.048,1.048H25.2a1.048,1.048,0,0,1-.759-.325L19.882,9.06,11.764,19.423a1.048,1.048,0,0,1-.825.4h0a1.048,1.048,0,0,1-.825-.4L7.342,15.876,5.859,17.8A1.048,1.048,0,0,1,4.2,16.525l2.306-3a1.048,1.048,0,0,1,.826-.409h0a1.048,1.048,0,0,1,.826.4l2.779,3.556,8.04-10.263a1.048,1.048,0,0,1,1.583-.077l4.167,4.369V5.154a2.1,2.1,0,0,0-2.1-2.1H4.191a2.1,2.1,0,0,0-2.1,2.1v14.67a2.1,2.1,0,0,0,2.1,2.1h6.863a1.048,1.048,0,0,1,0,2.1H4.191A4.2,4.2,0,0,1,0,19.825V5.154A4.2,4.2,0,0,1,4.191.963H22.634A4.2,4.2,0,0,1,26.825,5.154ZM4.191,7.879a3.144,3.144,0,1,1,3.144,3.144A3.147,3.147,0,0,1,4.191,7.879Zm2.1,0A1.048,1.048,0,1,0,7.335,6.831,1.049,1.049,0,0,0,6.287,7.879Z"
						fill="#fff"/>
					<rect id="Rectangle_148" class="icon__scale-down"
						data-name="Rectangle 148" width="16" height="14"
						rx="2"
						fill="#18c4c7"/>
					<!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
					<path id="Path_460" class="icon__scale-up"
						data-name="Path 460"
						d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
					<!--															</g>-->
					</svg>
				</div>
				<div class="info-popup-idea-folder __square">
					<div class="icon">
					<img src="images/idea-folder-icon.png">
					</div>
					<span>Save to My Inspirations</span>
					<p>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
					</p>
				</div>
				</div>
				<div class="animating-imgs__wrap showroom-detail-view-product-page save-to-specs-sheet __square" data-toggle="modal" data-target="#saveToSpecSheet">
				<div class="icons icon-share__circle icon-share__circle__18C4C77 add-to-fav animate-pulse add-to-fav__icon_save">
					<svg id="Save" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="7 7 20 20">
					<circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16" fill="#18C4C7"></circle>
					<g id="Group_597" data-name="Group 597" transform="translate(0.068)">
						<path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#fff"></path>
						<path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#fff"></path>
					</g>
					<circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
					<path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" fill="#18C4C7"></path>
					</svg>
				</div>
				<div class="icons icon-share__circle icon-share__circle__18C4C77 save-v2 add-to-fav img-check__icon_v2"
					style="display: none">
					<svg id="img-check" class="img-check" data-name="Group 781"
					xmlns="http://www.w3.org/2000/svg" width="40"
					height="40"
					viewBox="6 5 23 23">
					<circle id="Ellipse_23" data-name="Ellipse 23" cx="17" cy="17" r="15" fill="#18C4C7"></circle>
					<g id="Group_597" data-name="Group 597" transform="translate(0.068)">
						<path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"></path>
						<path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"></path>
					</g>
					<circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
					<path id="Path_2319" class="bg-plus" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"></path>
					<rect id="Rectangle_148" class="icon__scale-down"
						data-name="Rectangle 148" width="12" height="12"
						rx="55"
						fill="#18C4C7"/>
					<!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
					<path id="Path_46001" class="icon__scale-up2"
						data-name="Path 460"
						fill="#fff"
						d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
					<!--															</g>-->
					</svg>
				</div>
				<div class="info-popup-spec-folder __square">
					<div class="icon">
					<img src="images/spec-folder-icon.png">
					</div>
					<span>Save to spec folder</span>
					<p>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
					</p>
				</div>
			</div> 
			<p><a href="product-detail-view.html">See details</a></p>
			<span class="card-el__hide-on-md">
			quick add to cart
			</span>
			</div>
		</li>
		<li data-sub-html="Product description 1" data-html="#video1">
			<div>
			<div>
				<img class="landscape-images" src="images/accessories-product-7.png" alt="">
			</div>
			<p class="product-title">Lorem ipsum dolor sit amet...</p>
			<p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elit,invid ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd</p>
			</div>
			<div class="stars-review-counter-accessories">
			<div class="stars-container">
				<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
					<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
				</svg>
				<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
					<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
				</svg>
				<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
					<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
				</svg>
				<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
					<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
				</svg>
				<img src="images/stars.svg" alt="">
			</div>
			<div class="reviews-counter-product-accessories">
				<p>115 reviews</p>
			</div>
			<div class="price">
				<p>Price: $10</p>
			</div>
			</div>
			<div class="see-detail-product-accessories">
			<a href="#">
				<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
					<defs>
						<style>.share-no-background{fill:#384765;}</style>
					</defs>
					<g transform="translate(0)">
						<path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
						<path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
						<path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
						<path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
						<path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
						<path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
						<path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
						<path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
					</g>
				</svg>
			</a>
			<div class="animating-imgs__wrap showroom-detail-view-product-page idea-folder __square" data-toggle="modal" data-target="#saveToIdeaFolder">
				<div class="icons icon-share__circle icon-share__circle__fff add-to-fav animate-pulse add-to-fav__icon_over-galery">
					<svg id="Save" xmlns="http://www.w3.org/2000/svg" width="24"
					height="28" viewBox="0 -2 25.6 23.023">
					<path id="Path_205" data-name="Path 205"
						d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
						transform="translate(0 -0.963)"
						fill="#18c4c7"></path>
					<path id="Path_207" data-name="Path 207"
						d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
						fill="#18c4c7"></path>
					</svg>
				</div>
				<div class="icons icon-share__circle icon-share__circle__18C4C77 add-to-fav img-check__icon"
					style="display: none">
					<svg id="img-check" class="img-check" data-name="Group 781"
					xmlns="http://www.w3.org/2000/svg" width="36"
					height="36"
					viewBox="-2 -2 32.189 34.043">
					<path id="Path_419" class="icon__scale-down"
						data-name="Path 419"
						d="M26.825,5.154v7.964a1.048,1.048,0,0,1-1.048,1.048H25.2a1.048,1.048,0,0,1-.759-.325L19.882,9.06,11.764,19.423a1.048,1.048,0,0,1-.825.4h0a1.048,1.048,0,0,1-.825-.4L7.342,15.876,5.859,17.8A1.048,1.048,0,0,1,4.2,16.525l2.306-3a1.048,1.048,0,0,1,.826-.409h0a1.048,1.048,0,0,1,.826.4l2.779,3.556,8.04-10.263a1.048,1.048,0,0,1,1.583-.077l4.167,4.369V5.154a2.1,2.1,0,0,0-2.1-2.1H4.191a2.1,2.1,0,0,0-2.1,2.1v14.67a2.1,2.1,0,0,0,2.1,2.1h6.863a1.048,1.048,0,0,1,0,2.1H4.191A4.2,4.2,0,0,1,0,19.825V5.154A4.2,4.2,0,0,1,4.191.963H22.634A4.2,4.2,0,0,1,26.825,5.154ZM4.191,7.879a3.144,3.144,0,1,1,3.144,3.144A3.147,3.147,0,0,1,4.191,7.879Zm2.1,0A1.048,1.048,0,1,0,7.335,6.831,1.049,1.049,0,0,0,6.287,7.879Z"
						fill="#fff"/>
					<rect id="Rectangle_148" class="icon__scale-down"
						data-name="Rectangle 148" width="16" height="14"
						rx="2"
						fill="#18c4c7"/>
					<!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
					<path id="Path_460" class="icon__scale-up"
						data-name="Path 460"
						d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
					<!--															</g>-->
					</svg>
				</div>
				<div class="info-popup-idea-folder __square">
					<div class="icon">
					<img src="images/idea-folder-icon.png">
					</div>
					<span>Save to My Inspirations</span>
					<p>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
					</p>
				</div>
				</div>
				<div class="animating-imgs__wrap showroom-detail-view-product-page save-to-specs-sheet __square" data-toggle="modal" data-target="#saveToSpecSheet">
				<div class="icons icon-share__circle icon-share__circle__18C4C77 add-to-fav animate-pulse add-to-fav__icon_save">
					<svg id="Save" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="7 7 20 20">
					<circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16" fill="#18C4C7"></circle>
					<g id="Group_597" data-name="Group 597" transform="translate(0.068)">
						<path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#fff"></path>
						<path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#fff"></path>
					</g>
					<circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
					<path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" fill="#18C4C7"></path>
					</svg>
				</div>
				<div class="icons icon-share__circle icon-share__circle__18C4C77 save-v2 add-to-fav img-check__icon_v2"
					style="display: none">
					<svg id="img-check" class="img-check" data-name="Group 781"
					xmlns="http://www.w3.org/2000/svg" width="40"
					height="40"
					viewBox="6 5 23 23">
					<circle id="Ellipse_23" data-name="Ellipse 23" cx="17" cy="17" r="15" fill="#18C4C7"></circle>
					<g id="Group_597" data-name="Group 597" transform="translate(0.068)">
						<path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"></path>
						<path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"></path>
					</g>
					<circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
					<path id="Path_2319" class="bg-plus" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"></path>
					<rect id="Rectangle_148" class="icon__scale-down"
						data-name="Rectangle 148" width="12" height="12"
						rx="55"
						fill="#18C4C7"/>
					<!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
					<path id="Path_46001" class="icon__scale-up2"
						data-name="Path 460"
						fill="#fff"
						d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
					<!--															</g>-->
					</svg>
				</div>
				<div class="info-popup-spec-folder __square">
					<div class="icon">
					<img src="images/spec-folder-icon.png">
					</div>
					<span>Save to spec folder</span>
					<p>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
					</p>
				</div>
			</div> 
			<p><a href="product-detail-view.html">See details</a></p>
			<span class="card-el__hide-on-md">
			quick add to cart
			</span>
			</div>
		</li>
	</ul>
	 <ul id="html5-videos" class="accessories-products">
		<li data-sub-html="Product description 1">
		   <div>
			  <div class="product-image">
				 <img src="images/accessories-product-1.png"
					alt=""
					class="">
			  </div>
			  <p class="product-title">Lorem ipsum dolor sit amet, consetetur sadipscing</p>
			  <p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>
			  <div class="share-product-accessories">
				 <a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
					   <defs>
						  <style>.share-no-background{fill:#384765;}</style>
					   </defs>
					   <g transform="translate(0)">
						  <path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
						  <path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
						  <path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
						  <path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
						  <path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
						  <path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
						  <path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
						  <path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
					   </g>
					</svg>
				 </a>
                           <div class="animating-imgs__wrap showroom-detail-view-product-page idea-folder __square" data-toggle="modal" data-target="#saveToIdeaFolder">
                              <div class="icons icon-share__circle icon-share__circle__fff add-to-fav animate-pulse add-to-fav__icon_over-galery">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="24"
                                   height="28" viewBox="0 -2 25.6 23.023">
                                   <path id="Path_205" data-name="Path 205"
                                     d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
                                     transform="translate(0 -0.963)"
                                     fill="#fff"></path>
                                   <path id="Path_207" data-name="Path 207"
                                     d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
                                     fill="#18c4c7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav img-check__icon"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="33"
                                   height="34"
                                   viewBox="-5 -6 36.189 40.043">
                                   <path id="Path_419" class="icon__scale-down"
                                     data-name="Path 419"
                                     d="M26.825,5.154v7.964a1.048,1.048,0,0,1-1.048,1.048H25.2a1.048,1.048,0,0,1-.759-.325L19.882,9.06,11.764,19.423a1.048,1.048,0,0,1-.825.4h0a1.048,1.048,0,0,1-.825-.4L7.342,15.876,5.859,17.8A1.048,1.048,0,0,1,4.2,16.525l2.306-3a1.048,1.048,0,0,1,.826-.409h0a1.048,1.048,0,0,1,.826.4l2.779,3.556,8.04-10.263a1.048,1.048,0,0,1,1.583-.077l4.167,4.369V5.154a2.1,2.1,0,0,0-2.1-2.1H4.191a2.1,2.1,0,0,0-2.1,2.1v14.67a2.1,2.1,0,0,0,2.1,2.1h6.863a1.048,1.048,0,0,1,0,2.1H4.191A4.2,4.2,0,0,1,0,19.825V5.154A4.2,4.2,0,0,1,4.191.963H22.634A4.2,4.2,0,0,1,26.825,5.154ZM4.191,7.879a3.144,3.144,0,1,1,3.144,3.144A3.147,3.147,0,0,1,4.191,7.879Zm2.1,0A1.048,1.048,0,1,0,7.335,6.831,1.049,1.049,0,0,0,6.287,7.879Z"
                                     fill="#fff"/>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="16" height="14"
                                     rx="2"
                                     fill="#18c4c7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_460" class="icon__scale-up"
                                     data-name="Path 460"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-idea-folder __square">
                                 <div class="icon">
                                   <img src="images/idea-folder-icon.png">
                                 </div>
                                 <span>Save to My Inspirations</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                            </div>
                            <div class="animating-imgs__wrap showroom-detail-view-product-page save-to-specs-sheet __square" data-toggle="modal" data-target="#saveToSpecSheet">
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav animate-pulse add-to-fav__icon_save">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="6 6 24 24">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#fff"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#fff"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" fill="#18C4C7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 save-v2 add-to-fav img-check__icon_v2"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="40"
                                   height="40"
                                   viewBox="2 4 27.189 27.043">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="17" cy="17" r="15" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#18c4c7" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_2319" class="bg-plus" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"></path>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="12" height="12"
                                     rx="55"
                                     fill="#18C4C7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_4600" class="icon__scale-up"
                                     data-name="Path 460"
                                     fill="#fff"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-spec-folder __square">
                                 <div class="icon">
                                   <img src="images/spec-folder-icon.png">
                                 </div>
                                 <span>Save to spec folder</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                           </div> 
			  </div>
			  <div class="see-detail-product-accessories">
				 <p><a href="product-detail-view.html">See details</a></p>
			  </div>
			  <div class="stars-review-price-btn">
				 <div class=" stars-product-accessories">
					<div class="stars-container">
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <img src="images/stars.svg" alt="">
					</div>
				 </div>
				 <div class="reviews-counter-product-accessories">
					<p>115 reviews</p>
				 </div>
				 <div class="price">
					<p>Price: $10</p>
				 </div>
				 <div class="btn-add-to-cart">
					<span class="card-el__hide-on-md">
					quick add to cart
					</span>
				 </div>
			  </div>
		   </div>
		</li>
		<li data-sub-html="Product description 1">
		   <div>
			  <div class="product-image">
				 <img src="images/accessories-product-2.png"
					alt=""
					class="">
			  </div>
			  <p class="product-title">Lorem ipsum dolor sit amet, consetetur sadipscing</p>
			  <p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>
			  <div class="share-product-accessories">
				 <a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
					   <defs>
						  <style>.share-no-background{fill:#384765;}</style>
					   </defs>
					   <g transform="translate(0)">
						  <path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
						  <path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
						  <path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
						  <path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
						  <path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
						  <path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
						  <path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
						  <path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
					   </g>
					</svg>
				 </a>
                           <div class="animating-imgs__wrap showroom-detail-view-product-page idea-folder __square" data-toggle="modal" data-target="#saveToIdeaFolder">
                              <div class="icons icon-share__circle icon-share__circle__fff add-to-fav animate-pulse add-to-fav__icon_over-galery">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="24"
                                   height="28" viewBox="0 -2 25.6 23.023">
                                   <path id="Path_205" data-name="Path 205"
                                     d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
                                     transform="translate(0 -0.963)"
                                     fill="#fff"></path>
                                   <path id="Path_207" data-name="Path 207"
                                     d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
                                     fill="#18c4c7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav img-check__icon"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="33"
                                   height="34"
                                   viewBox="-5 -6 36.189 40.043">
                                   <path id="Path_419" class="icon__scale-down"
                                     data-name="Path 419"
                                     d="M26.825,5.154v7.964a1.048,1.048,0,0,1-1.048,1.048H25.2a1.048,1.048,0,0,1-.759-.325L19.882,9.06,11.764,19.423a1.048,1.048,0,0,1-.825.4h0a1.048,1.048,0,0,1-.825-.4L7.342,15.876,5.859,17.8A1.048,1.048,0,0,1,4.2,16.525l2.306-3a1.048,1.048,0,0,1,.826-.409h0a1.048,1.048,0,0,1,.826.4l2.779,3.556,8.04-10.263a1.048,1.048,0,0,1,1.583-.077l4.167,4.369V5.154a2.1,2.1,0,0,0-2.1-2.1H4.191a2.1,2.1,0,0,0-2.1,2.1v14.67a2.1,2.1,0,0,0,2.1,2.1h6.863a1.048,1.048,0,0,1,0,2.1H4.191A4.2,4.2,0,0,1,0,19.825V5.154A4.2,4.2,0,0,1,4.191.963H22.634A4.2,4.2,0,0,1,26.825,5.154ZM4.191,7.879a3.144,3.144,0,1,1,3.144,3.144A3.147,3.147,0,0,1,4.191,7.879Zm2.1,0A1.048,1.048,0,1,0,7.335,6.831,1.049,1.049,0,0,0,6.287,7.879Z"
                                     fill="#fff"/>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="16" height="14"
                                     rx="2"
                                     fill="#18c4c7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_460" class="icon__scale-up"
                                     data-name="Path 460"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-idea-folder __square">
                                 <div class="icon">
                                   <img src="images/idea-folder-icon.png">
                                 </div>
                                 <span>Save to My Inspirations</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                            </div>
                            <div class="animating-imgs__wrap showroom-detail-view-product-page save-to-specs-sheet __square" data-toggle="modal" data-target="#saveToSpecSheet">
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav animate-pulse add-to-fav__icon_save">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="6 6 24 24">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#fff"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#fff"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" fill="#18C4C7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 save-v2 add-to-fav img-check__icon_v2"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="40"
                                   height="40"
                                   viewBox="2 4 27.189 27.043">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="17" cy="17" r="15" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#18c4c7" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_2319" class="bg-plus" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"></path>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="12" height="12"
                                     rx="55"
                                     fill="#18C4C7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_4600" class="icon__scale-up"
                                     data-name="Path 460"
                                     fill="#fff"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-spec-folder __square">
                                 <div class="icon">
                                   <img src="images/spec-folder-icon.png">
                                 </div>
                                 <span>Save to spec folder</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                           </div> 
			  </div>
			  <div class="see-detail-product-accessories">
				 <p><a href="product-detail-view.html">See details</a></p>
			  </div>
			  <div class="stars-review-price-btn">
				 <div class=" stars-product-accessories">
					<div class="stars-container">
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <img src="images/stars.svg" alt="">
					</div>
				 </div>
				 <div class="reviews-counter-product-accessories">
					<p>115 reviews</p>
				 </div>
				 <div class="price">
					<p>Price: $10</p>
				 </div>
				 <div class="btn-add-to-cart">
					<span class="card-el__hide-on-md">
					quick add to cart
					</span>
				 </div>
			  </div>
		   </div>
		</li>
		<li data-sub-html="Product description 1">
		   <div>
			  <div class="product-image">
				 <img src="images/accessories-product-3.png"
					alt=""
					class="">
			  </div>
			  <p class="product-title">Lorem ipsum dolor sit amet, consetetur sadipscing</p>
			  <p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>
			  <div class="share-product-accessories">
				 <a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
					   <defs>
						  <style>.share-no-background{fill:#384765;}</style>
					   </defs>
					   <g transform="translate(0)">
						  <path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
						  <path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
						  <path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
						  <path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
						  <path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
						  <path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
						  <path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
						  <path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
					   </g>
					</svg>
				 </a>
                           <div class="animating-imgs__wrap showroom-detail-view-product-page idea-folder __square" data-toggle="modal" data-target="#saveToIdeaFolder">
                              <div class="icons icon-share__circle icon-share__circle__fff add-to-fav animate-pulse add-to-fav__icon_over-galery">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="24"
                                   height="28" viewBox="0 -2 25.6 23.023">
                                   <path id="Path_205" data-name="Path 205"
                                     d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
                                     transform="translate(0 -0.963)"
                                     fill="#fff"></path>
                                   <path id="Path_207" data-name="Path 207"
                                     d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
                                     fill="#18c4c7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav img-check__icon"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="33"
                                   height="34"
                                   viewBox="-5 -6 36.189 40.043">
                                   <path id="Path_419" class="icon__scale-down"
                                     data-name="Path 419"
                                     d="M26.825,5.154v7.964a1.048,1.048,0,0,1-1.048,1.048H25.2a1.048,1.048,0,0,1-.759-.325L19.882,9.06,11.764,19.423a1.048,1.048,0,0,1-.825.4h0a1.048,1.048,0,0,1-.825-.4L7.342,15.876,5.859,17.8A1.048,1.048,0,0,1,4.2,16.525l2.306-3a1.048,1.048,0,0,1,.826-.409h0a1.048,1.048,0,0,1,.826.4l2.779,3.556,8.04-10.263a1.048,1.048,0,0,1,1.583-.077l4.167,4.369V5.154a2.1,2.1,0,0,0-2.1-2.1H4.191a2.1,2.1,0,0,0-2.1,2.1v14.67a2.1,2.1,0,0,0,2.1,2.1h6.863a1.048,1.048,0,0,1,0,2.1H4.191A4.2,4.2,0,0,1,0,19.825V5.154A4.2,4.2,0,0,1,4.191.963H22.634A4.2,4.2,0,0,1,26.825,5.154ZM4.191,7.879a3.144,3.144,0,1,1,3.144,3.144A3.147,3.147,0,0,1,4.191,7.879Zm2.1,0A1.048,1.048,0,1,0,7.335,6.831,1.049,1.049,0,0,0,6.287,7.879Z"
                                     fill="#fff"/>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="16" height="14"
                                     rx="2"
                                     fill="#18c4c7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_460" class="icon__scale-up"
                                     data-name="Path 460"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-idea-folder __square">
                                 <div class="icon">
                                   <img src="images/idea-folder-icon.png">
                                 </div>
                                 <span>Save to My Inspirations</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                            </div>
                            <div class="animating-imgs__wrap showroom-detail-view-product-page save-to-specs-sheet __square" data-toggle="modal" data-target="#saveToSpecSheet">
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav animate-pulse add-to-fav__icon_save">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="6 6 24 24">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#fff"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#fff"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" fill="#18C4C7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 save-v2 add-to-fav img-check__icon_v2"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="40"
                                   height="40"
                                   viewBox="2 4 27.189 27.043">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="17" cy="17" r="15" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#18c4c7" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_2319" class="bg-plus" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"></path>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="12" height="12"
                                     rx="55"
                                     fill="#18C4C7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_4600" class="icon__scale-up"
                                     data-name="Path 460"
                                     fill="#fff"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-spec-folder __square">
                                 <div class="icon">
                                   <img src="images/spec-folder-icon.png">
                                 </div>
                                 <span>Save to spec folder</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                           </div> 
			  </div>
			  <div class="see-detail-product-accessories">
				 <p><a href="product-detail-view.html">See details</a></p>
			  </div>
			  <div class="stars-review-price-btn">
				 <div class=" stars-product-accessories">
					<div class="stars-container">
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <img src="images/stars.svg" alt="">
					</div>
				 </div>
				 <div class="reviews-counter-product-accessories">
					<p>115 reviews</p>
				 </div>
				 <div class="price">
					<p>Price: $10</p>
				 </div>
				 <div class="btn-add-to-cart">
					<span class="card-el__hide-on-md">
					quick add to cart
					</span>
				 </div>
			  </div>
		   </div>
		</li>
		<li data-sub-html="Product description 1">
		   <div>
			  <div class="product-image">
				 <img src="images/accessories-product-4.png"
					alt=""
					class="">
			  </div>
			  <p class="product-title">Lorem ipsum dolor sit amet, consetetur sadipscing</p>
			  <p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>
			  <div class="share-product-accessories">
				 <a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
					   <defs>
						  <style>.share-no-background{fill:#384765;}</style>
					   </defs>
					   <g transform="translate(0)">
						  <path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
						  <path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
						  <path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
						  <path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
						  <path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
						  <path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
						  <path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
						  <path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
					   </g>
					</svg>
				 </a>
                           <div class="animating-imgs__wrap showroom-detail-view-product-page idea-folder __square" data-toggle="modal" data-target="#saveToIdeaFolder">
                              <div class="icons icon-share__circle icon-share__circle__fff add-to-fav animate-pulse add-to-fav__icon_over-galery">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="24"
                                   height="28" viewBox="0 -2 25.6 23.023">
                                   <path id="Path_205" data-name="Path 205"
                                     d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
                                     transform="translate(0 -0.963)"
                                     fill="#fff"></path>
                                   <path id="Path_207" data-name="Path 207"
                                     d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
                                     fill="#18c4c7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav img-check__icon"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="33"
                                   height="34"
                                   viewBox="-5 -6 36.189 40.043">
                                   <path id="Path_419" class="icon__scale-down"
                                     data-name="Path 419"
                                     d="M26.825,5.154v7.964a1.048,1.048,0,0,1-1.048,1.048H25.2a1.048,1.048,0,0,1-.759-.325L19.882,9.06,11.764,19.423a1.048,1.048,0,0,1-.825.4h0a1.048,1.048,0,0,1-.825-.4L7.342,15.876,5.859,17.8A1.048,1.048,0,0,1,4.2,16.525l2.306-3a1.048,1.048,0,0,1,.826-.409h0a1.048,1.048,0,0,1,.826.4l2.779,3.556,8.04-10.263a1.048,1.048,0,0,1,1.583-.077l4.167,4.369V5.154a2.1,2.1,0,0,0-2.1-2.1H4.191a2.1,2.1,0,0,0-2.1,2.1v14.67a2.1,2.1,0,0,0,2.1,2.1h6.863a1.048,1.048,0,0,1,0,2.1H4.191A4.2,4.2,0,0,1,0,19.825V5.154A4.2,4.2,0,0,1,4.191.963H22.634A4.2,4.2,0,0,1,26.825,5.154ZM4.191,7.879a3.144,3.144,0,1,1,3.144,3.144A3.147,3.147,0,0,1,4.191,7.879Zm2.1,0A1.048,1.048,0,1,0,7.335,6.831,1.049,1.049,0,0,0,6.287,7.879Z"
                                     fill="#fff"/>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="16" height="14"
                                     rx="2"
                                     fill="#18c4c7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_460" class="icon__scale-up"
                                     data-name="Path 460"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-idea-folder __square">
                                 <div class="icon">
                                   <img src="images/idea-folder-icon.png">
                                 </div>
                                 <span>Save to My Inspirations</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                            </div>
                            <div class="animating-imgs__wrap showroom-detail-view-product-page save-to-specs-sheet __square" data-toggle="modal" data-target="#saveToSpecSheet">
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav animate-pulse add-to-fav__icon_save">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="6 6 24 24">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#fff"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#fff"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" fill="#18C4C7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 save-v2 add-to-fav img-check__icon_v2"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="40"
                                   height="40"
                                   viewBox="2 4 27.189 27.043">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="17" cy="17" r="15" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#18c4c7" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_2319" class="bg-plus" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"></path>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="12" height="12"
                                     rx="55"
                                     fill="#18C4C7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_4600" class="icon__scale-up"
                                     data-name="Path 460"
                                     fill="#fff"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-spec-folder __square">
                                 <div class="icon">
                                   <img src="images/spec-folder-icon.png">
                                 </div>
                                 <span>Save to spec folder</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                           </div> 
			  </div>
			  <div class="see-detail-product-accessories">
				 <p><a href="product-detail-view.html">See details</a></p>
			  </div>
			  <div class="stars-review-price-btn">
				 <div class=" stars-product-accessories">
					<div class="stars-container">
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <img src="images/stars.svg" alt="">
					</div>
				 </div>
				 <div class="reviews-counter-product-accessories">
					<p>115 reviews</p>
				 </div>
				 <div class="price">
					<p>Price: $10</p>
				 </div>
				 <div class="btn-add-to-cart">
					<span class="card-el__hide-on-md">
					quick add to cart
					</span>
				 </div>
			  </div>
		   </div>
		</li>
		<li data-sub-html="Product description 1">
		   <div>
			  <div class="product-image">
				 <img src="images/accessories-product-5.png"
					alt=""
					class="">
			  </div>
			  <p class="product-title">Lorem ipsum dolor sit amet, consetetur sadipscing</p>
			  <p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>
			  <div class="share-product-accessories">
				 <a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
					   <defs>
						  <style>.share-no-background{fill:#384765;}</style>
					   </defs>
					   <g transform="translate(0)">
						  <path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
						  <path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
						  <path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
						  <path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
						  <path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
						  <path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
						  <path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
						  <path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
					   </g>
					</svg>
				 </a>
                           <div class="animating-imgs__wrap showroom-detail-view-product-page idea-folder __square" data-toggle="modal" data-target="#saveToIdeaFolder">
                              <div class="icons icon-share__circle icon-share__circle__fff add-to-fav animate-pulse add-to-fav__icon_over-galery">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="24"
                                   height="28" viewBox="0 -2 25.6 23.023">
                                   <path id="Path_205" data-name="Path 205"
                                     d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
                                     transform="translate(0 -0.963)"
                                     fill="#fff"></path>
                                   <path id="Path_207" data-name="Path 207"
                                     d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
                                     fill="#18c4c7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav img-check__icon"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="33"
                                   height="34"
                                   viewBox="-5 -6 36.189 40.043">
                                   <path id="Path_419" class="icon__scale-down"
                                     data-name="Path 419"
                                     d="M26.825,5.154v7.964a1.048,1.048,0,0,1-1.048,1.048H25.2a1.048,1.048,0,0,1-.759-.325L19.882,9.06,11.764,19.423a1.048,1.048,0,0,1-.825.4h0a1.048,1.048,0,0,1-.825-.4L7.342,15.876,5.859,17.8A1.048,1.048,0,0,1,4.2,16.525l2.306-3a1.048,1.048,0,0,1,.826-.409h0a1.048,1.048,0,0,1,.826.4l2.779,3.556,8.04-10.263a1.048,1.048,0,0,1,1.583-.077l4.167,4.369V5.154a2.1,2.1,0,0,0-2.1-2.1H4.191a2.1,2.1,0,0,0-2.1,2.1v14.67a2.1,2.1,0,0,0,2.1,2.1h6.863a1.048,1.048,0,0,1,0,2.1H4.191A4.2,4.2,0,0,1,0,19.825V5.154A4.2,4.2,0,0,1,4.191.963H22.634A4.2,4.2,0,0,1,26.825,5.154ZM4.191,7.879a3.144,3.144,0,1,1,3.144,3.144A3.147,3.147,0,0,1,4.191,7.879Zm2.1,0A1.048,1.048,0,1,0,7.335,6.831,1.049,1.049,0,0,0,6.287,7.879Z"
                                     fill="#fff"/>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="16" height="14"
                                     rx="2"
                                     fill="#18c4c7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_460" class="icon__scale-up"
                                     data-name="Path 460"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-idea-folder __square">
                                 <div class="icon">
                                   <img src="images/idea-folder-icon.png">
                                 </div>
                                 <span>Save to My Inspirations</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                            </div>
                            <div class="animating-imgs__wrap showroom-detail-view-product-page save-to-specs-sheet __square" data-toggle="modal" data-target="#saveToSpecSheet">
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 add-to-fav animate-pulse add-to-fav__icon_save">
                                 <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="6 6 24 24">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#fff"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#fff"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#fff" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" fill="#18C4C7"></path>
                                 </svg>
                              </div>
                              <div class="icons icon-share__circle icon-share__circle__18C4C7 save-v2 add-to-fav img-check__icon_v2"
                                 style="display: none">
                                 <svg id="img-check" class="img-check" data-name="Group 781"
                                   xmlns="http://www.w3.org/2000/svg" width="40"
                                   height="40"
                                   viewBox="2 4 27.189 27.043">
                                   <circle id="Ellipse_23" data-name="Ellipse 23" cx="17" cy="17" r="15" fill="#18C4C7"></circle>
                                   <g id="Group_597" data-name="Group 597" transform="translate(0.068)">
                                     <path id="Path_4344" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"></path>
                                     <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"></path>
                                   </g>
                                   <circle id="Ellipse_25" fill="#18c4c7" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)"></circle>
                                   <path id="Path_2319" class="bg-plus" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"></path>
                                   <rect id="Rectangle_148" class="icon__scale-down"
                                     data-name="Rectangle 148" width="12" height="12"
                                     rx="55"
                                     fill="#18C4C7"/>
                                   <!--															<g id="check" transform="translate(19.319 22.617)" class="icon__scale-up">-->
                                   <path id="Path_4600" class="icon__scale-up"
                                     data-name="Path 460"
                                     fill="#fff"
                                     d="M7.905,56.579l-4.3,4.3a.815.815,0,0,1-1.153,0L.238,58.657A.815.815,0,0,1,1.391,57.5l1.642,1.642,3.72-3.72a.815.815,0,0,1,1.153,1.153Z"/>
                                   <!--															</g>-->
                                 </svg>
                              </div>
                              <div class="info-popup-spec-folder __square">
                                 <div class="icon">
                                   <img src="images/spec-folder-icon.png">
                                 </div>
                                 <span>Save to spec folder</span>
                                 <p>
                                   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an ....
                                 </p>
                              </div>
                           </div> 
			  </div>
			  <div class="see-detail-product-accessories">
				 <p><a href="product-detail-view.html">See details</a></p>
			  </div>
			  <div class="stars-review-price-btn">
				 <div class=" stars-product-accessories">
					<div class="stars-container">
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
						  <path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
					   </svg>
					   <img src="images/stars.svg" alt="">
					</div>
				 </div>
				 <div class="reviews-counter-product-accessories">
					<p>115 reviews</p>
				 </div>
				 <div class="price">
					<p>Price: $10</p>
				 </div>
				 <div class="btn-add-to-cart">
					<span class="card-el__hide-on-md">
					quick add to cart
					</span>
				 </div>
			  </div>
		   </div>
		</li>
	 </ul>
	`;
		container.appendChild(postElement);

		loading.classList.remove('show');
	}


});

