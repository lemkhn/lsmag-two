<?php

namespace Ls\Omni\Helper;

use Exception;
use \Ls\Core\Model\LSR;
use \Ls\Omni\Client\Ecommerce\Entity;
use \Ls\Omni\Client\Ecommerce\Entity\ArrayOfOrderLine;
use \Ls\Omni\Client\Ecommerce\Entity\Order;
use \Ls\Omni\Client\Ecommerce\Entity\OrderLine;
use \Ls\Omni\Client\Ecommerce\Operation;
use \Ls\Omni\Client\ResponseInterface;
use \Ls\Omni\Exception\InvalidEnumException;
use Magento\Catalog\Model\Product\Interceptor;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ProductRepository;
use Magento\Checkout\Model\Cart;
use Magento\Checkout\Model\Session\Proxy as CheckoutProxy;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\Session\Proxy as CustomerProxy;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\Quote\Item;

/**
 * Useful helper functions for basket
 *
 */
class BasketHelper extends AbstractHelper
{
    /** @var Cart $cart */
    public $cart;

    /** @var ProductRepository $productRepository */
    public $productRepository;

    /**
     * @var CheckoutProxy
     */
    public $checkoutSession;

    /**
     * @var CustomerProxy
     */
    public $customerSession;

    /** @var SearchCriteriaBuilder $searchCriteriaBuilder */
    public $searchCriteriaBuilder;

    /** @var
     * Type\Configurable $catalogProductTypeConfigurable
     */
    public $catalogProductTypeConfigurable;

    /** @var ProductFactory $productFactory */
    public $productFactory;

    /** @var ItemHelper $itemHelper */
    public $itemHelper;

    /** @var Registry $registry */
    public $registry;

    /** @var null|string */
    public $store_id = null;

    /** @var  LSR $lsr */
    public $lsr;

    /** @var array */
    public $basketDataResponse;

    /**
     * @var SessionManagerInterface
     */
    public $session;

    /**
     * @var $quoteRepository
     */
    public $quoteRepository;

    /**
     * @var $couponCode
     */
    public $couponCode;

    /**
     * @var $data
     */
    public $data;

    /**
     * @var \Magento\Quote\Model\ResourceModel\Quote
     */
    public $quoteResourceModel;

    /** @var CustomerFactory */
    public $customerFactory;

    /**
     * BasketHelper constructor.
     * @param Context $context
     * @param Cart $cart
     * @param ProductRepository $productRepository
     * @param CheckoutProxy $checkoutSession
     * @param CustomerProxy $customerSession
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable $catalogProductTypeConfigurable
     * @param ProductFactory $productFactory
     * @param ItemHelper $itemHelper
     * @param Registry $registry
     * @param LSR $Lsr
     * @param Data $data
     * @param SessionManagerInterface $session
     * @param CartRepositoryInterface $quoteRepository
     * @param \Magento\Quote\Model\ResourceModel\Quote $quoteResourceModel
     * @param CustomerFactory $customerFactory
     */
    public function __construct(
        Context $context,
        Cart $cart,
        ProductRepository $productRepository,
        CheckoutProxy $checkoutSession,
        CustomerProxy $customerSession,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable $catalogProductTypeConfigurable,
        ProductFactory $productFactory,
        ItemHelper $itemHelper,
        Registry $registry,
        LSR $Lsr,
        Data $data,
        SessionManagerInterface $session,
        CartRepositoryInterface $quoteRepository,
        \Magento\Quote\Model\ResourceModel\Quote $quoteResourceModel,
        CustomerFactory $customerFactory
    ) {
        parent::__construct($context);
        $this->cart                           = $cart;
        $this->productRepository              = $productRepository;
        $this->checkoutSession                = $checkoutSession;
        $this->customerSession                = $customerSession;
        $this->searchCriteriaBuilder          = $searchCriteriaBuilder;
        $this->catalogProductTypeConfigurable = $catalogProductTypeConfigurable;
        $this->productFactory                 = $productFactory;
        $this->itemHelper                     = $itemHelper;
        $this->registry                       = $registry;
        $this->lsr                            = $Lsr;
        $this->data                           = $data;
        $this->session                        = $session;
        $this->quoteRepository                = $quoteRepository;
        $this->quoteResourceModel             = $quoteResourceModel;
        $this->customerFactory                = $customerFactory;
    }

    /**
     * Compared a OneList with a quote and returns an array which contains
     * the items present only in the quote and only in the OneList (basket)
     * @param Entity\OneList $oneList
     * @param Quote $quote
     * @return array
     */
    public function compare(Entity\OneList $oneList, Quote $quote)
    {
        /** @var Entity\OneListItem[] $onlyInOneList */
        /** @var Entity\OneListItem[] $onlyInQuote */
        $onlyInOneList = [];
        $onlyInQuote   = [];

        /** @var Item[] $quoteItems */
        $cache      = [];
        $quoteItems = $quote->getAllVisibleItems();

        /** @var Entity\OneListItem[] $oneListItems */
        $oneListItems = !($oneList->getItems()->getOneListItem() == null)
            ? $oneList->getItems()->getOneListItem()
            : [];

        foreach ($oneListItems as $oneListItem) {
            $found = false;

            foreach ($quoteItems as $quoteItem) {
                $isConfigurable = $quoteItem->getProductType()
                    == Configurable::TYPE_CODE;
                if (isset($cache[$quoteItem->getId()]) || $isConfigurable) {
                    continue;
                }
                // @codingStandardsIgnoreStart
                $productLsrId = $this->productFactory->create()
                    ->load($quoteItem->getProduct()->getId())
                    ->getData('lsr_id');
                // @codingStandardsIgnoreEnd
                $quote_has_item = $productLsrId == $oneListItem->getItem()->getId();
                $qi_qty         = $quoteItem->getData('qty');
                $item_qty       = (int)($oneListItem->getQuantity());
                $match          = $quote_has_item && ($qi_qty == $item_qty);

                if ($match) {
                    $cache[$quoteItem->getId()] = $found = true;
                    break;
                }
            }

            // if found is still false, the item is not presend in the quote
            if (!$found) {
                $onlyInOneList[] = $oneListItem;
            }
        }

        foreach ($quoteItems as $quoteItem) {
            $isConfigurable = $quoteItem->getProductType()
                == Configurable::TYPE_CODE;

            // if the item is in the cache, it is present in the oneList and the quote
            if (isset($cache[$quoteItem->getId()]) || $isConfigurable) {
                continue;
            }
            $onlyInQuote[] = $quoteItem;
        }

        return [$onlyInQuote, $onlyInOneList];
    }

    /**
     * This function is overriding in hospitality module
     * @param Quote $quote
     * @param Entity\OneList $oneList
     * @return Entity\OneList
     */
    public function setOneListQuote(Quote $quote, Entity\OneList $oneList)
    {
        $quoteItems = $quote->getAllVisibleItems();
        if (count($quoteItems) == 0) {
            $this->unSetCouponCode();
        }

        // @codingStandardsIgnoreLine
        $items = new Entity\ArrayOfOneListItem();

        $itemsArray = [];

        foreach ($quoteItems as $quoteItem) {
            // initialize the default null value
            $variant = $barcode = null;

            $sku = $quoteItem->getSku();

            $searchCriteria = $this->searchCriteriaBuilder->addFilter('sku', $sku, 'eq')->create();

            $productList = $this->productRepository->getList($searchCriteria)->getItems();

            /** @var Interceptor $product */
            $product = array_pop($productList);

            $barcode = $product->getData('barcode');

            $uom   = $product->getData('uom');
            $parts = explode('-', $sku);
            // first element is lsr_id
            $lsr_id = array_shift($parts);
            // second element, if it exists, is variant id
            $variant_id = count($parts) ? array_shift($parts) : null;
            if (!is_numeric($variant_id)) {
                $variant_id = null;
            }
            // @codingStandardsIgnoreLine
            $list_item = (new Entity\OneListItem())
                ->setQuantity($quoteItem->getData('qty'))
                ->setItemId($lsr_id)
                ->setId('')
                ->setBarcodeId($barcode)
                ->setVariantId($variant_id)
                ->setUnitOfMeasureId($uom);

            $itemsArray[] = $list_item;
        }
        $items->setOneListItem($itemsArray);

        $oneList->setItems($items)
            ->setPublishedOffers($this->_offers());

        return $oneList;
    }

    /**
     * @return Entity\ArrayOfOneListPublishedOffer
     */
    public function _offers()
    {
        // @codingStandardsIgnoreLine
        return new Entity\ArrayOfOneListPublishedOffer();
    }

    /**
     * @param Entity\OneList $oneList
     * @param $wishlistItems
     * @return Entity\OneList
     */
    public function addProductToExistingWishlist(Entity\OneList $oneList, $wishlistItems)
    {
        // @codingStandardsIgnoreLine
        $items      = new Entity\ArrayOfOneListItem();
        $itemsArray = [];
        foreach ($wishlistItems as $item) {
            if ($item->getOptionByCode('simple_product')) {
                $product = $item->getOptionByCode('simple_product')->getProduct();
            } else {
                $product = $item->getProduct();
            }
            $sku            = $product->getSku();
            $searchCriteria = $this->searchCriteriaBuilder->addFilter('sku', $sku, 'eq')->create();

            $productList = $this->productRepository->getList($searchCriteria)->getItems();

            /** @var Interceptor $product */
            $product = array_pop($productList);
            $qty     = $item->getData('qty');
            // initialize the default null value
            $barcode = $product->getData('barcode');

            $sku = $product->getSku();

            $uom   = $product->getData('uom');
            $parts = explode('-', $sku);
            // first element is lsr_id
            $lsr_id = array_shift($parts);
            // second element, if it exists, is variant id
            $variant_id = count($parts) ? array_shift($parts) : null;
            // @codingStandardsIgnoreLine
            $list_item = (new Entity\OneListItem())
                ->setQuantity($qty)
                ->setItemId($lsr_id)
                ->setId('')
                ->setBarcodeId($barcode)
                ->setVariantId($variant_id)
                ->setUnitOfMeasureId($uom);

            $itemsArray[] = $list_item;
        }
        $items->setOneListItem($itemsArray);
        $oneList->setItems($items);
        return $oneList;
    }

    /**
     * @param Entity\OneList $oneList
     * @return bool
     */
    public function delete(Entity\OneList $oneList)
    {
        // @codingStandardsIgnoreLine
        $entity = new Entity\OneListDeleteById();

        $entity->setOneListId($oneList->getId());
        // @codingStandardsIgnoreLine
        $request = new Operation\OneListDeleteById();

        /** @var  Entity\OneListDeleteByIdResponse $response */
        $response = $request->execute($entity);

        return $response ? $response->getOneListDeleteByIdResult() : false;
    }

    /**
     * @param Entity\OneList $oneList
     * @return bool|Entity\OneList
     * @throws NoSuchEntityException
     */
    // @codingStandardsIgnoreLine

    public function updateWishlistAtOmni(Entity\OneList $oneList)
    {
        return $this->saveWishlistToOmni($oneList);
    }

    /**
     * @param Entity\OneList $list
     * @return bool|Entity\OneList
     * @throws NoSuchEntityException
     */
    public function saveWishlistToOmni(Entity\OneList $list)
    {
        // @codingStandardsIgnoreLine
        $operation = new Operation\OneListSave();

        $list->setStoreId($this->getDefaultWebStore());

        // @codingStandardsIgnoreLine
        $request = (new Entity\OneListSave())
            ->setOneList($list)
            ->setCalculate(true);

        /** @var Entity\OneListSaveResponse $response */
        $response = $operation->execute($request);
        if ($response) {
            $this->setWishListInCustomerSession($response->getOneListSaveResult());
            return $response->getOneListSaveResult();
        }
        return false;
    }

    /**
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getDefaultWebStore()
    {
        if ($this->store_id == null) {
            $this->store_id = $this->lsr->getActiveWebStore();
        }

        return $this->store_id;
    }

    /**
     * @param Entity\OneList $oneList
     * @return bool|Entity\OrderAvailabilityResponse|Entity\OrderCheckAvailabilityResponse|ResponseInterface
     * @throws NoSuchEntityException
     */
    public function availability(Entity\OneList $oneList)
    {
        $oneListItems = $oneList->getItems();
        $response     = false;

        if (!($oneListItems->getOneListItem() == null)) {
            $array = [];

            $count = 1;

            foreach ($oneListItems->getOneListItem() as $listItem) {
                $variant = $listItem->getVariant();
                $uom     = !($listItem->getUom() == null) ? $listItem->getUom()[0]->getId() : null;
                // @codingStandardsIgnoreLine
                $line    = (new Entity\OrderLineAvailability())
                    ->setItemId($listItem->getItem()->getId())
                    ->setLineType(Entity\Enum\LineType::ITEM)
                    ->setUomId($uom)
                    ->setLineNumber($count++)
                    ->setQuantity($listItem->getQuantity())
                    ->setVariantId(($variant == null) ? null : $variant->getId());
                $array[] = $line;
                unset($line);
            }
            // @codingStandardsIgnoreStart
            $lines = new Entity\ArrayOfOrderLineAvailability();
            $lines->setOrderLineAvailability($array);

            $cardId = $this->customerSession->getData(LSR::SESSION_CUSTOMER_CARDID);

            $request = (new Entity\OrderAvailabilityRequest())
                ->setStoreId($this->getDefaultWebStore())
                ->setCardId($cardId)
                ->setSourceType(Entity\Enum\SourceType::STANDARD)
                ->setItemNumberType(Entity\Enum\ItemNumberType::ITEM_NO)
                ->setOrderLineAvailabilityRequests($lines);
            $entity  = new Entity\OrderCheckAvailability();
            $entity->setRequest($request);
            $operation = new Operation\OrderCheckAvailability();
            // @codingStandardsIgnoreEnd
            $response = $operation->execute($entity);
        }

        return $response ? $response->getOrderCheckAvailabilityResult() : $response;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getCouponCode()
    {
        $quoteCoupon = $this->cart->getQuote()->getCouponCode();
        if (!($quoteCoupon == null)) {
            $this->couponCode = $quoteCoupon;
            $this->setCouponQuote($quoteCoupon);
            return $quoteCoupon;
        } else {
            return $this->couponCode;
        }
    }

    /**
     * This function is overriding in hospitality module
     * @param $couponCode
     * @return Entity\OneListCalculateResponse|Phrase|string|null
     * @throws InvalidEnumException
     * @throws NoSuchEntityException
     * @throws LocalizedException
     * @throws Exception
     */
    public function setCouponCode($couponCode)
    {
        $status     = "";
        $couponCode = trim($couponCode);
        if ($couponCode == "") {
            $this->couponCode = '';
            $this->setCouponQuote("");
            $this->update(
                $this->get()
            );
            $this->itemHelper->setDiscountedPricesForItems(
                $this->checkoutSession->getQuote(),
                $this->getBasketSessionValue()
            );

            return $status = '';
        }
        $this->couponCode = $couponCode;
        $status           = $this->update(
            $this->get()
        );

        $checkCouponAmount = $this->data->orderBalanceCheck(
            $this->checkoutSession->getQuote()->getLsGiftCardNo(),
            $this->checkoutSession->getQuote()->getLsGiftCardAmountUsed(),
            $this->checkoutSession->getQuote()->getLsPointsSpent(),
            $status
        );

        if (!is_object($status) && $checkCouponAmount) {
            $this->couponCode = '';
            $this->update(
                $this->get()
            );
            $this->setCouponQuote($this->couponCode);

            return $status;
        } elseif (!empty($status->getOrderDiscountLines()->getOrderDiscountLine())) {
            if (is_array($status->getOrderDiscountLines()->getOrderDiscountLine())) {
                foreach ($status->getOrderDiscountLines()->getOrderDiscountLine() as $orderDiscountLine) {
                    if ($orderDiscountLine->getDiscountType() == 'Coupon') {
                        $status = "success";
                        $this->itemHelper->setDiscountedPricesForItems(
                            $this->checkoutSession->getQuote(),
                            $this->getBasketSessionValue()
                        );
                        $this->setCouponQuote($this->couponCode);
                    }
                }
            } else {
                if ($status->getOrderDiscountLines()->getOrderDiscountLine()->getDiscountType() == 'Coupon') {
                    $status = "success";
                    $this->itemHelper->setDiscountedPricesForItems(
                        $this->checkoutSession->getQuote(),
                        $this->getBasketSessionValue()
                    );
                    $this->setCouponQuote($this->couponCode);
                }
            }
            if (is_object($status)) {
                $status = __("Coupon Code is not valid for these item(s)");
            }

            return $status;
        } else {
            $this->setCouponQuote("");
            return __("Coupon Code is not valid for these item(s)");
        }
    }

    /**
     * @param $couponCode
     * @throws Exception
     */
    public function setCouponQuote($couponCode)
    {
        $cartQuote = $this->cart->getQuote();
        if (!empty($cartQuote->getId())) {
            $cartQuote->getShippingAddress()->setCollectShippingRates(true);
            $cartQuote->setCouponCode($couponCode);
            $cartQuote->collectTotals();
        }
        $this->quoteResourceModel->save($cartQuote);
        $this->setCouponCodeInCheckoutSession($couponCode);
    }

    /**
     * This function is overriding in hospitality module
     * @param Entity\OneList $oneList
     * @return Entity\OneListCalculateResponse|Order
     * @throws InvalidEnumException
     * @throws NoSuchEntityException
     */
    public function update(Entity\OneList $oneList)
    {
        $this->saveToOmni($oneList);
        return $this->calculate($oneList);
    }

    // @codingStandardsIgnoreLine

    /**
     * @param Entity\OneList $list
     * @return bool|Entity\OneList
     * @throws NoSuchEntityException
     */
    public function saveToOmni(Entity\OneList $list)
    {
        // @codingStandardsIgnoreLine
        $operation = new Operation\OneListSave();
        $list->setStoreId($this->getDefaultWebStore());
        // @codingStandardsIgnoreLine
        $request = (new Entity\OneListSave())
            ->setOneList($list)
            ->setCalculate(true);
        /** @var Entity\OneListSaveResponse $response */
        $response = $operation->execute($request);
        if ($response) {
            $this->setOneListInCustomerSession($response->getOneListSaveResult());
            return $response->getOneListSaveResult();
        }
        return false;
    }

    /**
     * This function is overriding in hospitality module
     * @param Entity\OneList $oneList
     * @return Entity\OneListCalculateResponse|Entity\Order
     * @throws InvalidEnumException|NoSuchEntityException
     * @throws Exception
     */
    public function calculate(Entity\OneList $oneList)
    {
        // @codingStandardsIgnoreLine
        $storeId = $this->getDefaultWebStore();
        $cardId  = $oneList->getCardId();

        /** @var Entity\ArrayOfOneListItem $oneListItems */
        $oneListItems = $oneList->getItems();

        /** @var Entity\OneListCalculateResponse $response */
        $response = false;

        if (!($oneListItems->getOneListItem() == null)) {
            /** @var Entity\OneListItem || Entity\OneListItem[] $listItems */
            $listItems = $oneListItems->getOneListItem();

            if (!is_array($listItems)) {
                /** Entity\ArrayOfOneListItem $items */
                // @codingStandardsIgnoreLine
                $items = new Entity\ArrayOfOneListItem();
                $items->setOneListItem($listItems);
                $listItems = $items;
            }
            // @codingStandardsIgnoreStart
            $oneListRequest = (new Entity\OneList())
                ->setCardId($cardId)
                ->setListType(Entity\Enum\ListType::BASKET)
                ->setItems($listItems)
                ->setStoreId($storeId);

            /** @var Entity\OneListCalculate $entity */
            if ($this->getCouponCode() != "" and $this->getCouponCode() != null) {
                $offer  = new Entity\OneListPublishedOffer();
                $offers = new Entity\ArrayOfOneListPublishedOffer();
                $offers->setOneListPublishedOffer($offer);
                $offer->setId($this->getCouponCode());
                $offer->setType("Coupon");
                $oneListRequest->setPublishedOffers($offers);
            } else {
                $oneListRequest->setPublishedOffers($this->_offers());
            }

            $entity = new Entity\OneListCalculate();
            $entity->setOneList($oneListRequest);
            $request = new Operation\OneListCalculate();
            // @codingStandardsIgnoreEnd

            /** @var  Entity\OneListCalculateResponse $response */
            $response = $request->execute($entity);
        }
        if (($response == null)) {
            // @codingStandardsIgnoreLine
            $oneListCalResponse = new Entity\OneListCalculateResponse();
            return $oneListCalResponse->getResult();
        }
        if (property_exists($response, "OneListCalculateResult")) {
            // @codingStandardsIgnoreLine
            $this->setOneListCalculationInCheckoutSession($response->getResult());
            return $response->getResult();
        }
        if (is_object($response)) {
            $this->setOneListCalculationInCheckoutSession($response->getResult());
            return $response->getResult();
        } else {
            return $response;
        }
    }

    /**
     * @param $customerEmail
     * @param $websiteId
     * @return bool|Entity\OneList
     * @throws InvalidEnumException
     * @throws LocalizedException
     */
    public function getOneListAdmin($customerEmail, $websiteId)
    {
        /** @var Entity\OneList $list */
        $list     = null;
        $customer = $this->customerFactory->create()->setWebsiteId($websiteId)->loadByEmail($customerEmail);
        $cardId   = $customer->getData('lsr_cardid');
        $webStore = $this->lsr->getWebsiteConfig(LSR::SC_SERVICE_STORE, $websiteId);
        // @codingStandardsIgnoreStart
        $list = (new Entity\OneList())
            ->setCardId($cardId)
            ->setDescription('OneList Magento')
            ->setListType(Entity\Enum\ListType::BASKET)
            ->setItems(new Entity\ArrayOfOneListItem())
            ->setPublishedOffers($this->_offers())
            ->setStoreId($webStore);
        return $this->saveToOmni($list);
        // @codingStandardsIgnoreEnd
    }

    /**
     * @param null $id
     * @return array|bool|Entity\OneList|Entity\OneList[]|mixed|null
     * @throws InvalidEnumException
     * @throws NoSuchEntityException
     */
    public function get($id = null)
    {
        /** @var Entity\OneList $list */
        $list = null;

        //check if onelist is created and stored in session. if it is, than return it.
        if ($this->getOneListFromCustomerSession()) {
            return $this->getOneListFromCustomerSession();
        }

        /** @var Entity\MemberContact $loginContact */
        // For logged in users check if onelist is already stored in registry.
        if ($loginContact = $this->registry->registry(LSR::REGISTRY_LOYALTY_LOGINRESULT)) {
            try {
                if ($loginContact->getBasket() instanceof Entity\OneList) {
                    $this->setOneListInCustomerSession($loginContact->getBasket());
                    return $loginContact->getBasket();
                } else {
                    if ($loginContact->getBasket() instanceof Entity\ArrayOfOneList) {
                        foreach ($loginContact->getBasket()->getIterator() as $list) {
                            if ($list->getIsDefaultList()) {
                                $this->setOneListInCustomerSession($list);
                                return $list;
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                $this->_logger->critical($e);
            }
        }
        if ($id) {
            $entity = new Entity\OneListGetById();
            $entity->setId($id);
            $entity->setIncludeLines(true);
            $request  = new Operation\OneListGetById();
            $response = $request->execute($entity);
            return $response->getOneListGetByIdResult();
        }

        /** If no list found from customer session or registered user then get from omni */
        if ($list == null) {
            return $this->fetchFromOmni();
        }
        return null;
    }

    /**
     * @return array|bool|Entity\OneList|Entity\OneList[]|mixed
     * @throws InvalidEnumException|NoSuchEntityException
     */
    public function fetchFromOmni()
    {
        // if guest, then empty card id
        $cardId = (!($this->customerSession->getData(LSR::SESSION_CUSTOMER_CARDID) == null)
            ? $this->customerSession->getData(LSR::SESSION_CUSTOMER_CARDID) : '');

        $store_id = $this->getDefaultWebStore();

        /**
         * If its a logged in user then we need to fetch already created one list.
         */
        if ($cardId != '') {
            // @codingStandardsIgnoreLine
            $request = new Operation\OneListGetByCardId();
            // @codingStandardsIgnoreLine
            $entity = new Entity\OneListGetByCardId();
            $entity->setCardId($cardId)
                ->setListType(Entity\Enum\ListType::BASKET)
                ->setIncludeLines(true);

            /** @var Entity\OneListGetByCardIdResponse $response */
            $response = $request->execute($entity);

            $lists = $response->getOneListGetByCardIdResult()->getOneList();
            // if we have a list or an array, return it
            if (!empty($lists)) {
                if ($lists instanceof Entity\OneList) {
                    return $lists;
                } elseif (is_array($lists)) {
                    # return first list
                    return array_pop($lists);
                }
            }
        }

        /**
         * only those users who either does not have onelist created or
         * is guest user will come up here so for them lets create a new one.
         * for those lets create new list with no items and the existing offers and coupons
         */

        // @codingStandardsIgnoreStart
        $list = (new Entity\OneList())
            ->setCardId($cardId)
            ->setDescription('OneList Magento')
            ->setListType(Entity\Enum\ListType::BASKET)
            ->setItems(new Entity\ArrayOfOneListItem())
            ->setPublishedOffers($this->_offers())
            ->setStoreId($store_id);

        return $this->saveToOmni($list);
        // @codingStandardsIgnoreEnd
    }

    /**
     * @return Entity\OneList|mixed
     * @throws InvalidEnumException|NoSuchEntityException
     */
    public function fetchCurrentCustomerWishlist()
    {
        //check if onelist is created and stored in session. if it is, than return it.
        if ($this->getWishListFromCustomerSession()) {
            return $this->getWishListFromCustomerSession();
        }
        $cardId = (!($this->customerSession->getData(LSR::SESSION_CUSTOMER_CARDID) == null)
            ? $this->customerSession->getData(LSR::SESSION_CUSTOMER_CARDID) : '');

        $store_id = $this->getDefaultWebStore();
        return (new Entity\OneList())
            ->setCardId($cardId)
            ->setDescription('List ' . $cardId)
            ->setListType(Entity\Enum\ListType::WISH)
            ->setItems(new Entity\ArrayOfOneListItem())
            ->setStoreId($store_id);
    }

    /**
     * Return Item Helper which can be used on multiple areas where we have dependency injection issue.
     */
    public function getItemHelper()
    {
        return $this->itemHelper;
    }


    /**
     * This function is overriding in hospitality module
     * @param $item
     * @return string
     * @throws InvalidEnumException
     * @throws NoSuchEntityException
     */
    public function getItemRowTotal($item)
    {
        $itemSku = explode("-", $item->getSku());
        $uom     = '';
        // @codingStandardsIgnoreLine
        if (count($itemSku) < 2) {
            $itemSku[1] = null;
        }
        $baseUnitOfMeasure = $item->getProduct()->getData('uom');
        // @codingStandardsIgnoreLine
        $uom = $this->itemHelper->getUom($itemSku, $baseUnitOfMeasure);
        $rowTotal   = "";
        $basketData = $this->getOneListCalculation();
        $orderLines = $basketData ? $basketData->getOrderLines()->getOrderLine() : [];
        foreach ($orderLines as $line) {
            // @codingStandardsIgnoreLine
            if ($itemSku[0] == $line->getItemId() && $itemSku[1] == $line->getVariantId() && $uom == $line->getUomId()) {
                $rowTotal = $line->getAmount();
                break;
            }
        }
        return $rowTotal;
    }

    /**
     * @return mixed
     * @throws InvalidEnumException|NoSuchEntityException
     */
    public function getOneListCalculation()
    {
        // @codingStandardsIgnoreStart
        $oneListCalc = $this->getOneListCalculationFromCheckoutSession();
        if ($oneListCalc == null) {
            $this->calculate($this->get());

            // calculate updates the session, so we fetch again
            return $this->getOneListCalculationFromCheckoutSession();
            // @codingStandardsIgnoreEnd
        }

        return $oneListCalc;
    }

    /**
     * @param $order
     * @return Order
     * @throws InvalidEnumException
     * @throws LocalizedException
     */
    public function calculateOneListFromOrder($order)
    {
        $orderLines = [];
        $orderItems = $order->getAllVisibleItems();
        foreach ($orderItems as $index => $orderItem) {
            $orderLine = new OrderLine();
            $sku       = $orderItem->getSku();
            $parts     = explode('-', $sku);
            $itemId    = array_shift($parts);
            $variantId = count($parts) ? array_shift($parts) : null;
            $qty       = $orderItem->getQtyOrdered();
            $amount    = $orderItem->getPrice() * $qty;
            $orderLine->setItemId($itemId)
                ->setVariantId($variantId)
                ->setQuantity($qty)
                ->setQuantityToInvoice($qty)
                ->setAmount($amount)
                ->setDiscountAmount($orderItem->getDiscountAmount())
                ->setNetPrice($orderItem->getOriginalPrice())
                ->setNetAmount($amount)
                ->setPrice($orderItem->getOriginalPrice())
                ->setLineNumber(++$index)
                ->setLineType('Item');
            $orderLines[] = $orderLine;
        }
        $oneListCalculation = new Order();
        $items              = new ArrayOfOrderLine();
        $items->setOrderLine($orderLines);
        $oneListCalculation->setOrderLines($items);
        $websiteId = $order->getStore()->getWebsiteId();
        if (!$order->getCustomerIsGuest()) {
            $customerEmail = $order->getCustomerEmail();
            $customer      = $this->customerFactory->create()
                ->setWebsiteId($websiteId)
                ->loadByEmail($customerEmail);
            $cardId        = $customer->getData('lsr_cardid');
            $oneListCalculation->setCardId($cardId);
        }
        $webStore = $this->lsr->getWebsiteConfig(LSR::SC_SERVICE_STORE, $websiteId);
        $oneListCalculation->setStoreId($webStore);
        $oneListCalculation->setTotalAmount($order->getGrandTotal());
        $oneListCalculation->setTotalDiscount(abs($order->getDiscountAmount()));
        return $oneListCalculation;
    }

    /**
     * Get Basket Session Data
     * @return mixed
     */
    public function getBasketSessionValue()
    {
        return $this->getOneListCalculationFromCheckoutSession();
    }

    /**
     * @param $oneList
     */
    public function setOneListInCustomerSession($oneList)
    {
        $this->customerSession->setData(LSR::SESSION_CART_ONELIST, $oneList);
    }

    /**
     * @return mixed|null
     */
    public function getOneListFromCustomerSession()
    {
        return $this->customerSession->getData(LSR::SESSION_CART_ONELIST);
    }

    /**
     * @param $wishList
     */
    public function setWishListInCustomerSession($wishList)
    {
        $this->customerSession->setData(LSR::SESSION_CART_WISHLIST, $wishList);
    }

    /**
     * @return mixed|null
     */
    public function getWishListFromCustomerSession()
    {
        return $this->customerSession->getData(LSR::SESSION_CART_WISHLIST);
    }

    /**
     * @param Entity\OneListCalculateResponse|null $calculation
     */
    public function setOneListCalculationInCheckoutSession($calculation)
    {
        $this->checkoutSession->setData(LSR::SESSION_CHECKOUT_ONE_LIST_CALCULATION, $calculation);
    }

    /**
     * @return mixed|null
     */
    public function getOneListCalculationFromCheckoutSession()
    {
        return $this->checkoutSession->getData(LSR::SESSION_CHECKOUT_ONE_LIST_CALCULATION);
    }

    /**
     * @param $couponCode
     */
    public function setCouponCodeInCheckoutSession($couponCode)
    {
        $this->checkoutSession->setData(LSR::SESSION_CHECKOUT_COUPON_CODE, $couponCode);
    }

    /**
     * @return mixed|null
     */
    public function getCouponCodeFromCheckoutSession()
    {
        return $this->checkoutSession->getData(LSR::SESSION_CHECKOUT_COUPON_CODE);
    }

    /**
     * @param $memberPoints
     */
    public function setMemberPointsInCheckoutSession($memberPoints)
    {
        $this->checkoutSession->setData(LSR::SESSION_CHECKOUT_MEMBERPOINTS, $memberPoints);
    }

    /**
     * @return mixed|null
     */
    public function getMemberPointsFromCheckoutSession()
    {
        return $this->checkoutSession->getData(LSR::SESSION_CHECKOUT_MEMBERPOINTS);
    }

    /**
     * @param $documentId
     */
    public function setLastDocumentIdInCheckoutSession($documentId)
    {
        $this->checkoutSession->setData(LSR::SESSION_CHECKOUT_LAST_DOCUMENT_ID, $documentId);
    }

    /**
     * @return mixed|null
     */
    public function getLastDocumentIdFromCheckoutSession()
    {
        return $this->checkoutSession->getData(LSR::SESSION_CHECKOUT_LAST_DOCUMENT_ID);
    }

    /**
     * clear coupon code from checkout session
     */
    public function unSetCouponCode()
    {
        $this->checkoutSession->unsetData(LSR::SESSION_CHECKOUT_COUPON_CODE);
    }

    /**
     * clear one list calculation from checkout session
     */
    public function unSetOneListCalculation()
    {
        $this->checkoutSession->unsetData(LSR::SESSION_CHECKOUT_ONE_LIST_CALCULATION);
    }

    /**
     * clear onelist from customer session
     */
    public function unSetOneList()
    {
        $this->customerSession->unsetData(LSR::SESSION_CART_ONELIST);
    }

    /**
     * clear member points from checkout session
     */
    public function unSetMemberPoints()
    {
        $this->checkoutSession->unsetData(LSR::SESSION_CHECKOUT_MEMBERPOINTS);
    }

    /**
     * clear last document id from checkout session
     */
    public function unSetLastDocumentId()
    {
        $this->checkoutSession->unsetData(LSR::SESSION_CHECKOUT_LAST_DOCUMENT_ID);
    }

    /**
     * clear required data from customer and checkout sessions
     */
    public function unSetRequiredDataFromCustomerAndCheckoutSessions()
    {
        $this->unSetMemberPoints();
        $this->unSetOneList();
        $this->unSetOneListCalculation();
        $this->unsetCouponCode();
    }
}
