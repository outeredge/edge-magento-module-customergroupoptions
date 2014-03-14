<?php
/**
 * For compatibility with Unirgy_GiftCert ammend Unirgy_Giftcert_Block_Payment_Methods to extend this class.
 */
class Edge_CustomerGroupOptions_Block_Onepage_Payment_Methods extends Mage_Checkout_Block_Onepage_Payment_Methods
{
    private $availableMethods = null;

    public function _construct() {
        $this->_setAvailableMethods();
        parent::_construct();
    }

    /**
     * Check and prepare payment method model
     *
     * @return bool
     */
    protected function _canUseMethod($method) {
        if (!$method || !$method->canUseCheckout()) {
            return false;
        }
        if($this->availableMethods != null && !in_array($method->getCode(), $this->availableMethods)) {
            return false;
        }
        return parent::_canUseMethod($method);
    }

    protected function _setAvailableMethods() {
        if($this->availableMethods == null){
            $this->availableMethods = Mage::getModel('customergroupoptions/customerGroupOptions')->getAvailablePaymentMethodsByGroupId(Mage::getSingleton('customer/session')->getCustomerGroupId());
        }
    }
}