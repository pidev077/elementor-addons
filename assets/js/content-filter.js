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
		var resultFilter2   = $scope.find('.content-filter-results2');
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
		var paged2 = 1;

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
			var select = $(this).closest('.ica-item-filter');
			if(select.hasClass('__is-opened')){
				select.removeClass('__is-opened');
				select.find('.select-filter').slideUp();
			}else{
				select.addClass('__is-opened');
				select.find('.select-filter').slideDown();
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
					var year_end = i + value;
					$('<option>', {
						text: year_end
					}).appendTo($auto);
					if(year_end == ajaxObject.year_current) break;
				}
				var end_date = window.location.search.match(new RegExp('(?:[\?\&]end_date=)([^&]+)'));
				if(end_date){
					$auto.val(end_date[1]);
				}
		}).change();

		//Search key
		var btnRemoveAll = $scope.find('.btn-removeall');
		if(inputSearch.val() != '') btnRemoveAll.show();
		inputSearch.on('keyup',function(event){
			let val = $(this).val();
			if(val !== ''){ btnRemoveAll.show(); }else{ btnRemoveAll.hide(); }
		});

		// Enter key on the keyboard, then submit
		inputSearch.on("keypress", function (event) {

			var keyPressed = event.keyCode || event.which;
			if (keyPressed === 13) {

				let redirect = btnSearch.data('redirect');

				if (redirect) {
					var $linkSearch = redirect;
					if(inputSearch.val() != '') $linkSearch += '?key=' + inputSearch.val();
					listFilters.each(function(index,e){
						var filter = $(e).data('filter');
						var vals = [];
						var start_date = '';
						var end_date = '';
						if(filter != 'date'){
							$(e).find('input[name="'+filter+'"]').each(function(i,e){
								if($(e).prop("checked") == true){
									vals.push($(e).val());
								}
							});
							filter = filter.replace('ins-','');
							if(vals.length > 0) $linkSearch += ($linkSearch.indexOf('?') > 0 ? '&' : '?' )+filter+'=' + vals.join(',');
						}
						if(filter == 'date'){
							start_date = $(e).find('select[name="date-range-start"]').val();
							end_date = $(e).find('select[name="date-range-end"]').val();
							if(start_date) $linkSearch += ($linkSearch.indexOf('?') > 0 ? '&' : '?' )+'start_date=' + start_date;
							if(end_date) $linkSearch += ($linkSearch.indexOf('?') > 0 ? '&' : '?' ) + 'end_date=' + end_date;
						}
					});
					window.location.href = $linkSearch;
				}else {
					loadFilterData(inputSearch.val(),'filter');
				}

				return false;
			}
		});

		//remove key
		btnRemoveAll.on('click',function(){
			inputSearch.val('');
			btnRemoveAll.hide();
			let ajax = $(this).data('ajax');
			if (ajax) {
				loadFilterData(inputSearch.val(),'filter');
			}
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


			let redirect = btnSearch.data('redirect');

			if (redirect) {
				var $linkSearch = redirect;
				if(inputSearch.val() != '') $linkSearch += '?key=' + inputSearch.val();
				listFilters.each(function(index,e){
					var filter = $(e).data('filter');
					var vals = [];
					var start_date = '';
					var end_date = '';
					if(filter != 'date'){
						$(e).find('input[name="'+filter+'"]').each(function(i,e){
							if($(e).prop("checked") == true){
								vals.push($(e).val());
							}
						});
						filter = filter.replace('ins-','');
						if(vals.length > 0) $linkSearch += ($linkSearch.indexOf('?') > 0 ? '&' : '?' )+filter+'=' + vals.join(',');
					}
					if(filter == 'date'){
						start_date = $(e).find('select[name="date-range-start"]').val();
						end_date = $(e).find('select[name="date-range-end"]').val();
						if(start_date) $linkSearch += ($linkSearch.indexOf('?') > 0 ? '&' : '?' )+'start_date=' + start_date;
						if(end_date) $linkSearch += ($linkSearch.indexOf('?') > 0 ? '&' : '?' ) + 'end_date=' + end_date;
					}
				});
				window.location.href = $linkSearch;
			}else {
				loadFilterData(inputSearch.val(),'filter');
			}

		});

		//Search content
		btnSearch.on('click',loadFilters);
		btnFilters.on('click',loadFilters);
		btnClearAll.on('click',clearAllFilters);
		$scope.on('click','button[name="button-showmore"]',loadMoreContent);
		$scope.on('click', '.item-filter i.fa', removeFilterItem);
		$scope.on('click', '.btn-sortby span', showHideSortby);
		$scope.on('click', '.item-sortby', loadDataSortby);
  	$scope.on('click','.template-ins-faqs-list .__title', toggleContentFAQ);

		function loadFilters(){
			var ajax = $(this).data('ajax');
			var redirect = $(this).data('redirect');

			if(ajax){
				loadFilterData(inputSearch.val(),'filter');
			}else{
				// similar behavior as clicking on a link
				var $linkSearch = redirect;
				if(inputSearch.val() != '') $linkSearch += '?key=' + inputSearch.val();
				listFilters.each(function(index,e){
					var filter = $(e).data('filter');
					var vals = [];
					var start_date = '';
					var end_date = '';
					if(filter != 'date'){
						$(e).find('input[name="'+filter+'"]').each(function(i,e){
						if($(e).prop("checked") == true){
							vals.push($(e).val());
						}
						});
						filter = filter.replace('ins-','');
						if(vals.length > 0) $linkSearch += ($linkSearch.indexOf('?') > 0 ? '&' : '?' )+filter+'=' + vals.join(',');
					}
					if(filter == 'date'){
						start_date = $(e).find('select[name="date-range-start"]').val();
						end_date = $(e).find('select[name="date-range-end"]').val();
						if(start_date) $linkSearch += ($linkSearch.indexOf('?') > 0 ? '&' : '?' )+'start_date=' + start_date;
						if(end_date) $linkSearch += ($linkSearch.indexOf('?') > 0 ? '&' : '?' ) + 'end_date=' + end_date;
					}
				});
				window.location.href = $linkSearch;
			}
		}

		function loadMoreContent(){
			var type_filter = $(this).data('type_filter');
			loadFilterData(inputSearch.val(),'loadmore',type_filter);
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

		function loadDataSortby(){
			var order = $(this).data('order');
			var orderby = $(this).data('orderby');
			var sortby_temp = $(this).closest('.content-sortby');
			sortby_temp.find('.item-sortby').removeClass('__is-actived');
			$(this).addClass('__is-actived');
			if(order == 'desc'){
				$(this).data('order','asc');
			}else{
				$(this).data('order','desc');
			}
			var neworder = $(this).data('order');
			var type_filter = sortby_temp.data('type_filter');
			if(type_filter == 2){
				$scope.find('.ica-content-filter').data('order2',neworder);
				$scope.find('.ica-content-filter').data('orderby2',orderby);
			}else{
				$scope.find('.ica-content-filter').data('order',neworder);
				$scope.find('.ica-content-filter').data('orderby',orderby);
			}
			loadFilterData(inputSearch.val(),'sortby',type_filter);
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

		function toggleContentFAQ(){
			var $this = $(this);
			var $item = $this.closest('.item-content-filter');
			var $list = $this.closest('.list-grids');
			if($item.hasClass('__is-showed')){
				$item.find('.__info').slideUp();
				$item.removeClass('__is-showed');
			}else{
				$list.find('.__info').slideUp();
				$list.find('.item-content-filter').removeClass('__is-showed');
				$item.find('.__info').slideDown();
				$item.addClass('__is-showed');
			}
		}

		var masonryOptions = {
			 isFitWidth: true,
 			 gutter: 21,
 			 itemSelector: '.item-content-filter'
		};

		// initialize Masonry
		var template 			 = $scope.find('.ica-content-filter').data('template');
		var template2 		 = $scope.find('.ica-content-filter').data('template2');
		var showfilter2 	 = $scope.find('.ica-content-filter').data('files2');
		if(template != 'list') resultFilter.find('.list-grids').masonry( masonryOptions );
		if(showfilter2 == 'yes' && template2 != 'list'){
			resultFilter2.find('.list-grids').masonry( masonryOptions );
		}

		//Load default data
		var showcontent = $scope.find('.ica-content-filter').data('showcontent');
		if(showcontent) loadFilterData(inputSearch.val(),'default');

		function loadFilterData($key,$option,$type_filter = 'all'){

			if($option !== 'loadmore') paged = 1;
			$scope.addClass('__is-loading');
			var filters = [];
			var post_type = $scope.find('.ica-content-filter').data('post');
			var numberposts = $scope.find('.ica-content-filter').data('numberposts');
			var orderby = ($option == 'sortby') ? $scope.find('.content-sortby .__is-actived').data('orderby') : $scope.find('.ica-content-filter').data('orderby');
			var order = ($option == 'sortby') ? $scope.find('.content-sortby .__is-actived').data('order') :  $scope.find('.ica-content-filter').data('order');
			var pagination = $scope.find('.ica-content-filter').data('pagination');
			var template = $scope.find('.ica-content-filter').data('template');
			var sortby = $scope.find('.ica-content-filter').data('sortby');
			var cats_faq = $scope.find('.ica-content-filter').data('cat_faq');
			var ex_cats_faq = $scope.find('.ica-content-filter').data('ex_cat_faq');
			var select_team = $scope.find('.ica-content-filter').data('select_team');
			var post_type2 = $scope.find('.ica-content-filter').data('post2');
			var numberposts2= $scope.find('.ica-content-filter').data('numberposts2');
			var orderby2 = $scope.find('.ica-content-filter').data('orderby2');
			var order2 = $scope.find('.ica-content-filter').data('order2');
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

			if($type_filter == 'all' || $type_filter == '1'){
				jQuery.ajax({
					type: 'POST',
					url: ajaxObject.ajaxUrl,
					data:{
						'action'				:'load_filter_data',
						'key' 					: $key,
						'post_type' 		: post_type,
						'numberposts'   : numberposts,
						'orderby' 			: orderby,
						'order' 				: order,
						'filters' 			: filters,
						'pagination'    : pagination,
						'sortby'				: sortby,
						'paged'         : paged,
						'option'				: $option,
						'cats_faq'      : cats_faq,
						'ex_cats_faq'   : ex_cats_faq,
						'template'			: template,
						'type_filter' 	: '1',
						'select_team'		: select_team
					},
					dataType: 'JSON',
					success:function(response){
						if($option == 'loadmore'){
							paged += 1;
							$scope.find('.content-filter-results .list-grids').append(response.html);
							$scope.find('.content-filter-results .totalpost').text(response.totalpost);
						}else{
							paged = 2;
							resultFilter.html(response.html);
						}
						if(!resultFilter.hasClass('data-loaded')) resultFilter.addClass('data-loaded');
						if(template != 'list'){
							resultFilter.find('.list-grids').masonry('destroy'); // destroy
							resultFilter.find('.list-grids').masonry( masonryOptions ); // re-initialize
						}
						if(!response.countpost){
							resultFilter.css('height','auto');
						}

						//Pagination
						if(!response.pagination){
							$scope.find('.content-filter-results .content-filter-pagination').remove();
						}

						//Button Clear All
						if(filters.length > 0){
							btnClearAll.css('visibility','visible');
						}else{
							btnClearAll.css('visibility','hidden');
						}

						//remove loading
						$scope.removeClass('__is-loading');

						//Scroll FAQs
						if(post_type == 'ins-faqs'){
							setTimeout( () => {
							urlScrollFAQ();
							}, 500);
						}

					},
					error: function(errorThrown){
					console.log(errorThrown);
					$scope.removeClass('__is-loading');
					}
				});
			}
			if (showfilter2 == 'yes' && ($type_filter == 'all' || $type_filter == '2')){
				if($option !== 'loadmore') paged2 = 1;
				$scope.addClass('__is-loading');
				jQuery.ajax({
					type: 'POST',
					url: ajaxObject.ajaxUrl,
					data:{
						'action'				:'load_filter_data',
						'key' 					: $key,
						'filters' 			: filters,
						'pagination'    : pagination,
						'sortby'				: sortby,
						'paged'         : paged2,
						'option'				: $option,
						'numberposts' : numberposts2,
						'orderby' : orderby2,
						'template' : template2,
						'post_type' 	: post_type2,
						'order' : order2,
						'type_filter' : '2'
					},
					dataType: 'JSON',
					success:function(response){
						if($option == 'loadmore'){
							paged2 += 1;
							$scope.find('.content-filter-results2 .list-grids').append(response.html);
							$scope.find('.content-filter-results2 .totalpost').text(response.totalpost);
						}else{
							paged2 = 2;
							resultFilter2.html(response.html);
						}
						if(!resultFilter2.hasClass('data-loaded')) resultFilter2.addClass('data-loaded');
						if(template2 != 'list'){
							resultFilter2.find('.list-grids').masonry('destroy'); // destroy
							resultFilter2.find('.list-grids').masonry( masonryOptions ); // re-initialize
						}
						if(!response.countpost){
							resultFilter2.css('height','auto');
						}

						//Pagination
						if(!response.pagination){
							$scope.find('.content-filter-results2 .content-filter-pagination').remove();
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
		}


		// load url scroll items FAQ
		function urlScrollFAQ() {
			let url = "?active-part";
	        let isFAQ = $('.site-inner .template-ins-faqs-list');
	        let params = (new URL(document.location)).searchParams;
	        let ids = params.get('id');
			let itemFAQ = $scope.find('.template-ins-faqs-list .item-content-filter');
			if((window.location.href.indexOf(url) > -1) && ids){
				itemFAQ.each(function(){
					let $this = $(this);
					if($this.attr('data-part') == ids) {

						let offsetItem =  $this.offset();
						$('html, body').animate({
			                scrollTop: offsetItem.top
			            }, 500);

						$this.addClass('__is-showed');
						$this.addClass('__is-actived');
						$this.children('.__info').slideDown();

					}else {

						$this.removeClass('__is-showed');
						$this.removeClass('__is-actived');
						$this.children('.__info').slideUp();

					}

	            });
			}
		}

		$(document).on('click',function(event) {
			var target = $(event.target).closest(".ica-item-filter");
			if (!target.length) {
				$('.select-filter').slideUp();
				$('.ica-item-filter').removeClass('__is-opened');
			}
			if (!$(event.target).closest(".btn-sortby").length) {
				$('.content-sortby').slideUp();
			}
		});

	};

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ica-content-filter.default', WidgetContentFilterHandler );
	} );

} )( jQuery );
