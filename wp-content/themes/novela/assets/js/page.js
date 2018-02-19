jQuery(document).ready(function($) {

	"use strict";

	/**
	* AJAX Success.
	*/
	function ajaxSuccess(html){
		$( '#book-container' ).remove()
		$('.main-content').prepend(html);

		var Page = (function() {

			var $container = $( '#book-container' ),
				$bookBlock = $( '#bb-bookblock' ),
				// $items = $bookBlock.children(),
				// itemsCount = $items.length,
				$items = $bookBlock.children(),
				itemsCount = $items.length,
				current = 0,
				bb = $( '#bb-bookblock' ).bookblock( {
					speed : 800,
					perspective : 2000,
					shadowSides	: 0.8,
					shadowFlip	: 0.4,
					onEndFlip : function(old, page, isLimit) {
						
						current = page;
						// update TOC current
						updateTOC();
						// updateNavigation
						updateNavigation( isLimit );
						// initialize jScrollPane on the content div for the new item
						setJSP( 'init' );
						// destroy jScrollPane on the content div for the old item
						setJSP( 'destroy', old );

					}
				} ),
				$navNext = $( '#bb-nav-next' ),
				$navPrev = $( '#bb-nav-prev' ).hide(),
				$menuItems = $container.find( 'ul.menu-toc > li' ),
				$tblcontents = $( '#tblcontents' ),
				transEndEventNames = {
					'WebkitTransition': 'webkitTransitionEnd',
					'MozTransition': 'transitionend',
					'OTransition': 'oTransitionEnd',
					'msTransition': 'MSTransitionEnd',
					'transition': 'transitionend'
				},
				transEndEventName = transEndEventNames[Modernizr.prefixed('transition')],
				supportTransitions = Modernizr.csstransitions;

				// init();

			function init() {

				// initialize jScrollPane on the content div of the first item
				setJSP( 'init' );
				initEvents();

			}
			
			function initEvents() {

				// add navigation events
				$navNext.on( 'click', function() {
					bb.next();
					return false;
				} );

				$navPrev.on( 'click', function() {
					bb.prev();
					return false;
				} );
				
				// add swipe events
				$items.on( {
					'swipeleft'		: function( event ) {
						if( $container.data( 'opened' ) ) {
							return false;
						}
						bb.next();
						return false;
					},
					'swiperight'	: function( event ) {
						if( $container.data( 'opened' ) ) {
							return false;
						}
						bb.prev();
						return false;
					}
				} );

				// show table of contents
				$tblcontents.on( 'click', toggleTOC );

				// click a menu item
				$menuItems.on( 'click', function() {

					var $el = $( this ),
						idx = $el.index(),
						jump = function() {
							bb.jump( idx + 1 );
						};
					
					current !== idx ? closeTOC( jump ) : closeTOC();

					return false;
					
				} );

				// reinit jScrollPane on window resize
				$( window ).on( 'debouncedresize', function() {
					// reinitialise jScrollPane on the content div
					setJSP( 'reinit' );
				} );

			}

			function setJSP( action, idx ) {
				
				var idx = idx === undefined ? current : idx,
					$content = $items.eq( idx ).children( 'div.book-content' ),
					apiJSP = $content.data( 'jsp' );
				
				if( action === 'init' && apiJSP === undefined ) {
					$content.jScrollPane({verticalGutter : 0, hideFocus : true });
				}
				else if( action === 'reinit' && apiJSP !== undefined ) {
					apiJSP.reinitialise();
				}
				else if( action === 'destroy' && apiJSP !== undefined ) {
					apiJSP.destroy();
				}

			}

			function updateTOC() {
				$menuItems.removeClass( 'menu-toc-current' ).eq( current ).addClass( 'menu-toc-current' );
			}

			function updateNavigation( isLastPage ) {
				
				if( current === 0 ) {
					$navNext.show();
					$navPrev.hide();
				}
				else if( isLastPage ) {
					$navNext.hide();
					$navPrev.show();
				}
				else {
					$navNext.show();
					$navPrev.show();
				}

			}

			function toggleTOC() {
				var opened = $container.data( 'opened' );
				opened ? closeTOC() : openTOC();
			}

			function openTOC() {
				$navNext.hide();
				$navPrev.hide();
				$container.addClass( 'slideRight' ).data( 'opened', true );
			}

			function closeTOC( callback ) {

				updateNavigation( current === itemsCount - 1 );
				$container.removeClass( 'slideRight' ).data( 'opened', false );
				if( callback ) {
					if( supportTransitions ) {
						$container.on( transEndEventName, function() {
							$( this ).off( transEndEventName );
							callback.call();
						} );
					}
					else {
						callback.call();
					}
				}

			}

			return { init : init };

		})();

		Page.init();

	}

	/**
	* Flip Book.
	*/

	function resizeBook(){
		$('.book-container, .bb-custom-wrapper, .bb-bookblock').css({
			'width' : $(window).width(),
			'height' : $(window).height()
		})
	}


	$(window).on('resize', function(){
		resizeBook();
	})


	/**
	* Read Book button.
	*/

	$('.read-book-button').on('click', function(event){
		event.preventDefault();

		var id = $(this).data('id');

		$.ajax({
			type: 'post',
			dataType: 'html',
			url: sdesignsAjax.ajaxurl,
			data: {
				action : 'sdesigns_ajax_bookblock_function',
				id : id
			},
			success: function(html) {

				ajaxSuccess(html);
				$('#book-container').addClass('showBook');
				resizeBook();
				$(window).trigger('debouncedresize');
	    	}
		});

		$('.header').hide();
		// $( '#book-container .menu-toc > li' ).eq(0).addClass( 'menu-toc-current' );

	})


	$(document).on('click', '.bb-nav-close', function(event){
		var $this = $(this);
		$this.parents('#book-container').removeClass('showBook');
		$('.header').show();
	})


})