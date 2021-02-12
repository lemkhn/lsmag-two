define([
    'jquery',
    'ko',
    'uiComponent',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/totals',
    'Ls_Omni/js/action/set-gift-card',
    'Ls_Omni/js/action/cancel-gift-card',
    'mage/translate',
], function ($, ko, Component, quote, totals, setVoucherAction, cancelVoucherAction, $t) {
    'use strict';

    var voucherAmount = ko.observable(null),
        isVoucherApplied;

    var voucherNo = ko.observable(null),
        isVoucherApplied;


    if (totals) {
        var vouchAmount = totals.getSegment('ls_gift_card_amount_used');
        if (vouchAmount) {
            voucherAmount(vouchAmount.value);
        }
    }
    if (totals) {
        var vouchNo = totals.getSegment('ls_gift_card_no');
        if (vouchNo) {
            voucherNo(vouchNo.value);
        }
    }
    isVoucherApplied = ko.observable(voucherNo() != null && voucherAmount() != null);

    return Component.extend({
        defaults: {
            template: 'Ls_Omni/payment/giftcard'
        },

        voucherNo: voucherNo,
        voucherAmount: voucherAmount,

        /**
         * Applied flag
         */
        isVoucherApplied: isVoucherApplied,

        /**
         * Voucher apply procedure
         */
        applyVoucher: function () {
            if (this.validateVoucher()) {
                setVoucherAction(voucherNo(), voucherAmount(), isVoucherApplied);
            }
        },

        /**
         * Cancel Voucher
         */
        cancelVoucher: function () {
            if (this.validateVoucher()) {
                voucherNo('');
                voucherAmount('');
                cancelVoucherAction(isVoucherApplied);
            }
        },

        /**
         * Voucher form validation
         *
         * @returns {Boolean}
         */
        validateVoucher: function () {
            var form = '#gift-card';

            return $(form).validation() && $(form).validation('isValid');
        }
    });
});
