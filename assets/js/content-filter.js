( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */
	var WidgetContentFilterHandler = function( $scope, $ ) {
      var toggleFilter   = $scope.find('.btn-filter');
      var optionFilter   = $scope.find('.__filter-options');
      var selectFilter   = $scope.find('.select-filter');
			var resultFilter   = $scope.find('.content-filter-results');
			var inputSearch    = $scope.find('input[name="key"]');
			var btnSearch  	   = $scope.find('button[type="submit"]');
			var logError       = $scope.find('.log-error');
			var btnSuggestion  = $scope.find('.btn-suggestion');
			var btnSelectAll   = $scope.find('.btn-select-all');
			var btnUnSelectAll = $scope.find('.btn-deselect-all');
			var btnFilters 		 = $scope.find('.btn-applyfilter');
			var listFilters		 = $scope.find('.ica-item-filter');
			var tempPagination = $scope.find('.content-filter-pagination');
			var btnLoadmore 	 = $scope.find('button[name="button-showmore"]');
			var btnClearAll    = $scope.find('.btn-clearall');
			var paged = 1;

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
					$('<option value="">Select end year</option>').appendTo($auto);
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

			//Select ALL
			btnSelectAll.on('click',function(){
				var box_select = $(this).closest('.select-filter');
				box_select.find('input[type="checkbox"]').prop( "checked", true );
			});

			//UnSelect ALL
			btnUnSelectAll.on('click',function(){
				var box_select = $(this).closest('.select-filter');
				box_select.find('input[type="checkbox"]').prop( "checked", false );
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
			btnSearch.on('click',loadFilters);
			btnFilters.on('click',loadFilters);
			btnClearAll.on('click',clearAllFilters);
			$scope.on('click','button[name="button-showmore"]',loadMoreContent);
			$scope.on('click', '.item-filter i.fa', removeFilterItem);
			$scope.on('click', '.btn-sortby span', showHideSortby);

			function loadFilters(){
				var ajax = $(this).data('ajax');
				var redirect = $(this).data('redirect');
				if(ajax){
					loadFilterData(inputSearch.val(),'filter');
				}else{
					// similar behavior as clicking on a link
					window.location.href = redirect;
				}
			}

			function loadMoreContent(){
				loadFilterData(inputSearch.val(),'loadmore');
			}

			function clearAllFilters(){
				listFilters.each(function(index,e){
					var filter = $(e).data('filter');
					if(filter != 'date'){
						$(e).find('input[name="'+filter+'"]').each(function(i,e){
							if($(e).prop("checked") == true){
	               $(e).prop("checked",false);
	            }
						});
					}
					if(filter == 'date'){
						$(e).find('select[name="date-range-start"]').val('');
						$(e).find('select[name="date-range-end"]').val('');
					}
				});
				loadFilterData(inputSearch.val(),'filter');
			}

			function removeFilterItem(){
				var item = $(this).data('filter');
				$scope.find('input[value="'+item+'"]').prop('checked',false);
				loadFilterData(inputSearch.val(),'filter');
			}

			function showHideSortby(){
				var $this = $(this).closest('.btn-sortby')
				if($this.hasClass('__is-actived')){
					$this.removeClass('__is-actived');
          $this.find('.content-sortby').slideUp();
        }else{
					$this.addClass('__is-actived');
          $this.find('.content-sortby').slideDown();
        }
			}

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

			var masonryOptions = {
				 isFitWidth: true,
	 			 gutter: 21,
	 			 itemSelector: '.item-content-filter'
			};

			// initialize Masonry
			resultFilter.find('.list-grids').masonry( masonryOptions );

			function loadFilterData($key,$option){
				if($option !== 'loadmore') paged = 1;
				$scope.addClass('__is-loading');
				var filters = [];
				var post_type = $scope.find('.ica-content-filter').data('post');
				var numberposts = $scope.find('.ica-content-filter').data('numberposts');
				var orderby = $scope.find('.ica-content-filter').data('orderby');
				var order = $scope.find('.ica-content-filter').data('order');
				var pagination = $scope.find('.ica-content-filter').data('pagination');
				listFilters.each(function(index,e){
					var filter = $(e).data('filter');
					var vals = [];
					if(filter != 'date'){
						$(e).find('input[name="'+filter+'"]').each(function(i,e){
							if($(e).prop("checked") == true){
	               vals.push($(e).val());
	            }
						});
						if(vals.length > 0) filters.push({name : filter , value : vals});
					}
					if(filter == 'date'){
						var start_date = $(e).find('select[name="date-range-start"]').val();
						var end_date = $(e).find('select[name="date-range-end"]').val();
						if(start_date || end_date) filters.push({name : 'post_date' , value : start_date+","+end_date});
					}
				});
				jQuery.ajax({
						type: 'POST',
	          url: ajaxObject.ajaxUrl,
	          data:{
             	 'action'				:'load_filter_data',
							 'key' 					: $key,
							 'post_type' 		: post_type,
							 'numberposts'  : numberposts,
							 'orderby' 			: orderby,
							 'order' 				: order,
							 'filters' 			: filters,
							 'pagination'   : pagination,
							 'paged'        : paged
	          },
	          dataType: 'JSON',
	          success:function(response){
							console.log(response);
							if($option == 'loadmore'){
								paged += 1;
								$scope.find('.list-grids').append(response.html);
								$scope.find('.totalpost').text(response.totalpost);
							}else{
								paged = 2;
								resultFilter.html(response.html);
							}
							resultFilter.find('.list-grids').masonry('destroy'); // destroy
							resultFilter.find('.list-grids').masonry( masonryOptions ); // re-initialize
							if(!response.countpost){
								resultFilter.css('height','auto');
							}

							//Pagination
							if(!response.pagination){
								 $scope.find('.content-filter-pagination').remove();
							}

							//Button Clear All
							if(filters.length > 0){
								 btnClearAll.css('visibility','visible');
							}else{
								 btnClearAll.css('visibility','hidden');
							}

							//remove loading
							$scope.removeClass('__is-loading');
	          },
	          error: function(errorThrown){
	            console.log(errorThrown);
							$scope.removeClass('__is-loading');
	          }
	     });
			}

			$(document).on('click',function(event) {
				  var target = $(event.target).closest(".ica-item-filter");
        	if (!target.length) {
						  $('.select-filter').slideUp();
	            $('.select-filter').removeClass('__is-opened');
	        }
					if (!$(event.target).closest(".btn-sortby")) {
						  $('.content-sortby').slideUp();
	        }
	    });

	};

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ica-content-filter.default', WidgetContentFilterHandler );
	} );

} )( jQuery );
