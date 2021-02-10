/*	
 *	jQuery mmenu 2.2.3
 *	
 *	Copyright (c) 2013 Fred Heusschen
 *	www.frebsite.nl
 *
 *	Dual licensed under the MIT and GPL licenses.
 *	http://en.wikipedia.org/wiki/MIT_License
 *	http://en.wikipedia.org/wiki/GNU_General_Public_License
 */


(function( $ ) {


	//	Global nodes
	var $wndw = null,
		$html = null,
		$body = null,
		$page = null,
		$blck = null;

	var $allMenus = null,
		$scrollTopNode = null;


	//	Constants
	var _c, _e, _d;


	$.fn.mmenu = function( opts )
	{
		//	First time plugin is fired
		if ( !$wndw )
		{
			_initPlugin();
		}

		//	Extend options
		opts = extendOptions( opts );

		return this.each(
			function()
			{

				//	STORE VARIABLES
				var $menu 		= $(this),
//					$_dummy		= null,
					_opened 	= false,
					_direction	= ( opts.slidingSubmenus ) ? 'horizontal' : 'vertical';

				$allMenus = $allMenus.add( $menu );

				_serialnr++;


				//	INIT PAGE, MENU, LINKS & LABELS
				$page = _initPage( $page, opts.configuration );
				$blck = _initBlocker( $blck, $menu, opts.configuration );
				$menu = _initMenu( $menu, opts.position, opts.configuration );

				_initSubmenus( $menu, _direction, _serialnr );
				_initLinks( $menu, opts.onClick, opts.configuration );
				_initOpenClose( $menu, $page, opts.slidingSubmenus );

				$.fn.mmenu.counters( $menu, opts.counters, opts.configuration );
				$.fn.mmenu.search( $menu, opts.searchfield );


				//	BIND EVENTS
				var $subs = $menu.find( 'ul' );
				$menu.add( $subs )
					.off( _e.toggle + ' ' + _e.open + ' ' + _e.close )
					.on( _e.toggle + ' ' + _e.open + ' ' + _e.close,
						function( e )
						{
							e.preventDefault();
							e.stopPropagation();
						}
					);

				//	menu-events
				$menu
					.on( _e.toggle,
						function( e )
						{
							return $menu.triggerHandler( _opened ? _e.close : _e.open );
						}
					)
					.on( _e.open,
						function( e )
						{
							if ( _opened )
							{
								e.stopImmediatePropagation();
								return false;
							}
							_opened = true;
							return openMenu( $menu, opts, opts.configuration );
						}
					)
					.on( _e.close,
						function( e )
						{
							if ( !_opened )
							{
								e.stopImmediatePropagation();
								return false;
							}
							_opened = false;
							return closeMenu( $menu, opts, opts.configuration );
						}
					);


				//	submenu-events
				if ( _direction == 'horizontal' )
				{
					$subs
						.on( _e.toggle,
							function( e )
							{								
								return $(this).triggerHandler( _e.open );
							}
						)
						.on( _e.open,
							function( e )
							{
								return openSubmenuHorizontal( $(this), opts );
							}
						)
						.on( _e.close,
							function( e )
							{
								return closeSubmenuHorizontal( $(this), $menu, opts );
							}
						);
				}
				else
				{
					$subs
						.on( _e.toggle,
							function( e )
							{
								var $t = $(this);
								return $t.triggerHandler( $t.parent().hasClass( _c.opened ) ? _e.close : _e.open );
							}
						)
						.on( _e.open,
							function( e )
							{
								$(this).parent().addClass( _c.opened );
								return 'open';
							}
						)
						.on( _e.close,
							function( e )
							{
								$(this).parent().removeClass( _c.opened );
								return 'close';
							}
						);
				}
			}
		);
	};


	$.fn.mmenu.defaults = {
		position		: 'left',
		slidingSubmenus	: true,
		onClick			: {
			close				: true,
			delayPageload		: true,
			blockUI				: false
		},
		configuration	: {
			preventTabbing		: true,
			hardwareAcceleration: true,
			selectedClass		: 'Selected',
			labelClass			: 'Label',
			counterClass		: 'Counter',
			pageNodetype		: 'div',
			menuNodetype		: 'nav',
			slideDuration		: 500
		}
	};


	$.fn.mmenu.search = function( $m, opts )
	{

		//	Extend options
		if ( typeof opts == 'boolean' )
		{
			opts = {
				add		: opts,
				search	: opts
			};
		}
		else if ( typeof search == 'string' )
		{
			opts = {
				add			: true,
				search		: true,
				placeholder	: opts
			};
		}
		if ( typeof opts != 'object' )
		{
			opts = {};
		}
		opts = $.extend( true, {}, $.fn.mmenu.search.defaults, opts );

		//	Add the field
		if ( opts.add )
		{
			var $s = $( '<div class="' + _c.search + '" />' ).prependTo( $m );
			$s.append( '<input placeholder="' + opts.placeholder + '" type="text" autocomplete="off" />' );

			if ( opts.noResults )
			{
				$('ul', $m).not( '.' + _c.submenu ).append( '<li class="' + _c.noresults + '">' + opts.noResults + '</li>' );
			}
		}

		//	Bind custom events
		if ( opts.search )
		{
			var $s = $('div.' + _c.search, $m),
				$i = $('input', $s);

			var $labels = $('li.' + _c.label, $m),
				$counters = $('em.' + _c.counter, $m),
				$items = $('li', $m)
					.not( '.' + _c.subtitle )
					.not( '.' + _c.label )
					.not( '.' + _c.noresults );

			var _searchText = '> a';
			if ( !opts.showLinksOnly )
			{
				_searchText += ', > span';
			}

			$i.off( _e.keyup )
				.on( _e.keyup,
					function( e )
					{
						if ( !preventKeypressSearch( e.keyCode ) )
						{
							$i.trigger( _e.search );
						}
					}
				);

			$m.off( _e.reset + ' ' + _e.search )
				.on( _e.reset + ' ' + _e.search,
					function( e )
					{
						e.preventDefault();
						e.stopPropagation();
					}
				)
				.on( _e.reset,
					function( e )
					{
						$i.val( '' );
						$m.trigger( _e.search );
					}
				)
				.on( _e.search,
					function( e, query )
					{
						if ( typeof query == 'string' )
						{
							$i.val( query );
						}
						else
						{
							query = $i.val().toLowerCase();
						}
	
						//	search through items
						$items.add( $labels ).addClass( _c.noresult );
						$items.each(
							function()
							{
								var $t = $(this);
								if ( $(_searchText, $t).text().toLowerCase().indexOf( query ) > -1 )
								{
									$t.add( $t.prevAll( '.' + _c.label ).first() ).removeClass( _c.noresult );
								}
							}
						);
	
						//	update parent for submenus
						$( $('ul.' + _c.submenu, $m).get().reverse() ).each(
							function()
							{
								var $t = $(this),
									$p = $t.data( _d.parent ),
									id = $t.attr( 'id' ),
									$i = $t.find( 'li' )
										.not( '.' + _c.subtitle )
										.not( '.' + _c.label )
										.not( '.' + _c.noresult );
	
								if ( $i.length )
								{
									if ( $p )
									{
										$p.removeClass( _c.noresult )
											.removeClass( _c.nosubresult )
											.prevAll( '.' + _c.label ).first().removeClass( _c.noresult );
									}
								}
								else
								{
									$t.trigger( _e.close );
									if ( $p )
									{
										$p.addClass( _c.nosubresult );
									}
								}
							}
						);

						//	show/hide no results message
						$m[ $items.not( '.' + _c.noresult ).length ? 'removeClass' : 'addClass' ]( _c.noresults );
	
						//	update counters
						$counters.trigger( _e.count );
					}
				);
		}
	};
	$.fn.mmenu.search.defaults = {
		add				: false,
		search			: true,
		showLinksOnly	: true,
		placeholder		: 'Search',
		noResults		: 'No results found.'
	};

	$.fn.mmenu.counters = function( $m, opts, conf )
	{
		//	Extend options
		if ( typeof opts == 'boolean' )
		{
			opts = {
				add		: opts,
				count	: opts
			};
		}
		if ( typeof opts != 'object' )
		{
			opts = {};
		}
		opts = $.extend( true, {}, $.fn.mmenu.counters.defaults, opts );

		//	Refactor counter class
		$('em.' + conf.counterClass, $m).removeClass( conf.counterClass ).addClass( _c.counter );

		//	Add the counters
		if ( opts.add )
		{
			$('.' + _c.submenu, $m).each(
				function()
				{
					var $s = $(this),
						id = $s.attr( 'id' );
	
					if ( id && id.length )
					{
						var $c = $( '<em class="' + _c.counter + '" />' ),
							$a = $('a.' + _c.subopen, $m).filter( '[href="#' + id + '"]' );

						if ( !$a.parent().find( 'em.' + _c.counter ).length )
						{
							$a.before( $c );
						}
					}
				}
			);
		}

		//	Bind custom events
		if ( opts.count )
		{
			$('em.' + _c.counter, $m).each(
				function()
				{
					var $c = $(this),
						$s = $('ul' + $c.next().attr( 'href' ), $m);

					$c.off( _e.count )
						.on( _e.count,
							function( e )
							{
								e.preventDefault();
								e.stopPropagation();
	
								var $lis = $s.children()
									.not( '.' + _c.label )
									.not( '.' + _c.subtitle )
									.not( '.' + _c.noresult )
									.not( '.' + _c.noresults );
	
								$c.html( $lis.length );
							}
						);
				}
			).trigger( _e.count );
		}
	};
	$.fn.mmenu.counters.defaults = {
		add		: false,
		count	: true
	};


	$.fn.mmenu.useOverflowScrollingFallback = function( use )
	{
		if ( $html )
		{
			if ( typeof use == 'boolean' )
			{
				$html[ use ? 'addClass' : 'removeClass' ]( _c.nooverflowscrolling );
			}
			return $html.hasClass( _c.nooverflowscrolling );
		}
		else
		{
			_useOverflowScrollingFallback = use;
			return use;
		}
	};


	$.fn.mmenu.support = {

		touch: (function() {
			return 'ontouchstart' in window.document;
		})(),

		overflowscrolling: (function() {
			return 'WebkitOverflowScrolling' in window.document.documentElement.style;
		})(),

		oldAndroid: (function() {
			var ua = navigator.userAgent;
			if ( ua.indexOf( 'Android' ) >= 0 )
			{
				return 2.4 > parseFloat( ua.slice( ua.indexOf( 'Android' ) +8 ) );
			}
			return false;
		})(),

		transition: (function() {
			return 'transition' in document.createElement('p').style;
		})()
	};


	$.fn.mmenu.debug = function( msg )
	{
		if ( typeof console != 'undefined' && typeof console.log != 'undefined' )
		{
			console.log( 'MMENU: ' + msg );
		}
	};
	$.fn.mmenu.deprecated = function( depr, repl )
	{
		if ( typeof console != 'undefined' && typeof console.warn != 'undefined' )
		{
			console.warn( 'MMENU: ' + depr + ' is deprecated, use ' + repl + ' instead.' );
		}
	};


	//	Global vars
	var _serialnr = 0,
		_useOverflowScrollingFallback = $.fn.mmenu.support.touch && !$.fn.mmenu.support.overflowscrolling;


	function extendOptions( o )
	{
		//	string value only
		if ( typeof o == 'string' )
		{
			switch( o )
			{
				case 'top':
				case 'right':
				case 'bottom':
				case 'left':
					o = {
						position: o
					};
					break;
			}
		}
		if ( typeof o != 'object' )
		{
			o = {};
		}

		//	DEPRECATED
		if ( typeof o.addCounters != 'undefined' )
		{
			$.fn.mmenu.deprecated( 'addCounters-option', 'counters.add-option' );
			o.counters = {
				add: o.addCounters
			};
		}
		if ( typeof o.closeOnClick != 'undefined' )
		{
			$.fn.mmenu.deprecated( 'closeOnClick-option', 'onClick.close-option' );
			o.onClick = {
				close: o.closeOnClick
			};
		}
		//	/DEPRECATED


		//	extend onClick
		if ( typeof o.onClick == 'boolean' )
		{
			o.onClick = {
				close	: o.onClick
			};
		}
		else if ( typeof o.onClick != 'object' )
		{
			o.onClick = {};
		}


		//	extend from defaults
		o = $.extend( true, {}, $.fn.mmenu.defaults, o );


		//	extend onClick
		if ( typeof o.onClick.delayPageload == 'boolean' )
		{
			o.onClick.delayPageload = ( o.onClick.delayPageload ) ? o.configuration.slideDuration : 0;
		}


		//	Degration
		if ( $.fn.mmenu.useOverflowScrollingFallback() )
		{
			switch( o.position )
			{
				case 'top':
				case 'bottom':
					$.fn.mmenu.debug( 'position: "' + o.position + '" not possible when using the overflowScrolling-fallback.' );
					o.position = 'left';
					break;
			}
		}
		return o;
	}

	function _initPlugin()
	{
		$wndw = $(window);
		$html = $('html');
		$body = $('body');
		
		$allMenus = $();

		_c = {
			page		: cls( 'page' ),
			blocker		: cls( 'blocker' ),
			blocking	: cls( 'blocking' ),
			opened 		: cls( 'opened' ),
			opening 	: cls( 'opening' ),
			submenu		: cls( 'submenu' ),
			subopen		: cls( 'subopen' ),
			fullsubopen	: cls( 'fullsubopen' ),
			subclose	: cls( 'subclose' ),
			subopened	: cls( 'subopened' ),
			subopening	: cls( 'subopening' ),
			subtitle	: cls( 'subtitle' ),
			selected	: cls( 'selected' ),
			label 		: cls( 'label' ),
			noresult	: cls( 'noresult' ),
			noresults	: cls( 'noresults' ),
			nosubresult	: cls( 'nosubresult' ),
			search 		: cls( 'search' ),
			counter		: cls( 'counter' ),
			accelerated	: cls( 'accelerated' ),
			nooverflowscrolling : cls( 'no-overflowscrolling' )
		};
		_e = {
			toggle		: evt( 'toggle' ),
			open		: evt( 'open' ),
			close		: evt( 'close' ),
			search		: evt( 'search' ),
			reset		: evt( 'reset' ),
			keyup		: evt( 'keyup' ),
			keydown		: evt( 'keydown' ),
			count		: evt( 'count' ),
			resize		: evt( 'resize' ),
			opening		: evt( 'opening' ),
			opened		: evt( 'opened' ),
			closing		: evt( 'closing' ),
			closed		: evt( 'closed' ),
			touchstart	: evt( 'touchstart' ),
			mousedown	: evt( 'mousedown' ),
			click		: evt( 'click' )
		};
		_d = {
			parent		: dta( 'parent' ),
			sub			: dta( 'sub' ),
			style		: dta( 'style' ),
			scrollTop	: dta( 'scrollTop' ),
			offetLeft	: dta( 'offetLeft' )
		};

		$.fn.mmenu.useOverflowScrollingFallback( _useOverflowScrollingFallback );
	}

	function _initPage( $p, conf )
	{
		if ( !$p )
		{
			$p = $('> ' + conf.pageNodetype, $body);
			if ( $p.length > 1 )
			{
				$p = $p.wrapAll( '<' + conf.pageNodetype + ' />' ).parent();
			}
			$p.addClass( _c.page );
		}
		return $p;
	}

	function _initMenu( $m, position, conf )
	{
		if ( !$m.is( conf.menuNodetype ) )
		{
			$m = $( '<' + conf.menuNodetype + ' />' ).append( $m );
		}
		if ( conf.clone )
		{
			$m = $m.clone( true );
			$m.add( $m.find( '*' ) ).filter( '[id]' ).each(
				function()
				{
					$(this).attr( 'id', cls( $(this).attr( 'id' ) ) );
				}
			);
		}

//		$_dummy = $( '<div class="mmenu-dummy" />' ).insertAfter( $m ).hide();
		$m.prependTo( 'body' )
			.addClass( cls( '' ).slice( 0, -1 ) )
			.addClass( cls( position ) );

		//	Refactor selected class
		$('li.' + conf.selectedClass, $m).removeClass( conf.selectedClass ).addClass( _c.selected );

		//	Refactor label class
		$('li.' + conf.labelClass, $m).removeClass( conf.labelClass ).addClass( _c.label );

		return $m;
	}

	function _initSubmenus( $m, direction, serial )
	{
		$m.addClass( cls( direction ) );

		$( 'ul ul', $m )
			.addClass( _c.submenu )
			.each(
				function( i )
				{
					var $t = $(this),
						$l = $t.parent(),
						$a = $l.find( '> a, > span' ),
						$p = $l.parent(),
						id = $t.attr( 'id' ) || cls( 's' + serial + '-' + i );

					$t.data( _d.parent, $l );
					$l.data( _d.sub, $t );

					$t.attr( 'id', id );

					var $btn = $( '<a class="' + _c.subopen + '" href="#' + id + '" />' ).insertBefore( $a );
					if ( !$a.is( 'a' ) )
					{
						$btn.addClass( _c.fullsubopen );
					}

					if ( direction == 'horizontal' )
					{
						var id = $p.attr( 'id' ) || cls( 'p' + serial + '-' + i );

						$p.attr( 'id', id );
						$t.prepend( '<li class="' + _c.subtitle + '"><a class="' + _c.subclose + '" href="#' + id + '">' + $a.text() + '</a></li>' );
					}
				}
			);

		if ( direction == 'horizontal' )
		{
			//	Add opened-classes
			$('li.' + _c.selected, $m)
				.parents( 'li.' + _c.selected ).removeClass( _c.selected )
				.end().each(
					function()
					{
						var $t = $(this),
							$u = $t.find( '> ul' );
	
						if ( $u.length )
						{
							$t.parent().addClass( _c.subopened ).addClass( _c.subopening );
							$u.addClass( _c.opened );
						}
					}
				)
				.parent().addClass( _c.opened )
				.parents( 'ul' ).addClass( _c.subopened ).addClass( _c.subopening );

			if ( !$('ul.' + _c.opened, $m).length )
			{
				$('ul', $m).not( '.' + _c.submenu ).addClass( _c.opened );
			}

			//	Rearrange markup
			$('ul ul', $m).appendTo( $m );
		}
		else
		{
			//	Replace Selected-class with opened-class in parents from .Selected
			$('li.' + _c.selected, $m)
				.addClass( _c.opened )
				.parents( '.' + _c.selected ).removeClass( _c.selected );
		}
	}
	function _initBlocker( $b, $m, conf )
	{
		if ( !$b )
		{
			$b = $( '<div id="' + _c.blocker + '" />' ).appendTo( $body );
		}

		click( $b,
			function()
			{
				$m.trigger( _e.close );
			}, true, true
		);
		return $b;
	}
	function _initLinks( $m, onClick, conf )
	{
		if ( onClick.close )
		{
			var $a = $('a', $m)
				.not( '.' + _c.subopen )
				.not( '.' + _c.subclose );

			click( $a,
				function()
				{
					var $t = $(this),
						href = $t.attr( 'href' );
	
					$m.trigger( _e.close );
					$a.parent().removeClass( _c.selected );
					$t.parent().addClass( _c.selected );

					if ( onClick.blockUI && href.slice( 0, 1 ) != '#' )
					{
						$html.addClass( _c.blocking );
					}

					if ( href != '#' )
					{
						setTimeout(
							function()
							{
								window.location.href = href;
							}, onClick.delayPageload
						);
					}
				}
			);
		}
	}
	function _initOpenClose( $m, $p, horizontal )
	{
		//	toggle menu
		var id = $m.attr( 'id' );
		if ( id && id.length )
		{
			click( 'a[href="#' + id + '"]',
				function()
				{
					$m.trigger( _e.toggle );
				}
			);
		}

		//	close menu
		var id = $p.attr( 'id' );
		if ( id && id.length )
		{
			click( 'a[href="#' + id + '"]',
				function()
				{
					$m.trigger( _e.close );
				}
			);
		}

		//	open/close horizontal submenus
		if ( horizontal )
		{
			click( $('a.' + _c.subopen, $m),
				function()
				{
					var $submenu = $(this).parent().data( _d.sub );
					if ( $submenu )
					{
						$submenu.trigger( _e.open );
					}
				}
			);
			click( $('a.' + _c.subclose, $m),
				function()
				{
					$(this).parent().parent().trigger( _e.close );
				}
			);
		}

		//	open/close vertical submenus
		else
		{
			click( $('a.' + _c.subopen, $m),
				function()
				{
					var $submenu = $(this).parent().data( _d.sub );
					if ( $submenu )
					{
						$submenu.trigger( _e.toggle );
					}
				}
			);
		}
	}

	function openMenu( $m, o, c )
	{
		var _scrollTop = findScrollTop();

		$allMenus.not( $m ).trigger( _e.close );

		//	store style and position
		$page
			.data( _d.style, $page.attr( 'style' ) || '' )
			.data( _d.scrollTop, _scrollTop )
			.data( _d.offetLeft, $page.offset().left );

		//	resize page to window width
		var _w = 0;
		$wndw.off( _e.resize )
			.on( _e.resize,
				function( e )
				{
					var nw = $wndw.width();
					if ( nw != _w )
					{
						_w = nw;
						$page.width( nw - $page.data( _d.offetLeft ) );
					}
				}
			).trigger( _e.resize );

		//	prevent tabbing out of the menu
		if ( c.preventTabbing )
		{
			$wndw.off( _e.keydown )
				.on( _e.keydown,
					function( e )
					{
						if ( e.keyCode == 9 )
						{
							e.preventDefault();
							return false;
						}
					}
				);
		}

		//	open
		$m.addClass( _c.opened );

		if ( c.hardwareAcceleration )
		{
			$html.addClass( _c.accelerated );
		}
		$html
			.addClass( _c.opened )
			.addClass( cls( o.position ) );

		$page.scrollTop( _scrollTop );

		//	small timeout to ensure the "opened" class did its job
		setTimeout(
			function()
			{
				//	callback
				transitionend( $page,
					function()
					{
						//	opened
						$m.trigger( _e.opened );
					}, c.slideDuration
				);

				//	opening
				$html.addClass( _c.opening );
				$m.trigger( _e.opening );
			}, 10
		);

		return 'open';
	}
	function closeMenu( $m, o, c )
	{
		//	callback
		transitionend( $page,
			function()
			{
				$m.removeClass( _c.opened );

				$html.removeClass( _c.opened )
					.removeClass( cls( o.position ) )
					.removeClass( _c.accelerated );

				//	restore style and position
				$page.attr( 'style', $page.data( _d.style ) );
				$wndw.off( _e.resize );
				if ( $scrollTopNode )
				{
					$scrollTopNode.scrollTop( $page.data( _d.scrollTop ) );
				}
				
				//	closed
				$m.trigger( _e.closed );

			}, c.slideDuration
		);

		//	closing
		$html.removeClass( _c.opening );
		$wndw.off( _e.keydown );
		$m.trigger( _e.closing );

		return 'close';
	}

	function openSubmenuHorizontal( $submenu, o )
	{
		if ( $submenu.hasClass( _c.opened ) )
		{
			return false;
		}

		$body.scrollTop( 0 );
		$html.scrollTop( 0 );

		$submenu
			.removeClass( _c.subopening )
			.addClass( _c.opened );
		
		var $parent = $submenu.data( _d.parent );
		if ( $parent )
		{
			$parent.parent().addClass( _c.subopening );
		}
		return 'open';
	}
	function closeSubmenuHorizontal( $submenu, $m, o )
	{
		if ( !$submenu.hasClass( _c.opened ) )
		{
			return false;
		}

		//	callback
		transitionend( $m,
			function()
			{
				$submenu.removeClass( _c.opened );
			}, o.configuration.slideDuration
		);

		var $parent = $submenu.data( _d.parent );
		if ( $parent )
		{
			$parent.parent().removeClass( _c.subopening );
		}
		return 'close';
	}

	function preventKeypressSearch( c )
	{
		switch( c )
		{
			case 9:		//	tab
			case 16:	//	shift
			case 17:	//	control
			case 18:	//	alt
			case 37:	//	left
			case 38:	//	top
			case 39:	//	right
			case 40:	//	bottom
				return true;
		}
		return false;
	}

	function findScrollTop()
	{
		if ( !$scrollTopNode )
		{
			if ( $html.scrollTop() != 0 )
			{
				$scrollTopNode = $html;
			}
			else if ( $body.scrollTop() != 0 )
			{
				$scrollTopNode = $body;
			}
		}
		return ( $scrollTopNode ) ? $scrollTopNode.scrollTop() : 0;
	}

	function transitionend( $m, fn, duration )
	{
		if ( $.fn.mmenu.support.transition )
		{
			$m.one( 'transitionend', fn );
		}
		else
		{
			setTimeout( fn, duration );
		}
	}
	function click( $b, fn, onTouchStart, add )
	{
		if ( typeof $b == 'string' )
		{
			$b = $( $b );
		}

		var event = ( onTouchStart )
			? $.fn.mmenu.support.touch
				? _e.touchstart
				: _e.mousedown
			: _e.click;

		if ( !add )
		{
			$b.off( event );
		}
		$b.on( event,
			function( e )
			{
				e.preventDefault();
				e.stopPropagation();

				fn.call( this, e );
			}
		);
	}

	function cls( c )
	{
		return 'mmenu-' + c;
	}
	function evt( e )
	{
		return e + '.mmenu';
	}
	function dta( d )
	{
		return 'mmenu-' + d;
	}

})( jQuery );