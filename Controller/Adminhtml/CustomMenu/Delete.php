<?php
    
    namespace WebGate\CustomMenu\Controller\Adminhtml\CustomMenu;
    
    use Magento\Backend\App\Action;
    use Magento\Backend\App\Action\Context;
    use WebGate\CustomMenu\Model\CustomMenuFactory;
    
    class Delete extends Action
    {
        /** @var custommenuFactory $objectFactory */
        protected $objectFactory;
    
        /**
         * @param Context $context
         * @param CustomMenuFactory $objectFactory
         */
        public function __construct(
        Context $context,
        CustomMenuFactory $objectFactory
        ) {
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
         * Delete action
         *
         * @return \Magento\Framework\Controller\ResultInterface
         */
        public function execute()
        {
            $resultRedirect = $this->resultRedirectFactory->create();
            $id = $this->getRequest()->getParam('entity_id', null);
    
            try {
                $objectInstance = $this->objectFactory->create()->load($id);
                if ($objectInstance->getId()) {
                    $objectInstance->delete();
                    $this->messageManager->addSuccessMessage(__('You deleted the record.'));
                } else {
                    $this->messageManager->addErrorMessage(__('Record does not exist.'));
                }
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
            }
            
            return $resultRedirect->setPath('*/*');
        }
    }
