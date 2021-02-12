define(
    [
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/totals'
    ], function (Component, totals) {
        "use strict";

        return Component.extend({
            defaults: {
                template: 'Ls_Omni/totals/voucher-label'
            },

            /**
             * Get Voucher Segment
             * @returns {*}
             */
            getVoucherAmountUsed: function () {
                return totals.getSegment('ls_voucher_amount_used') || 0;
            },

            /**
             * Get Voucher Amount applied
             * @returns {*}
             */
            getVoucherAmountUsedValue: function () {
                var giftCardAmount = this.getVoucherAmountUsed().value;

                return giftCardAmount;
            }
        });
    }
);
