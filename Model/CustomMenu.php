<?php
    
    namespace WebGate\CustomMenu\Model;
    
    use Magento\Framework\Model\AbstractModel;
    
    class CustomMenu extends AbstractModel
    {
        /**
         * @var string
         */
        protected $_cacheTag = 'webgate_custommenu_custommenu';
    
        /**
         * Prefix of model events names
         *
         * @var string
         */
        protected $_eventPrefix = 'webgate_custommenu_custommenu';
    
        /**
         * Initialize resource model
         *
         * @return void
         */
        protected function _construct()
        {
            parent::_construct();
            $this->_init('WebGate\CustomMenu\Model\ResourceModel\CustomMenu');
        }
    }
