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
    function hiddenModulesAlertBanner() {
        let ctaHidden = $('.alert-banner-elements > .cta-close');
        let isModulseAlertBanner = $('.alert-banner-elements');
        ctaHidden.on('click',function(){
            isModulseAlertBanner.parents('.elementor-section').slideUp(400);
        });
    }

    // get url tabs
    function getUrlTabs() {

        let isTabs = $('.accordion-navigation-tabs-container .accordion-navigation-tabs-title .item-tabs-title');
        isTabs.each(function(){
            let dataUrl = $(this).data('active');
            ativeTabsByUrl(dataUrl);
            // console.log("aaa");
        });
    }

    // active tab by url

    function ativeTabsByUrl(url) {
        // console.log(url);
        if(window.location.href.indexOf(url) > -1) {
            let isTabs = $('.accordion-navigation-tabs-container .accordion-navigation-tabs-title .item-tabs-title');
            let contetTabs = $('.accordion-navigation-tabs-elements .accordion-navigation-tabs-content .item-tabs-content');

            isTabs.each(function(){
                if ($(this).attr('data-active') == url) {
                    let dataTabs = $(this).data('tab');
                    $(this).addClass('active');
                    contetTabs.removeClass('active');
                    $('.accordion-navigation-tabs-elements .accordion-navigation-tabs-content .item-tabs-content.'+dataTabs).addClass('active');
                }else {
                    $(this).removeClass('active');
                }
            });

        }


    }

    $( document ).ready(function() {
        tabsElement();
        showAllContent();
        equalImageHeight();
        hiddenModulesAlertBanner();
        // let url = "active_tab=our-exec-team";
        // let ourBoard = "active_tab=our-board";
        // ativeTabsByUrl(url);
        // ativeTabsByUrl(ourBoard);
        getUrlTabs();
    });


}) (jQuery);
