<?php

class Edge_CustomerGroupOptions_Model_CustomerGroupOptions extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('customergroupoptions/customerGroupOptions');
    }

    /**
     * Get allowed payment methods for custom group
     *
     * @param type $groupId Custom Group ID
     * @return array
     */
    public function getPaymentMethodsForGroup($groupId) {
        return json_decode($this->_getCustomerGroupOptions($groupId)->getPaymentMethods(), true);
    }

    /**
     * Get allowed shipping methods for custom group
     *
     * @param type $groupId Customer Group ID
     * @return array
     */
    public function getShippingMethodsForGroup($groupId) {
        return json_decode($this->_getCustomerGroupOptions($groupId)->getShippingMethods(), true);
    }

    /**
     * Load customer group options resource
     *
     * @param type $groupId Customer Group ID
     * @return type resource
     */
    private function _getCustomerGroupOptions($groupId) {
        return $this->load($groupId, 'customer_group_id');
    }
}