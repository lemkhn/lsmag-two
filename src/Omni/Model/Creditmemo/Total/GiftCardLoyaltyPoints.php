<?php

namespace Ls\Omni\Model\Creditmemo\Total;

use \Ls\Omni\Helper\LoyaltyHelper;
use Magento\Sales\Model\Order\Creditmemo;
use Magento\Sales\Model\Order\Creditmemo\Total\AbstractTotal;

/**
 * Class GiftCardLoyaltyPoints
 * @package Ls\Omni\Model
 */
class GiftCardLoyaltyPoints extends AbstractTotal
{

    /**
     * @var LoyaltyHelper
     */
    public $loyaltyHelper;

    /**
     * GiftCardLoyaltyPoints constructor.
     * @param LoyaltyHelper $loyaltyHelper
     * @param array $data
     */
    public function __construct(
        LoyaltyHelper $loyaltyHelper,
        array $data = []
    ) {
        $this->loyaltyHelper = $loyaltyHelper;
        parent::__construct(
            $data
        );
    }

    /**
     * @param Creditmemo $creditmemo
     * @return $this|AbstractTotal
     */
    public function collect(Creditmemo $creditmemo)
    {
        $creditmemo->setLsPointsSpent(0);
        $creditmemo->setLsGiftCardAmountUsed(0);
        $creditmemo->setLsGiftCardNo(null);
		$creditmemo->setLsVoucherAmountUsed(0);
        $creditmemo->setLsVoucherNo(null);

        $pointsSpent = $creditmemo->getOrder()->getLsPointsSpent();
        $creditmemo->setLsPointsSpent($pointsSpent);

        $pointsEarn = $creditmemo->getOrder()->getLsPointsEarn();
        $creditmemo->setLsPointsEarn($pointsEarn);

        $giftCardAmount = $creditmemo->getOrder()->getLsGiftCardAmountUsed();
        $creditmemo->setLsGiftCardAmountUsed($giftCardAmount);

        $giftCardNo = $creditmemo->getOrder()->getLsGiftCardNo();
        $creditmemo->setLsGiftCardNo($giftCardNo);
		
		$voucherAmount = $creditmemo->getOrder()->getLsVoucherAmountUsed();
        $creditmemo->setLsVoucherAmountUsed($voucherAmount);

        $voucherNo = $creditmemo->getOrder()->getLsVoucherNo();
        $creditmemo->setLsVoucherNo($voucherNo);

        $pointsSpent          *= $this->loyaltyHelper->getPointRate();
        $grandTotalAmount     = $creditmemo->getOrder()->getGrandTotal()
            - $creditmemo->getOrder()->getShippingAmount() - $creditmemo->getOrder()->getTaxAmount();
        $baseGrandTotalAmount = $creditmemo->getOrder()->getBaseGrandTotal()
            - $creditmemo->getOrder()->getShippingAmount() - $creditmemo->getOrder()->getTaxAmount();
        $creditmemo->setGrandTotal($grandTotalAmount);
        $creditmemo->setBaseGrandTotal($baseGrandTotalAmount);

        return $this;
    }
}
