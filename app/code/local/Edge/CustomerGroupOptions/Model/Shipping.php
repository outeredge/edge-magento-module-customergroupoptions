<?php
/**
 * @category    Edge
 * @package     Edge_CustomerGroupOptions
 */


class Edge_CustomerGroupOptions_Model_Shipping extends Mage_Shipping_Model_Shipping
{
    private $availableCarriers = null;

    /**
     * Collect rates of given carrier
     *
     * @param string                           $carrierCode
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Shipping
     */
    public function collectCarrierRates($carrierCode, $request)
    {
        $this->_setAvailableCarriers();
        if($this->availableCarriers != null && !in_array($carrierCode, $this->availableCarriers)) {
            return false;
        }

        return parent::collectCarrierRates($carrierCode, $request);
    }

    protected function _setAvailableCarriers() {
        if(Mage::getSingleton('customer/session')->isLoggedIn() && $this->availableCarriers == null){
            $this->availableCarriers = Mage::getModel('customergroupoptions/customerGroupOptions')->getGroupShippingMethods(Mage::getSingleton('customer/session')->getCustomerGroupId());
        }
    }
}
