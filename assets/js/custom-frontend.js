(function ($) {
    'use strict';

    // funtion tabs in elements accordion navigation tabs
    function tabsElement() {

        let titleTabs = $('.accordion-navigation-tabs-elements .accordion-navigation-tabs-title .item-tabs-title');
        var isTabs = $('.accordion-navigation-tabs-elements .accordion-navigation-tabs-content .item-tabs-content');
        let dataTabs;
        titleTabs.on('click',function(){
            dataTabs = $(this).data('tab');
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
            isTabs.removeClass('active');
            $('.accordion-navigation-tabs-elements .accordion-navigation-tabs-content .item-tabs-content.'+dataTabs).addClass('active');
        });

    }

    // funtion show all content in elements accordion navigation tabs
    function showAllContent() {

        let isCTA = $('.accordion-navigation-tabs-content .item-team .show-more > span');
        let isContent = $('.accordion-navigation-tabs-content .item-team .meta-team .description');
        let isHeight = isContent.scrollHeight;

        isCTA.on('click',function(e){

            $(this).parent().toggleClass('show-more');
            let fullHeight = $(this).parent().siblings('.content-team').children().find('.description')['0'].scrollHeight;
            let isItem = $(this).parent().siblings('.content-team').children().find('.description');

            if($(this).attr('data-state') == 1) {

                $(this).attr('data-state', 0);
                $(this).text('Collapse');
                isItem.animate({
                    'height': fullHeight
                })

            }else {

                $(this).attr('data-state', 1);
                $(this).text('Expand');
                isItem.animate({
                    'height': '106'
                })
            }

        });
    }

    // funtion hidden modules alert banner in page
    function hiddenModulesAlertBanner() {
        let ctaHidden = $('.alert-banner-elements > .cta-close');
        let isModulseAlertBanner = $('.alert-banner-elements');

        ctaHidden.on('click',function(){
            isModulseAlertBanner.parents('.elementor-section').slideUp(600);
        });
    }



    $( document ).ready(function() {

        tabsElement();
        showAllContent();
        hiddenModulesAlertBanner();

    });


    var WidgetAccordionNavigationTabs = function( $scope, $ ) {

        var tabsTitle   = $scope.find('.item-tabs-title');
        var tabsContent = $scope.find('.item-tabs-content');
        var nameTeam = $scope.find('.name-team');

        // get url tab title
        function getUrlTabs(items){

            items.each(function(){
                let dataUrl = $(this).data('active');
                activeTabsByUrl(dataUrl);

            });
        }

        // active tab and scroll to team
        function activeTabsByUrl(url){
            if(window.location.href.indexOf(url) > -1){
                let params = (new URL(document.location)).searchParams;
                let id = params.get('id');

                tabsTitle.each(function(){

                    if ($(this).attr('data-active') == url) {

                        let dataTab = $(this).data('tab');
                        $(this).addClass('active');
                        tabsContent.removeClass('active');
                        $scope.find('.item-tabs-content.'+dataTab).addClass('active');

                        if (id) {

                            let contentTabsActive = $scope.find('.item-tabs-content.active');
                            let isTeam = contentTabsActive.find(nameTeam);

                            isTeam.each(function(){

                                if ($(this).attr('data-name') == id){
                                    let offsetTeam =  $(this).offset();

            						$('html, body').animate({
            			                scrollTop: offsetTeam.top
            			            }, 500);
                                }

                            });
                        }

                    }else {
                        $(this).removeClass('active');
                    }
                });

            }
        }

        $(window).on('load',function(){
            getUrlTabs(tabsTitle);
        });


    }

    // Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/accordion-navigation-tabs.default', WidgetAccordionNavigationTabs );
	} );


}) (jQuery);
