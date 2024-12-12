var ids = {};
var loadDna = function ( id ) {
	return ids[id];
}

// firstbase is using an old version of mootools:
// http://docs111.mootools.net/
var dnaRoibox = new Roibox();
var flashPopup = function(url, color, width, height) {
	dnaRoibox.init( false, {'popupSrc': url, 'finalWidth': parseInt(width), 'finalHeight': parseInt(height)});
}