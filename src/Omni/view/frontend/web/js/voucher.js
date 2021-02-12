define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('lsomni.voucher', {
        options: {},

        _create: function () {
            this.voucher = $(this.options.VoucherSelector);
            this.removeVoucher = $(this.options.removeVoucherSelector);

            $(this.options.applyVoucherButton).on('click', $.proxy(function () {
                this.voucher.attr('data-validate', '{required:true}');
                this.voucher.attr('value', '0');
                $(this.element).validation().submit();
            }, this));

            $(this.options.cancelVoucherButton).on('click', $.proxy(function () {
                this.voucher.removeAttr('data-validate');
                this.voucher.attr('value', '1');
                this.element.submit();
            }, this));
        }
    });

    return $.lsomni.voucher;
});
