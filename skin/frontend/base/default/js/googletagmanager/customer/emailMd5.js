document.observe("dom:loaded", function () {
    if (customerEmailMd5 = Mage.Cookies.get('dataLayerCustomerEmailMd5')) {
        dataLayer.push({
            'customerEmailMd5': customerEmailMd5
        });
    }
});
