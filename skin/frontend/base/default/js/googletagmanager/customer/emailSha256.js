document.observe("dom:loaded", function () {
    if (customerEmailSha256 = Mage.Cookies.get('dataLayerCustomerEmailSha256')) {
        dataLayer.push({
            'customerEmailSha256': customerEmailSha256
        });
    }
});