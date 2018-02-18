jQuery(document).ready(function($) {

	"use strict";

	/**
	* Remove Empty Paragraphs (Shortcodes)
	*/
	$('p:empty').remove();

	/**
	* Navigation light/dark toggle.
	*/

	var mySlidebar = new $.slidebars();

	$('#toggle-menu').on('click', function() {
		console.log(mySlidebar.slidebars);
	    mySlidebar.slidebars.toggle('right');
	    $(this).toggleClass('toggle-menu-visible').toggleClass('toggle-menu-hidden');
	});

	/**
	* Smooth scroll to.
	*/
	$(function() {
	  $('.sb-slidebar a[href*="#"]:not([href="#"])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top
	        }, 700);
	        return false;
	      }
	    }
	  });
	});





	/**
	* Blog.
	*/

	var $container = $('.blog-posts');

	var columns = 3;

	window.setCols = function () {
		var windowsize = $(document).width();

		if ( windowsize <= 478 ) {
			columns = 1;
		}
		else if ( windowsize <= 767 ) {
			columns = 2;
		} else {
			columns = 3;
		}

		var itemWidth = null;

		$container.children().each(function(){
			var $this = $(this);
			if ( $this.data('width') == 'full' ){
				itemWidth = 100;
			} else {
				itemWidth = 100 / columns;
			}
			$this.css('width', itemWidth + '%');
		})


	}

	setCols();

	$(window).on('debouncedresize', function () {
		setCols();
		$container.isotope({
			resizable: false,
			transitionDuration: 0,
			masonry: {
				columnWidth: $container.width() / columns - 0.5
			}
		});

	}).trigger('debouncedresize');

	$container.imagesLoaded(function () {
		$(window).trigger('debouncedresize');
	});


	/**
	* Characters owl slider.
	*/
	setTimeout(function(){
		$(".characters-owl").each(function(){
			var $this = $(this);
			
			$this.owlCarousel({
				autoPlay: false,
				navigation: true,
				navigationText: ['<i class="fa fa-arrow-left"></i>','<i class="fa fa-arrow-right"></i>'],
				slideSpeed: 400,
				paginationSpeed: 400,
				rewindSpeed: 400,
				singleItem: true,
				autoHeight: true,
				afterMove: function(el){
					api.goTo(this.owl.currentItem + 1);
				}
			});
		})
	}, 50)

});