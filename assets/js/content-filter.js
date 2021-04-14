( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */
	var WidgetContentFilterHandler = function( $scope, $ ) {
      var toggleFilter = $('.btn-filter');
      var optionFilter = $('.__filter-options');
      $scope.find('.btn-filter').click(function (e) {
        if(toggleFilter.hasClass('__is-actived')){
          toggleFilter.removeClass('__is-actived');
          optionFilter.slideUp();
        }else{
          toggleFilter.addClass('__is-actived');
          optionFilter.slideDown();
        }
      });
	};

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ica-content-filter.default', WidgetContentFilterHandler );
	} );
} )( jQuery );
