<?php

namespace WebGate\CustomMenu\Controller\Adminhtml\CustomMenu;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use WebGate\CustomMenu\Model\CustomMenuFactory;

class Save extends Action
{
    /** @var CustomMenuFactory $objectFactory */
    protected $objectFactory;
    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    private $authSession;

    /**
     * @param Context $context
     * @param CustomMenuFactory $objectFactory
     */
    public function __construct(
        \Magento\Backend\Model\Auth\Session $authSession,
        Context $context,
        CustomMenuFactory $objectFactory
    )
    {
        parent::__construct($context);
        $this->objectFactory = $objectFactory;
        $this->authSession = $authSession;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $params = [];
            $objectInstance = $this->objectFactory->create();
            $idField = $objectInstance->getIdFieldName();
            if (empty($data[$idField])) {
                $data[$idField] = null;
                $data['admin_id'] = $this->authSession->getUser()->getId();
            } else {
                $objectInstance->load($data[$idField]);
                $params[$idField] = $data[$idField];
            }


            $objectInstance->addData($data);

            $this->_eventManager->dispatch(
                'webgate_custommenu_custommenu_prepare_save',
                ['object' => $this->objectFactory, 'request' => $this->getRequest()]
            );

            try {
                $objectInstance->save();
                $this->messageManager->addSuccessMessage(__('You saved this record.'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $params = [$idField => $objectInstance->getId(), '_current' => true];
                    return $resultRedirect->setPath('*/*/edit', $params);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the record.'));
            }

            $this->_getSession()->setFormData($this->getRequest()->getPostValue());
            return $resultRedirect->setPath('*/*/edit', $params);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('WebGate_CustomMenu::custommenu');
    }
}
