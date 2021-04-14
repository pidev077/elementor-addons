( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */
	var WidgetContentFilterHandler = function( $scope, $ ) {
      var toggleFilter = $scope.find('.btn-filter');
      var optionFilter = $scope.find('.__filter-options');
      var selectFilter = $scope.find('.select-filter');
      $scope.find('.btn-filter').click(function (e) {
        if(toggleFilter.hasClass('__is-actived')){
          toggleFilter.removeClass('__is-actived');
          optionFilter.slideUp();
        }else{
          toggleFilter.addClass('__is-actived');
          optionFilter.slideDown();
        }
      });
      $scope.find('.ica-item-filter .name-filter').on('click',function(){
        var select = $(this).closest('.ica-item-filter').find('.select-filter');
        if(select.hasClass('__is-opened')){
          select.removeClass('__is-opened');
          select.slideUp();
        }else{
          select.addClass('__is-opened');
          select.slideDown();
        }
      });
			var $auto = $scope.find('select[name="date-range-end"]');
			$scope.find('select[name="date-range-start"]').on('change', function () {
			    var value = +$(this).val();
					if(value < 1) return;
			    $auto.empty();
			    for (var i = 0; i < 20; i++) {
			        $('<option>', {
			            text: i + value
			        }).appendTo($auto);
			    }
			}).change()
	};

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ica-content-filter.default', WidgetContentFilterHandler );
	} );
} )( jQuery );
