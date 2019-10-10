<?php
    
    namespace WebGate\CustomMenu\Model\ResourceModel;
    
    use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
    
    class CustomMenu extends AbstractDb
    {
        /**
         * Initialize resource model
         *
         * @return void
         */
        protected function _construct()
        {
            $this->_init('webgate_custommenu_custommenu', 'entity_id');
        }
    }
