<?php
/**
 * Customer groups controller
 */
require_once(Mage::getModuleDir('controllers','Mage_Adminhtml').DS.'Customer'.DS.'GroupController.php');
class Edge_CustomerGroupOptions_Adminhtml_Customer_GroupController extends Mage_Adminhtml_Customer_GroupController
{
    /**
     * Create or save customer group.
     */
    public function saveAction()
    {
        $customerGroup = Mage::getModel('customer/group');
        $data = $this->getRequest()->getPost();
        $id = $data['id'];
        if (!is_null($id)) {
            $customerGroup->load((int)$id);
        }

        $taxClass = (int)$data['tax_class'];

        if ($taxClass) {
            try {
                $customerGroupCode = (string)$data['code'];

                if (!empty($customerGroupCode)) {
                    $customerGroup->setCode($customerGroupCode);
                }

                $customerGroup->setTaxClassId($taxClass)->save();

                $this->savePaymentMethods($id, $data['payment_methods']);

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('customer')->__('The customer group has been saved.'));
                $this->getResponse()->setRedirect($this->getUrl('*/customer_group'));
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setCustomerGroupData($customerGroup->getData());
                $this->getResponse()->setRedirect($this->getUrl('*/customer_group/edit', array('id' => $id)));
                return;
            }
        } else {
            $this->_forward('new');
        }
    }

    private function savePaymentMethods($id, $methods) {

        $methods= json_encode($methods, JSON_FORCE_OBJECT);
        try{
            $groupMethodModel = Mage::getModel('customergroupoptions/customerGroupOptions')->load($id, 'customer_group_id');
            $groupMethodModel->setCustomerGroupId($id)
                             ->setPaymentMethods($methods)
                             ->save();
            return;
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->getResponse()->setRedirect($this->getUrl('*/customer_group/edit', array('id' => $id)));
            return;
        }
    }
}
