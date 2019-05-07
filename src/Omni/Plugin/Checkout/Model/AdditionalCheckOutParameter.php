<?php

namespace Ls_Omni\Plugin\Checkout\Model;

use \Ls\Omni\Helper\GiftCardHelper;

/**
 * Class AdditionalCheckOutParameter
 * @package Ls_Omni\Plugin\Checkout\Model
 */
class AdditionalCheckOutParameter implements \Magento\Checkout\Model\ConfigProviderInterface
{

    /** @var \Ls\Omni\Helper\GiftCardHelper; */
    public $giftCardHelper;

    /**
     * AdditionalCheckOutParameter constructor.
     * @param GiftCardHelper $giftCardHelper
     */
    public function __construct(
        GiftCardHelper $giftCardHelper
    ) {
        $this->giftCardHelpet = $giftCardHelper;
    }

    /**
     * @return array|mixed
     */
    public function getConfig()
    {
        $output['gift_card_enable'] = $this->giftCardHelper->isGiftCardEnableOnCheckOut();
        return $output;
    }
}