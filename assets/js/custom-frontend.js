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

        let isCTA = $('.accordion-navigation-tabs-content .item-team .show-more');
        let isContent = $('.accordion-navigation-tabs-content .item-team .meta-team .description');
        isCTA.on('click',function(){
            $(this).toggleClass('show-more');
            $(this).siblings().children().find('.description').toggleClass('active');
            $(this).parents('.item-team').toggleClass('active');
            console.log("aa")
        });

    }


    // funtion check for equal image height in element Secondary CTAs
    function equalImageHeight() {
        let i;
        let totalImage = $('.secondary-ctas-elements .list-items .item .thumbnail').length;
        let isHeight = 0;
        let widthWindow = $( window ).width();
        for (i = 0; i < totalImage; i++){
            let isImage = $('.secondary-ctas-elements .list-items .item .thumbnail.secondary-ctas-thumbnail-'+i);
            let isHeightImage = isImage.outerHeight();

            if(isHeightImage > isHeight) {

                isHeight = isHeightImage;
            }

        }
        if(widthWindow > 767){
            $('.secondary-ctas-elements .list-items .item .thumbnail').css('height',isHeight);
        }else {
            $('.secondary-ctas-elements .list-items .item .thumbnail').css('height', 'auto');
        }
    }
    // funtion hidden modules alert banner in page
    function hiddenModulseAlertBanner() {
        let ctaHidden = $('.alert-banner-elements > .cta-close');
        let isModulseAlertBanner = $('.alert-banner-elements');
        ctaHidden.on('click',function(){
            isModulseAlertBanner.slideUp(400);
            console.log("klkl");
        });
    }

    $( document ).ready(function() {
        tabsElement();
        showAllContent();
        equalImageHeight();
        hiddenModulseAlertBanner();
    });


}) (jQuery);
