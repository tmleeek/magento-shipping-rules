<?php
class Meanbee_Shippingrules_Block_Adminhtml_Rules_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    public function __construct() {
        parent::__construct();

        $this->setId('meanbee_shippingrules_grid');
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('meanship/rule')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('rule_id', array(
            'header'    => Mage::helper('meanship')->__('ID'),
            'align'     => 'center',
            'index'     => 'rule_id',
            'width'     => '50px'
        ));

        $this->addColumn('is_active', array(
            'header'    => Mage::helper('meanship')->__('Enabled'),
            'align'     => 'center',
            'index'     => 'is_active',
            'type'      => 'checkbox'
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('meanship')->__('Name'),
            'align'     =>'left',
            'index'     => 'name',
            'width'     => '250px'
        ));

        $this->addColumn('conditions', array(
            'header'    => Mage::helper('meanship')->__('Rule Condition Summary'),
            'align'     =>'left',
            'getter'    => 'getConditionsHtml'
        ));

        $this->addColumn('price', array(
            'header'    => Mage::helper('meanship')->__('Price'),
            'align'     =>'left',
            'index'     => 'price',
            'type'      => 'price'
        ));

        $this->addColumn('sort_order', array(
            'header'    => Mage::helper('meanship')->__('Sort Order'),
            'align'     => 'center',
            'index'     => 'sort_order',
            'width'     => '50px',
            'type'      => 'range'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}