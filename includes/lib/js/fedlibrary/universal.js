(function(){

	window.onload = function() {

		// make sure we're not on bancvue.com
		if(location.href.indexOf('bancvue.com') == -1) {
			// get all anchor tags
			var aTags = document.querySelectorAll('a[href$="www.bancvue.com/"], a[href$="www.bancvue.com"]');

			// replace all links ending in either bancvue.com or bancvue.com/
			for(var i = 0; i < aTags.length; i++) {
				// This is linking to a vanity url (301 redirect), which can be changed in FirstBase
				aTags[i].href = aTags[i].href.replace(/bancvue.com\/?$/, 'thisisfirstbranch.com'); 
			}
		}

		
	};	

}());