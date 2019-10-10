<?php

namespace WebGate\CustomMenu\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Catalog\Ui\DataProvider\Product\ProductCollection\Interceptor;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use WebGate\CustomMenu\Helper\Data;

class ModelCustomMenu implements ObserverInterface
{

    /**
     * @var Session
     */
    private $authSession;
    /**
     * @var Data
     */
    private $dataHelpar;

    public function __construct(
        Session $authSession,
        Data $dataHelpar
    ) {
        $this->authSession = $authSession;
        $this->dataHelpar = $dataHelpar;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var Interceptor $collection */
        $collection = $observer->getEvent()->getData('webgate_custommenu_custommenu_grid_collection');

        if ($this->dataHelpar->getDifferentMenuAdmin()) {
            $collection->addFilter('admin_id', $this->authSession->getUser()->getId());
        }
    }
}
