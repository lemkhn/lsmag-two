<?php

namespace Ls\CustomerGraphQl\Observer;

use Exception;
use \Ls\Core\Model\LSR;
use \Ls\Omni\Helper\ContactHelper;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\GraphQl\Exception\GraphQlAlreadyExistsException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Psr\Log\LoggerInterface;

/**
 * We need to check if email is already exist or not
 */
class SaveBefore implements ObserverInterface
{
    /** @var ContactHelper */
    private $contactHelper;

    /** @var LoggerInterface */
    private $logger;

    /** @var LSR @var */
    private $lsr;

    /**
     * SaveBefore constructor.
     * @param ContactHelper $contactHelper
     * @param LoggerInterface $logger
     * @param LSR $LSR
     */
    public function __construct(
        ContactHelper $contactHelper,
        LoggerInterface $logger,
        LSR $LSR
    ) {
        $this->contactHelper = $contactHelper;
        $this->logger        = $logger;
        $this->lsr           = $LSR;
    }

    /**
     * @param Observer $observer
     * @return $this
     * @throws GraphQlInputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(Observer $observer)
    {
        $parameters = $observer->getEvent()->getDataObject();

        if (empty($parameters['ls_password'])) {
            return $this;
        }

        if (!empty($parameters['email'])) {
            if ($this->lsr->isLSR($this->lsr->getCurrentStoreId())) {
                if ($this->contactHelper->isEmailExistInLsCentral($parameters['email'])) {
                    throw new GraphQlAlreadyExistsException(
                        __(
                            'There is already an account with this email address.
                             If you are sure that it is your email address,
                             please proceed to login or use different email address.'
                        )
                    );
                }
            }
        } else {
            throw new GraphQlInputException(__('Your email address is invalid.'));
        }
        return $this;
    }
}
