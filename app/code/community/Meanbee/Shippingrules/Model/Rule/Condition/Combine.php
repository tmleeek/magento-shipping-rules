<?php
class Meanbee_Shippingrules_Model_Rule_Condition_Combine extends Mage_Rule_Model_Condition_Combine {
    public function __construct() {
        parent::__construct();
        $this->setType('meanship/rule_condition_combine');
    }

    public function getNewChildSelectOptions() {
        $conditions = parent::getNewChildSelectOptions();

        $conditions[] = array(
            'label' => Mage::helper('meanship')->__('Conditions Combination'),
            'value' => 'meanship/rule_condition_combine'
        );

        $conditions[] = array(
            'label' => Mage::helper('meanship')->__('Magento Environment'),
            'value' => array(
                array(
                    'label' => Mage::helper('meanship')->__('Magento Store'),
                    'value' => 'meanship/rule_condition|store_id'
                ),
                array(
                    'label' => Mage::helper('meanship')->__('Magento Website'),
                    'value' => 'meanship/rule_condition|website_id'
                ),
                array(
                    'label' => Mage::helper('meanship')->__('Is an admin order?'),
                    'value' => 'meanship/rule_condition|is_admin_order'
                )
            )
        );

        $conditions[] = array(
            'label' => Mage::helper('meanship')->__('Customer Information'),
            'value' => array(
                array(
                    'label' => Mage::helper('meanship')->__('Customer Group'),
                    'value' => 'meanship/rule_condition|customer_group_id'
                )
            )
        );

        $conditions[] = array(
            'label' => Mage::helper('meanship')->__('Cart Conditions'),
            'value' => array(
                array(
                    'label' => Mage::helper('meanship')->__('Cart Weight'),
                    'value' => 'meanship/rule_condition|package_weight'
                ),
                array(
                    'label' => Mage::helper('meanship')->__('Cart Item Count'),
                    'value' => 'meanship/rule_condition|package_qty'
                ),
                array(
                    'label' => Mage::helper('meanship')->__('Cart Subtotal'),
                    'value' => 'meanship/rule_condition|package_value'
                )
            )
        );

        $conditions[] = array(
            'label' => Mage::helper('meanship')->__('Destination Conditions'),
            'value' => array(
                array(
                    'label' => Mage::helper('meanship')->__('Shipping Country'),
                    'value' => 'meanship/rule_condition|dest_country_id'
                ),
                array(
                    'label' => Mage::helper('meanship')->__('Shipping Country Group'),
                    'value' => 'meanship/rule_condition|dest_country_group'
                ),
                array(
                    'label' => Mage::helper('meanship')->__('Shipping State'),
                    'value' => 'meanship/rule_condition|dest_region_id'
                ),
                array(
                    'label' => Mage::helper('meanship')->__('Shipping Zip Code'),
                    'value' => 'meanship/rule_condition|dest_postcode'
                )
            )
        );

        $conditions[] = array(
            'label' => Mage::helper('meanship')->__('Specalist Destnation Conditions'),
            'value' => array(
                array(
                    'label' => Mage::helper('meanship')->__('Shipping Zip Code (if numeric value)'),
                    'value' => 'meanship/rule_condition|dest_postcode_numeric'
                ),
                array(
                    'label' => Mage::helper('meanship')->__('Shipping Postcode Prefix (UK only)'),
                    'value' => 'meanship/rule_condition|dest_postcode_prefix'
                )
            )
        );

        $conditions[] = array(
            'label' => Mage::helper('meanship')->__('Cart Item Conditions'),
            'value' => array(
                array(
                    'label' => Mage::helper('meanship')->__('Cart items subselection'),
                    'value' => 'meanship/rule_condition_product_subselect'
                ),
            )
        );

        return $conditions;
    }

    public function collectValidatedAttributes($productCollection) {
        foreach ($this->getConditions() as $condition) {
            $condition->collectValidatedAttributes($productCollection);
        }
        return $this;
    }
}
