document.observe("dom:loaded", function () {
    if (customerEmailSha1 = Mage.Cookies.get('dataLayerCustomerEmailSha1')) {
        dataLayer.push({
            'customerEmailSha1': customerEmailSha1
        });
    }
});