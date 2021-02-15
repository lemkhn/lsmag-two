define([
    'ko',
    'jquery',
    'mage/storage',
    'mage/translate'
], function (ko, $, storage, $t) {
    'use strict';

    return function (voucherData, voucherBalance, voucherExpiryDate, errorMessages) {
        var url = 'omni/ajax/CheckVoucherBalance';
        voucherBalance();
        voucherExpiryDate();
        errorMessages();
        var body = $('body').loader();
        body.loader('show');
        return storage.post(
            url,
            JSON.stringify(voucherData),
            false,
            'application/json'
        ).done(function (response) {
            if (response.success) {
                var data = JSON.parse(response.data);
                voucherBalance(data.voucherbalance);
                voucherExpiryDate(data.expirydate);
                errorMessages(null);
                body.loader('hide');
            } else {
                voucherBalance(null);
                voucherExpiryDate(null);
                errorMessages(response.message);
                body.loader('hide');
            }
        }).fail(function (response) {
            body.loader('hide');
        });
    };
});