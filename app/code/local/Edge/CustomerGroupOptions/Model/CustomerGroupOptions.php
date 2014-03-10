<?php

class Edge_CustomerGroupOptions_Model_CustomerGroupOptions extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('customergroupoptions/customerGroupOptions');
    }

    public function getCustomerGroupPaymentMethods($groupId) {
        $model = $this->load($groupId, 'customer_group_id');
        return json_decode($model->getPaymentMethods(), true);
    }
}