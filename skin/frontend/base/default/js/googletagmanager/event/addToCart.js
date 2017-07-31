function gtmEventAddToCart(callback) {
	
	var gtmTimeout = setTimeout(callback, 2000);
	
    dataLayer.push({
        'event': 'addToCartClick',
        'eventCallback': function () {
			clearTimeout(gtmTimeout);
			callback();
		}
    });
}

document.observe("dom:loaded", function () {

    if (typeof productAddToCartForm !== 'undefined') {
        productAddToCartForm.baseSubmit = productAddToCartForm.submit;
        productAddToCartForm.submit = function (elem) {
            gtmEventAddToCart(function () {
                productAddToCartForm.baseSubmit(elem);
            });
        };
    }

});