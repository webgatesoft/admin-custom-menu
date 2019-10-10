<?php
    
    namespace WebGate\CustomMenu\Controller\Adminhtml\CustomMenu;
    
    use Magento\Backend\App\Action;
    use Magento\Backend\App\Action\Context;
    use Magento\Framework\View\Result\PageFactory;
    
    class Index extends Action
    {
        /**
         * @var PageFactory
         */
        protected $resultPageFactory;
    
        /**
         * @param Context $context
         * @param PageFactory $resultPageFactory
         */
        public function __construct(
            Context $context,
            PageFactory $resultPageFactory
        ) {
            parent::__construct($context);
            $this->resultPageFactory = $resultPageFactory;
        }
        
        /**
         * Check the permission to run it
         *
         * @return boolean
         */
        protected function _isAllowed()
        {
            return $this->_authorization->isAllowed('WebGate_CustomMenu::custommenu');
        }
    
        /**
         * Index action
         *
         * @return \Magento\Backend\Model\View\Result\Page
         */
        public function execute()
        {
            /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
            $resultPage = $this->resultPageFactory->create();
            $resultPage->setActiveMenu('WebGate_CustomMenu::custommenu');
            $resultPage->getConfig()->getTitle()->prepend(__('Custom Menu'));
    
            return $resultPage;
        }
    }
