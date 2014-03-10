<?php

class Edge_CustomerGroupOptions_Model_Resource_CustomerGroupOptions extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('customergroupoptions/customergroupoptions', 'customer_group_options_id');
    }
}