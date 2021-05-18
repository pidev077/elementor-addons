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


	var counterUp = window.counterUp["default"]; // import counterUp from "counterup2"

	var $counters = $(".elementor-counter__number");

	/* Start counting, do this on DOM ready or with Waypoints. */
	$counters.each(function (ignore, counter) {
	var waypoint = new Waypoint( {
		element: $(this),
		handler: function() {
			counterUp(counter, {
				duration: 2000,
				delay: 16
			});
			this.destroy();
		},
		offset: 'bottom-in-view',
	} );
	});

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
		elementorFrontend.hooks.addAction( 'frontend/element_ready/be-card-carousel.default', SwiperSliderHandler );
	} );
!function(t,e){"object"==typeof exports&&"object"==typeof module?module.exports=e():"function"==typeof define&&define.amd?define([],e):"object"==typeof exports?exports.counterUp=e():t.counterUp=e()}(window,function(){return function(t){var e={};function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}return n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)n.d(r,o,function(e){return t[e]}.bind(null,o));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=0)}([function(t,e,n){"use strict";n.r(e),n.d(e,"divideNumbers",function(){return o}),n.d(e,"hasComma",function(){return i}),n.d(e,"isFloat",function(){return u}),n.d(e,"decimalPlaces",function(){return l});e.default=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=e.action,i=void 0===n?"start":n,u=e.duration,l=void 0===u?1e3:u,a=e.delay,c=void 0===a?16:a,d=e.lang,f=void 0===d?void 0:d;if("stop"!==i){if(r(t),/[0-9]/.test(t.innerHTML)){var s=o(t.innerHTML,{duration:l||t.getAttribute("data-duration"),lang:f||document.querySelector("html").getAttribute("lang")||void 0,delay:c||t.getAttribute("data-delay")});t._countUpOrigInnerHTML=t.innerHTML,t.innerHTML=s[0],t.style.visibility="visible",t.countUpTimeout=setTimeout(function e(){t.innerHTML=s.shift(),s.length?(clearTimeout(t.countUpTimeout),t.countUpTimeout=setTimeout(e,c)):t._countUpOrigInnerHTML=void 0},c)}}else r(t)};var r=function(t){clearTimeout(t.countUpTimeout),t._countUpOrigInnerHTML&&(t.innerHTML=t._countUpOrigInnerHTML,t._countUpOrigInnerHTML=void 0),t.style.visibility=""},o=function(t){for(var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=e.duration,r=void 0===n?1e3:n,o=e.delay,i=void 0===o?16:o,u=e.lang,l=void 0===u?void 0:u,a=r/i,c=t.toString().split(/(<[^>]+>|[0-9.][,.0-9]*[0-9]*)/),d=[],f=0;f<a;f++)d.push("");for(var s=0;s<c.length;s++)if(/([0-9.][,.0-9]*[0-9]*)/.test(c[s])&&!/<[^>]+>/.test(c[s])){var p=c[s],v=/[0-9]+,[0-9]+/.test(p);p=p.replace(/,/g,"");for(var g=/^[0-9]+\.[0-9]+$/.test(p),y=g?(p.split(".")[1]||[]).length:0,b=d.length-1,m=a;m>=1;m--){var T=parseInt(p/a*m,10);g&&(T=parseFloat(p/a*m).toFixed(y),T=parseFloat(T).toLocaleString(l)),v&&(T=T.toLocaleString(l)),d[b--]+=T}}else for(var M=0;M<a;M++)d[M]+=c[s];return d[d.length]=t.toString(),d},i=function(t){return/[0-9]+,[0-9]+/.test(t)},u=function(t){return/^[0-9]+\.[0-9]+$/.test(t)},l=function(t){return u(t)?(t.split(".")[1]||[]).length:0}}])});
} )( jQuery );
