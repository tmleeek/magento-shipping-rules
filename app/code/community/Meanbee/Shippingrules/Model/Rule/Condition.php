<?php
class Meanbee_Shippingrules_Model_Rule_Condition extends Meanbee_Shippingrules_Model_Rule_Condition_Abstract {
    public function loadAttributeOptions() {
        $attributes = array(
            'package_qty'    => Mage::helper('meanship')->__('Total Items Quantity'),
            'package_value'  => Mage::helper('meanship')->__('Subtotal'),
            'package_weight' => Mage::helper('meanship')->__('Total Weight'),

            'customer_group_id' => Mage::helper('meanship')->__('Customer Group'),

            'dest_country_id' => Mage::helper('meanship')->__('Shipping Country'),
            'dest_region_id'  => Mage::helper('meanship')->__('Shipping State'),
            'dest_postcode'   => Mage::helper('meanship')->__('Shipping Zipcode')
        );

        $this->setAttributeOption($attributes);

        return $this;
    }

    public function getInputType() {
        switch ($this->getAttribute()) {
            case 'customer_group_id':
            case 'dest_country_id':
            case 'dest_region_id':
                return 'multiselect';
            case 'dest_postcode':
                return 'string';
            default:
                return 'numeric';
        }
    }

    public function getValueElementType() {
        switch ($this->getAttribute()) {
            case 'customer_group_id':
            case 'dest_country_id':
            case 'dest_region_id':
                return 'multiselect';
            default:
                return 'text';
        }
    }

    public function getValueSelectOptions() {
        if (!$this->hasData('value_select_options')) {
            switch ($this->getAttribute()) {
                case 'customer_group_id':
                    $options = Mage::getModel('customer/group')
                        ->getCollection()
                        ->toOptionArray();
                    break;
                case 'dest_country_id':
                    $options = Mage::getResourceModel('directory/country_collection')
                        ->loadData()
                        ->toOptionArray(false);
                    break;
                case 'dest_region_id':
                    $options = Mage::getResourceModel('directory/region_collection')
                        ->loadData()
                        ->toOptionArray(false);
                    break;
                default:
                    $options = array();
            }

            $this->setData('value_select_options', $options);
        }

        return $this->getData('value_select_options');
    }

    public function getSanitisedValue($object) {
        $value = $object->getData($this->getAttribute());

        switch ($this->getAttribute()) {
            case 'dest_postcode':
                $value = str_replace(' ', '', strtolower($value));
                break;
        }

        return $value;
    }

    public function getValueParsed() {
        $value = parent::getValueParsed();

        switch ($this->getAttribute()) {
            case 'dest_postcode':
                $value = str_replace(' ', '', strtolower($value));
                break;
        }

        return $value;
    }

    public function validate(Varien_Object $object) {
        return $this->validateAttribute($this->getSanitisedValue($object));
    }

    public function getAttributeElement() {
        $element = parent::getAttributeElement();
        $element->setShowAsText(true);
        return $element;
    }
}