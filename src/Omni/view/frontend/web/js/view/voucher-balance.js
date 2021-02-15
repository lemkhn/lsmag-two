define([
    'jquery',
    'ko',
    'uiComponent',
    'Ls_Omni/js/action/get-voucher-balance',
    'mage/translate',
], function ($, ko, Component, getVoucherBalanceAction, $t) {
    'use strict';
    var voucherBalance = ko.observable(null);
    var voucherExpiryDate = ko.observable(null);
    var errorMessages = ko.observable(null);
    return Component.extend({
        defaults: {
            template: 'Ls_Omni/voucher-balance'
        },

        checkvoucherBalance: function (form) {
            var voucherData = {},
                formDataArray = $(form).serializeArray();
            formDataArray.forEach(function (entry) {
                voucherData[entry.name] = entry.value;
            });
            if ($(form).validation()
                && $(form).validation('isValid')
            ) {
                getvoucherBalanceAction(voucherData, voucherBalance, voucherExpiryDate, errorMessages).always(function () {
                });
            }
        },
        getvoucherBalance: function () {
            return voucherBalance;
        },
        getvoucherExpiryDate: function () {
            return voucherExpiryDate;
        },
        getErrorMessages: function () {
            return errorMessages;
        },
        cancelvoucherBalance: function () {
            $('#voucher_code').val('');
            voucherBalance(null);
            voucherExpiryDate(null);
            errorMessages(null);
        }
    });
});