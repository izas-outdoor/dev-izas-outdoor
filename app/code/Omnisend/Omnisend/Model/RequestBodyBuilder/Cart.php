<?php

namespace Omnisend\Omnisend\Model\RequestBodyBuilder;

use Omnisend\Omnisend\Helper\GmtDateHelper;
use Omnisend\Omnisend\Helper\PriceHelper;
use Omnisend\Omnisend\Observer\QuoteUpdateObserver;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Framework\UrlInterface;

class Cart extends AbstractBodyBuilder implements RequestBodyBuilderInterface
{
    const CART_ID = 'cartID';
    const EMAIL = 'email';
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const CURRENCY = 'currency';
    const CART_SUM = 'cartSum';
    const CART_RECOVERY_URL = 'cartRecoveryUrl';
    const PRODUCTS = 'products';
    const EMAIL_ID = 'emailID';

    const CART_PRODUCT_ID = 'cart_product_id';

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var PriceHelper
     */
    private $priceHelper;

    /**
     * @var GmtDateHelper
     */
    private $gmtDateHelper;

    /**
     * @var CartItemFactory
     */
    private $cartItemFactory;

    /**
     * @param UrlInterface $url
     * @param PriceHelper $priceHelper
     * @param GmtDateHelper $gmtDateHelper
     * @param CartItemFactory $cartItemFactory
     */
    public function __construct(
        UrlInterface $url,
        PriceHelper $priceHelper,
        GmtDateHelper $gmtDateHelper,
        CartItemFactory $cartItemFactory
    ) {
        $this->url = $url;
        $this->priceHelper = $priceHelper;
        $this->gmtDateHelper = $gmtDateHelper;
        $this->cartItemFactory = $cartItemFactory;
    }

    /**
     * @param CartInterface $quote
     * @return string
     */
    public function build($quote)
    {
        $quoteId = $quote->getId();

        $this->addData(self::CART_ID, $quoteId);
        $this->addData(self::EMAIL, $quote->getCustomerEmail());
        $this->addData(self::CREATED_AT, $this->gmtDateHelper->getGmtDate($quote->getCreatedAt()));
        $this->addData(self::UPDATED_AT, $this->gmtDateHelper->getGmtDate($quote->getUpdatedAt()));
        $this->addData(self::CURRENCY, $quote->getCurrency()->getGlobalCurrencyCode());
        $this->addData(self::CART_SUM, $this->priceHelper->getPriceInCents($quote->getSubtotal()));
        $this->addData(self::CART_RECOVERY_URL, $this->url->getUrl('checkout/cart', ['_secure' => true]));
        $this->addData(self::EMAIL_ID, $quote->getData(QuoteUpdateObserver::EMAIL_ID));

        $idInCart = 1;
        $quoteProducts = $quote->getAllVisibleItems();
        $omnisendProducts = array();

        foreach ($quoteProducts as $quoteProduct) {
            if ($quoteProduct->getPrice() === null) {
                continue;
            }

            $quoteProduct->setData(self::CART_PRODUCT_ID, $idInCart++);

            $cartItemBuilder = $this->cartItemFactory->create();
            $cartItemBuilder->build($quoteProduct);

            array_push($omnisendProducts, $cartItemBuilder->getData());
        }

        $this->addData(self::PRODUCTS, $omnisendProducts);

        return json_encode($this->getData());
    }
}