<?php

namespace Ls\Omni\Model\Total\Quote;

use Magento\Quote\Model\Quote;
use Magento\Quote\Model\Quote\Address\Total;
use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;

/**
 * Class PointsSpent
 * @package Ls\Omni\Model\Total\Quote
 */
class VoucherNo extends AbstractTotal
{
    /**
     * @param Quote $quote
     * @param Total $total
     * @return array
     */
    public function fetch(Quote $quote, Total $total)
    {
        $totals         = [];
        $voucherNumber = $quote->getLsVoucherNo();
        if (!empty($voucherNumber)) {
            $totals[] = [
                'code'  => $this->getCode(),
                'title' => __('Voucher No'),
                'value' => $voucherNumber,
            ];
        }
        return $totals;
    }
}
