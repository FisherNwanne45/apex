/**
 * jsBanner library v1.0
 *
 * Includes jQuery
 * http://jquery.com/
 *
 * Original Author: Patrick Welborn
 *
 * Co-author: Pedro Canterini (changes, cleanup and documentation)
 * Date: Sep 4 2012
 *
 * COPYRIGHT © 2012 BANCVUE, LTD ALL RIGHTS RESERVED
 * https://www.bancvue.com/
 */


var banner; //banner variable with global scope

/**
 * Banner setup is called from global.js
 * Don't forget to call this or you will just
 * get the static content of the first slide
 */
function setupBanner(){

	/**
	 * @constructor
	 * @type {Banner}
	 */
	banner = new Banner({
		banner: '#banner', // String identifying banner id
		bannerPreloader: '#bannerPreloader', // String identifying banner preloader id
		bannerNavigation: '#bannerNavigation .button', // String identifying banner navigation buttons
		bannerPlayback: '#bannerPlayback .button', // String identifying banner playback buttons
		bannerSlides: '#bannerSlides .slide', // String identifying banner slides
		lazyLoadNextSlide: true, //if set to true will preload the images for the next slide once it is done with the current
		duration: 8000, // Integer defining duration of slide playback in milliseconds
		autoPlay: true, // Boolean indicating whether slide show should auto play
		shuffle: true, // Shuffle slides and nav
		navEvents: false // Runs buttonMouseOver and buttonMouseDown (on the bannerNavigation buttons) on slidechange automatically
	});

	banner.initialize(); //INIT
}

/**
 * BannerSlides controls all events related to slides and navigation
 */
function BannerSlides(){

	var slides = $j('#bannerSlides .slide');
	var bannerNavigation = $j('#bannerNavigation');
	var browser = $j.browser;
	var isIE8 = (browser.msie && browser.version <= "8.0");

	/**
	 * Initializes the banner
	 * Executes before the image preloader starts
	 */
	this.initialize = function(){
		bannerNavigation.removeClass('hide'); // show nav
		slides.fadeOut();
		slides.addClass('hide'); // hides content while assets are loading
	};

	/**
	 * imagesReady is called when all images for a certain slide
	 * are done loadind. There is no need to append them
	 * since background-image is set to the html target
	 */
	this.imagesReady = function(images){
		// If you need to target this slide use:
		// console.log($j('#bannerSlides .slide').eq(images.slideID));
		$j('.slideContent').show(); // brings content back after assets are loaded.

	};

	/**
	 * Triggered when the user rolls over a navigation button
	 * @param {Array} data Use data.buttonContainer to target the container
	 * and data.buttonIndex to target the button index
	 */
	this.mouseOver = function(data){
		//console.log($j(data.buttonContainer).eq(data.buttonIndex));
	};

	/**
	 * Triggered when the user rolls out of a navigation button
	 * @param {Array} data Use data.buttonContainer to target the container
	 * and data.buttonIndex to target the button index
	 */
	this.mouseOut = function(data){
		//console.log($j(data.buttonContainer).eq(data.buttonIndex));
	};

	/**
	 * Triggered when the user clicks a navigation button
	 * @param {Array} data Use data.buttonContainer to target the container
	 * and data.buttonIndex to target the button index
	 */
	this.mouseDown = function(data){
		//console.log($j(data.buttonContainer).eq(data.buttonIndex));
		//console.log('mouseDown'+data.buttonIndex);
	};

	/**
	 * Triggered when a new slide is set and runs before slideExit
	 * @param {int} index current slide index
	 */
	this.slideEnter = function(index){
		slides.eq(index).delay(600).removeClass('hide')
		slides.eq(index).fadeIn(); // Show current slide
		
	};

	/**
	 * Triggered when a new slide is set and runs after slideEnter
	 * @param {int} index current slide index
	 */
	this.slideExit = function(index){
		slides.eq(index).fadeOut();
		slides.eq(index).addClass('hide'); // hides the other slides
	};
}