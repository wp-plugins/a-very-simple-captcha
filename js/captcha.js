jQuery(window).load(function () {
    jQuery("#bcolorr").keyup(removeextra).blur(removeextra);
	jQuery("#fcolorr").keyup(removeextra).blur(removeextra);
});
function removeextra() {
    var initVal = jQuery(this).val();
    outputVal = initVal.replace(/[^0-9a-zA-Z]/g,"");       
    if (initVal != outputVal) {
        jQuery(this).val(outputVal);
    }
};