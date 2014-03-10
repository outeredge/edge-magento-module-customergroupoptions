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

        $form->setMethod('post');
        $this->setForm($form);
    }

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

	private function _getSelectedPaymentMethods()
    {
        var_dump(Mage::getSingleton('customergroupoptions/customerGroupOptions')->getCustomerGroupPaymentMethods(Mage::registry('current_group')->getId()));
    }
}
