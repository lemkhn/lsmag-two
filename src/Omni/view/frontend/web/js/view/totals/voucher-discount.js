define([
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/totals'
    ], function (Component, totals) {
        "use strict";
        return Component.extend({
            defaults: {
                template: 'Ls_Omni/totals/voucher-discount'
            },

            /**
             * Get Voucher discount total
             * @returns {*}
             */
            getTotal: function () {
                return totals.getSegment('ls_voucher_amount_used');
            },

            /**
             * Get loyalty points discount formatted
             * @returns {*|String}
             */
            getValue: function () {
                return '-' + this.getFormattedPrice(this.getTotal().value);
            }
        });
    }
);
