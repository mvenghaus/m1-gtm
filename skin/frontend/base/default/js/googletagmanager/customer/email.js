document.observe("dom:loaded", function () {
    if (customerEmail = Mage.Cookies.get('dataLayerCustomerEmail')) {
        dataLayer.push({
            'customerEmail': customerEmail
        });
    }
});