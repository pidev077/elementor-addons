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
            // isTabs.show(200,'linear');
            // $('.accordion-navigation-tabs-elements .accordion-navigation-tabs-content .item-tabs-content.'+dataTabs).hide(200,'linear');
            isTabs.removeClass('active');
            $('.accordion-navigation-tabs-elements .accordion-navigation-tabs-content .item-tabs-content.'+dataTabs).addClass('active');
        });

    }

    // funtion show all content in elements accordion navigation tabs
    function showAllContent() {
        let isCTA = $('.accordion-navigation-tabs-content .item-team .show-more');
        let isContent = $('.accordion-navigation-tabs-content .item-team .meta-team .description');
        isCTA.on('click',function(){
            $(this).siblings().children().find('.description').addClass('active');
            console.log("aac");
        });
    }

    $( document ).ready(function() {
        tabsElement();
        showAllContent();
    });


}) (jQuery);
