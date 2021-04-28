( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */
	var TestimonialHandler = function( $scope, $ ) {
		//console.log( $scope );

    var items =  $scope.find('.elementor-testimonial__item').length,
        shown =  5;

		$scope.find('.elementor-testimonial__item:lt(5)').show();
    $scope.find('.btn-see-less').hide();

		$scope.find('.result').html(shown+' of '+items+' Testimonials');


    $scope.find('.btn-see-more').click(function (e) {
      e.preventDefault();

      shown = $scope.find('.elementor-testimonial__item:visible').length + 3;
      if(shown < items) {
        $scope.find('.elementor-testimonial__item:lt('+shown+')').slideDown();
				$scope.find('.result').html(shown+' of '+items+' Testimonials');
      } else {
        $scope.find('.elementor-testimonial__item:lt('+items+')').slideDown();
				$scope.find('.result').html(items+' of '+items+' Testimonials');
        $scope.find('.btn-see-more').hide();
        $scope.find('.btn-see-less').show();
      }

      $('html,body').animate({
        scrollTop: $(this).offset().top
      }, 500);

    });
    $scope.find('.btn-see-less').click(function (e) {
      e.preventDefault();
      $scope.find('.elementor-testimonial__item').not(':lt(5)').slideUp();
			$scope.find('.result').html('5 of '+items+' Testimonials');
      $scope.find('.btn-see-more').show();
      $scope.find('.btn-see-less').hide();
    });

	};
	var SwiperSliderHandler = function( $scope, $ ) {
		//console.log($scope);
		var $selector = $scope.find('.swiper-container'),
				$dataSwiper  = $selector.data('swiper'),
				mySwiper = new Swiper($selector, $dataSwiper);

	};
	var CounterHandler = function( $scope, $ ) {
	//console.log($scope);

	var test = function() {
		window.__beCounter = []

		var do_counter = function( $elem ) {
			var counter = $elem.data( 'counter' )
			return new Waypoint({
				element: $elem,
				handler: function() {
					$elem.numerator( counter );
				},
				offset: '100%',
				triggerOnce: true
			});
		}

		for( var i = 1; i <= 10; i++ ) {
			var class_selector = `.elementor-counter__number.vv${ i }`
			var counterElem = jQuery( class_selector, $scope )

			if( counterElem.length != 0 ) {
				//console.log(counterElem, class_selector);
				window.__beCounter.push( do_counter( counterElem ) )
			}
		}
	}
	test()


};
//};
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/be-testimonial-carousel.default', SwiperSliderHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/be-posts.default', SwiperSliderHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/be-top-faq.default', SwiperSliderHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/be-latest-resources.default', SwiperSliderHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/be-testimonial.default', TestimonialHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/be-counter.default', CounterHandler );
	} );
} )( jQuery );
