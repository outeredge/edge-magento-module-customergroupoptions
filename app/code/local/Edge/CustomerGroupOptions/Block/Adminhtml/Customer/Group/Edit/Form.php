<?php
/**
 * Adminhtml customer groups edit form
 */
class Edge_CustomerGroupOptions_Block_Adminhtml_Customer_Group_Edit_Form extends Mage_Adminhtml_Block_Customer_Group_Edit_Form
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $form = $this->getForm();
        $fieldset = $form->addFieldset('edge_customergroupoptions_fieldset', array('legend'=>Mage::helper('customer')->__('Options')));

        $fieldset->addField('payment_methods', 'multiselect',
            array(
                'name'  => 'payment_methods',
                'label' => Mage::helper('edge_customergroupoptions')->__('Allowed Payment Methods'),
                'title' => Mage::helper('edge_customergroupoptions')->__('Allowed Payment Methods'),
                'values' => $this->_getActivePaymentMethods(),
                'value' => $this->_getSelectedPaymentMethods(),
                'after_element_html' => '<p class="note">If no payment methods are selected, all methods will be made available.</p>',
            )
        );

        $fieldset->addField('shipping_methods', 'multiselect',
            array(
                'name'  => 'shipping_methods',
                'label' => Mage::helper('edge_customergroupoptions')->__('Allowed Shipping Methods'),
                'title' => Mage::helper('edge_customergroupoptions')->__('Allowed Shipping Methods'),
                'values' => $this->_getActiveShippingMethods(),
                'value' => $this->_getSelectedShippingMethods(),
                'after_element_html' => '<p class="note">If no shipping methods are selected, all methods will be made available.</p>',
            )
        );

        $form->setMethod('post');
        $this->setForm($form);
    }

    /**
     * Gets all enabled payment methods
     *
     * @return array Payment Mthods
     */
    private function _getActivePaymentMethods() {
        $paymentMethods = Mage::getSingleton('payment/config')->getActiveMethods();
        $methods = array();
        foreach ($paymentMethods as $paymentCode => $paymentModel) {
            $methods[$paymentCode] = array(
                'label'   => $paymentModel->getTitle(),
                'value' => $paymentCode,
            );
         }

         return $methods;
    }

    /**
     * Gets all enabled shipping methods
     *
     * @return array Shipping Mthods
     */
    private function _getActiveShippingMethods() {
        $shippingMethods = Mage::getSingleton('shipping/config')->getActiveCarriers();

        $methods = array();
        foreach ($shippingMethods as $methodCode => $methodModel) {
            $methods[$methodCode] = array(
                'label'   => Mage::getStoreConfig("carriers/$methodCode/title") . " ($methodCode)",
                'value' => $methodCode,
            );
         }

         return $methods;
    }

    /**
     * Gets payment methods currently set for customer group
     *
     * @return array Payment Methods
     */
	private function _getSelectedPaymentMethods()
    {
        return Mage::getSingleton('customergroupoptions/customerGroupOptions')->getPaymentMethodsForGroup(Mage::registry('current_group')->getId());
    }

    /**
     * Gets shipping methods currently set for customer group
     *
     * @return array Shipping Methods
     */
	private function _getSelectedShippingMethods()
    {
        return Mage::getSingleton('customergroupoptions/customerGroupOptions')->getShippingMethodsForGroup(Mage::registry('current_group')->getId());
    }
}
