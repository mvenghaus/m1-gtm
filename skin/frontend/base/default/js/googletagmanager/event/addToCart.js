function gtmEventAddToCart(callback) {
    dataLayer.push({
        'event': 'addToCartClick',
        'eventCallback': callback
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