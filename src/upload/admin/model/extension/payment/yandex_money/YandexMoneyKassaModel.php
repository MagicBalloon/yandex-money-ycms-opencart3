<?php

require_once DIR_CATALOG . 'model/extension/payment/yandex_money/autoload.php';

class YandexMoneyKassaModel extends \YandexMoneyModule\Model\KassaModel
{
    private $invoiceEnable;
    private $invoiceSubject;
    private $invoiceMessage;
    private $invoiceLogo;

    public function __construct(Config $config)
    {
        parent::__construct($config);

        $this->invoiceEnable = (bool)$config->get('yandex_money_kassa_invoice');
        $this->invoiceSubject = $config->get('yandex_money_kassa_invoice_subject');
        $this->invoiceMessage = $config->get('yandex_money_kassa_invoice_message');
        $this->invoiceLogo = (bool)$config->get('yandex_money_kassa_invoice_logo');
    }

    public function setIsEnabled($value)
    {
        $this->enabled = $value ? true : false;
    }

    public function setShopId($value)
    {
        $this->shopId = $value;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function setEpl($value)
    {
        $this->epl = $value ? true : false;
    }

    public function setUseYandexButton($value)
    {
        $this->useYandexButton = $value ? true : false;
    }

    public function setPaymentMethodFlag($paymentMethod, $value)
    {
        if (array_key_exists($paymentMethod, $this->paymentMethods)) {
            $this->paymentMethods[$paymentMethod] = $value ? true : false;
        }
    }

    public function setSendReceipt($value)
    {
        $this->sendReceipt = $value ? true : false;
    }

    public function setDefaultTaxRate($value)
    {
        if (!in_array($value, $this->getTaxRateList())) {
            $value = 1;
        }
        $this->defaultTaxRate = (int)$value;
    }

    public function setTaxRates($taxRates)
    {
        $all = $this->getTaxRateList();
        $this->taxRates = array();
        foreach ($taxRates as $shopTaxRateId => $taxRate) {
            if (in_array($taxRate, $all)) {
                $this->taxRates[$shopTaxRateId] = (int)$taxRate;
            }
        }
    }

    public function setSuccessOrderStatusId($value)
    {
        $this->successOrderStatus = (int)$value;
    }

    public function setMinPaymentAmount($value)
    {
        if ($value < 0) {
            $value = 0;
        }
        $this->minPaymentAmount = (int)$value;
    }

    public function setGeoZoneId($value)
    {
        $this->geoZone = $value;
    }

    public function setDebugLog($value)
    {
        $this->log = $value ? true : false;
    }

    public function setDisplayName($value)
    {
        $this->displayName = $value;
    }

    /**
     * @return bool
     */
    public function isInvoicesEnabled()
    {
        return $this->invoiceEnable;
    }

    /**
     * @param bool $value
     */
    public function setInvoicesEnabled($value)
    {
        $this->invoiceEnable = $value;
    }

    /**
     * @return string
     */
    public function getInvoiceSubject()
    {
        return $this->invoiceSubject;
    }

    /**
     * @param string $value
     */
    public function setInvoiceSubject($value)
    {
        $this->invoiceSubject = $value;
    }

    /**
     * @return string
     */
    public function getInvoiceMessage()
    {
        return $this->invoiceMessage;
    }

    /**
     * @param string $value
     */
    public function setInvoiceMessage($value)
    {
        $this->invoiceMessage = $value;
    }

    /**
     * @return bool
     */
    public function getSendInvoiceLogo()
    {
        return $this->invoiceLogo;
    }

    /**
     * @param bool $value
     */
    public function setSendInvoiceLogo($value)
    {
        $this->invoiceLogo = $value;
    }
}
