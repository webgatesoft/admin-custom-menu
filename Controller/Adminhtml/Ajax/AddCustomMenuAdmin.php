<?php

namespace WebGate\CustomMenu\Controller\Adminhtml\Ajax;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use WebGate\CustomMenu\Model\CustomMenuFactory;

class AddCustomMenuAdmin extends Action
{
    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;
    /**
     * @var CustomMenuFactory
     */
    private $customMenuFactory;
    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    private $authSession;


    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param CustomMenuFactory $customMenuFactory
     */
    public function __construct(
        \Magento\Backend\Model\Auth\Session $authSession,
        Context $context,
        JsonFactory $resultJsonFactory,
        CustomMenuFactory $customMenuFactory
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
        $this->customMenuFactory = $customMenuFactory;
        $this->authSession = $authSession;
    }


    /**
     * @return ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $data = $this->getRequest()->getParams();

        $customMenu = $this->customMenuFactory->create();

        $id = $customMenu->setData([
            'target' => '_parent',
            'sortOrder' => '99',
            'icon' => 'fa fa-plus',
            'title' => $this->getRequest()->getParam('title'),
            'link' => $this->getRequest()->getParam('link'),
            'admin_id' => $this->authSession->getUser()->getId()
        ])->save();

        return $resultJson->setData([
            'url' => $this->getUrl('webgate_custommenu/custommenu/edit', [
                'entity_id' => $id->getId()
            ]),
            'title' => __('Your menu has been added.do you want to edit it?')
        ]);
    }

}
