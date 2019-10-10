<?php
    namespace WebGate\CustomMenu\Helper;
    
    use Magento\Framework\App\Helper\AbstractHelper;
    use Magento\Store\Model\ScopeInterface;
    
    class Data extends AbstractHelper
    {
        const base = 'custom_menu/custom_menu/';
        
        /**
         * @param \Magento\Framework\App\Helper\Context $context
         */
        public function __construct(
            \Magento\Framework\App\Helper\Context $context
        )
        {
            parent::__construct($context);
        }
        
        private function getConfigValue($code , $path , $storeId = null)
        {
            return $this->scopeConfig->getValue(
                $path . $code , ScopeInterface::SCOPE_STORE , $storeId
            );
        }
        
        /**
         * @return string
         */
        public function getEnable()
        {
            return $this->getConfigValue('enable' , static::base);
        }

        /**
         * @return string
         */
        public function getPosition1()
        {
            return $this->getConfigValue('position_1' , static::base);
        }

        /**
         * @return string
         */
        public function getPosition2()
        {
            return $this->getConfigValue('position_2' , static::base);
        }

        /**
         * @return boolean
         */
        public function getDifferentMenuAdmin()
        {
            return $this->getConfigValue('different_menu_admin' , static::base) == '1';
        }


    }
