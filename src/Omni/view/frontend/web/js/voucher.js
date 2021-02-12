define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('lsomni.giftCard', {
        options: {},

        _create: function () {
            this.giftCard = $(this.options.GiftcardSelector);
            this.removeGiftCard = $(this.options.removeGiftCardSelector);

            $(this.options.applyVoucherButton).on('click', $.proxy(function () {
                this.giftCard.attr('data-validate', '{required:true}');
                this.giftCard.attr('value', '0');
                $(this.element).validation().submit();
            }, this));

            $(this.options.cancelVoucherButton).on('click', $.proxy(function () {
                this.giftCard.removeAttr('data-validate');
                this.giftCard.attr('value', '1');
                this.element.submit();
            }, this));
        }
    });

    return $.lsomni.giftCard;
});
