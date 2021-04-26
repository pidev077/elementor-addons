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
	console.log($scope);
	var $selector1 = $scope.find('.elementor-counter__number.vv1'),
			$dataCounter1  = $selector1.data('counter'),
			waypoint = new Waypoint({
				element: $selector1,
				handler: function() {
					$selector1.numerator( $dataCounter1 );
				},
				offset: '100%',
				triggerOnce: true
			});
	var $selector2 = $scope.find('.elementor-counter__number.vv2'),
			$dataCounter2  = $selector2.data('counter'),
			waypoint = new Waypoint({
				element: $selector2,
				handler: function() {
					$selector2.numerator( $dataCounter2 );
				},
				offset: '100%',
				triggerOnce: true
			});
	var $selector3 = $scope.find('.elementor-counter__number.vv3'),
			$dataCounter3  = $selector3.data('counter'),
			waypoint = new Waypoint({
				element: $selector3,
				handler: function() {
					$selector3.numerator( $dataCounter3 );
				},
				offset: '100%',
				triggerOnce: true
			});
	var $selector4 = $scope.find('.elementor-counter__number.vv4'),
			$dataCounter4  = $selector4.data('counter'),
			waypoint = new Waypoint({
				element: $selector4,
				handler: function() {
					$selector4.numerator( $dataCounter4 );
				},
				offset: '100%',
				triggerOnce: true
			});

};
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/be-testimonial-carousel.default', SwiperSliderHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/be-posts.default', SwiperSliderHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/be-latest-resources.default', SwiperSliderHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/be-testimonial.default', TestimonialHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/be-counter.default', CounterHandler );
	} );
} )( jQuery );
