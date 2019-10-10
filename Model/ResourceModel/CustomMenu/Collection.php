<?php
    
    namespace WebGate\CustomMenu\Model\ResourceModel\CustomMenu;
    
    use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
    
    class Collection extends AbstractCollection
    {
        /**
         * @var string
         */
        protected $_idFieldName = 'entity_id';
    
        /**
         * Define resource model
         *
         * @return void
         */
        protected function _construct()
        {
            $this->_init('WebGate\CustomMenu\Model\CustomMenu', 'WebGate\CustomMenu\Model\ResourceModel\CustomMenu');
        }
    }
