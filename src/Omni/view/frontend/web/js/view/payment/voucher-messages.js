define([
    'Magento_Ui/js/view/messages',
    '../../model/payment/voucher-messages'
], function (Component, messageContainer) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Ls_Omni/voucher-messages',
            selector: '[data-role=voucher-messages]'
        },

        /** @inheritdoc */
        initialize: function (config) {
            return this._super(config, messageContainer);
        }
    });
});
