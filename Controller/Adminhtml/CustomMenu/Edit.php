<?php
    
    namespace WebGate\CustomMenu\Controller\Adminhtml\CustomMenu;
    
    use Magento\Backend\App\Action;
    use Magento\Backend\App\Action\Context;
    use Magento\Framework\Registry;
    use Magento\Framework\View\Result\PageFactory;
    use WebGate\CustomMenu\Model\CustomMenuFactory;
    
    class Edit extends Action
    {
        /**
         * Core registry
         *
         * @var Registry
         */
        protected $_coreRegistry = null;
    
        /**
         * @var PageFactory
         */
        protected $resultPageFactory;
    
        /** @var custommenuFactory $objectFactory */
        protected $objectFactory;
    
        /**
         * @param Context $context
         * @param PageFactory $resultPageFactory
         * @param Registry $registry
         * @param CustomMenuFactory $objectFactory
         */
        public function __construct(
            Context $context,
            PageFactory $resultPageFactory,
            Registry $registry,
            CustomMenuFactory $objectFactory
        ) {
            $this->resultPageFactory = $resultPageFactory;
            $this->_coreRegistry = $registry;
            $this->objectFactory = $objectFactory;
            parent::__construct($context);
        }
    
        /**
         * {@inheritdoc}
         */
        protected function _isAllowed()
        {
            return $this->_authorization->isAllowed('WebGate_CustomMenu::custommenu');
        }
    
        /**
         * Edit
         *
         * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
         * @SuppressWarnings(PHPMD.NPathComplexity)
         */
        public function execute()
        {
            // 1. Get ID
            $id = $this->getRequest()->getParam('entity_id');
            $objectInstance = $this->objectFactory->create();
    
            // 2. Initial checking
            if ($id) {
                $objectInstance->load($id);
                if (!$objectInstance->getId()) {
                    $this->messageManager->addErrorMessage(__('This record no longer exists.'));
                    /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                    $resultRedirect = $this->resultRedirectFactory->create();
    
                    return $resultRedirect->setPath('*/*/');
                }
            }
    
            // 3. Set entered data if was error when we do save
            $data = $this->_session->getFormData(true);
            if (!empty($data)) {
                $objectInstance->addData($data);
            }
    
            // 4. Register model to use later in blocks
            $this->_coreRegistry->register('WebGate_CustomMenu_custommenu', $objectInstance);
    
            // 5. Build edit form
            /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
            $resultPage = $this->resultPageFactory->create();
            $resultPage->setActiveMenu('WebGate_CustomMenu::custommenu');
            $resultPage->getConfig()->getTitle()->prepend(__('Custom Menu Edit'));
    
            return $resultPage;
        }
    }
