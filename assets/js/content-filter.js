( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */
	var WidgetContentFilterHandler = function( $scope, $ ) {
      var toggleFilter = $scope.find('.btn-filter');
      var optionFilter = $scope.find('.__filter-options');
      var selectFilter = $scope.find('.select-filter');
			var ResultFilter = $scope.find('.content-filter-results');
			var inputSearch  = $scope.find('input[name="key"]');
			var btnSearch  	 = $scope.find('button[type="submit"]');
			var logError     = $scope.find('.log-error');
			var btnSuggestion = $scope.find('.btn-suggestion');

			//Show and Hide Filters
      toggleFilter.click(function (e) {
        if(toggleFilter.hasClass('__is-actived')){
          toggleFilter.removeClass('__is-actived');
          optionFilter.slideUp();
        }else{
          toggleFilter.addClass('__is-actived');
          optionFilter.slideDown();
        }
      });

			//Render select
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

			// Auto render end year
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
			}).change();

			//Search key
			var btnRemoveAll = $scope.find('.btn-removeall');
			if(inputSearch.val() != '') btnRemoveAll.show();
			inputSearch.on('keyup',function(event){
				let val = $(this).val();
				if(val !== ''){ btnRemoveAll.show(); }else{ btnRemoveAll.hide(); }
			});
			btnRemoveAll.on('click',function(){
				inputSearch.val('');
				btnRemoveAll.hide();
				return false;
			});

			//Auto Suggestions
		  var substringMatcher = function(strs) {
		    return function findMatches(q, cb) {
		      var matches, substringRegex;
		      // an array that will be populated with substring matches
		      matches = [];
		      // regex used to determine if a string contains the substring `q`
		      substrRegex = new RegExp(q, 'i');
		      // iterate through the pool of strings and for any string that
		      // contains the substring `q`, add it to the `matches` array
		      $.each(strs, function(i, str) {
		        if (substrRegex.test(str)) {
		          matches.push(str);
		        }
		      });
		      cb(matches);
		    };
		  };
			var keys = $scope.find('.ica-content-filter').data('keys');
		  $scope.find('.typeahead').typeahead({
		      hint: true,
		      highlight: true,
		      minLength: 1
		    },
		    {
	      name: 'keys',
	      source: substringMatcher(keys.split(",")),
				templates: {
			    header: '<h3 class="league-name">Suggestions:</h3>'
			  }
		  });

			//Button Suggestions
			btnSuggestion.on('click',function(){
				var val = $(this).data('value');
				inputSearch.val(val);
				if(val !== ''){ btnRemoveAll.show(); }else{ btnRemoveAll.hide(); }
			});

			//Search content
			var key = '';
			var filters = [];
			btnSearch.on('click',function(){
				var ajax = $(this).data('ajax');

				if(validationForm()){
					return false;
				}else{
					logError.slideUp();
				}
				if(ajax){
					loadFilterData(inputSearch.val(),filters);
					return false;
				}
			});

			function validationForm(){
				if(inputSearch.val().trim() == ''){
					logErrorForm('The key search is empty!');
					return true;
				}
				return false;
			}

			function logErrorForm($error){
				logError.empty();
				logError.html($error);
				logError.slideDown();
			}

			function loadFilterData(key,filters){
				$scope.addClass('__is-loading');
				jQuery.ajax({
	          url: ajaxObject.ajaxUrl,
	          data:{
	               'action':'load_filter_data',
	          },
	          dataType: 'JSON',
	          success:function(response){
							console.log(response);
							$scope.removeClass('__is-loading');
	          },
	          error: function(errorThrown){
	            console.log(errorThrown);
							$scope.removeClass('__is-loading');
	          }
	     });
			}


	};

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ica-content-filter.default', WidgetContentFilterHandler );
	} );

} )( jQuery );
