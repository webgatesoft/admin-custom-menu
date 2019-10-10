<?php

namespace WebGate\CustomMenu\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Model\Auth\Session;
use WebGate\CustomMenu\Helper\Data;
use WebGate\CustomMenu\Model\CustomMenuFactory;

class CustomMenu extends Template
{
    protected $_template = 'WebGate_CustomMenu::custom_menu.phtml';
    /**
     * @var CustomMenuFactory
     */
    private $customMenuFactory;
    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    private $request;
    /**
     * @var \Magento\Framework\View\Page\Title
     */
    private $pageTitle;
    /**
     * @var \WebGate\CustomMenu\Helper\Data
     */
    private $dataHelpar;
    /**
     * @var Session
     */
    private $authSession;

    public function __construct(
        \WebGate\CustomMenu\Helper\Data $dataHelpar,
        Session $authSession,
        CustomMenuFactory $customMenuFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\View\Page\Title $pageTitle,
        Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->customMenuFactory = $customMenuFactory;
        $this->request = $request;
        $this->pageTitle = $pageTitle;
        $this->dataHelpar = $dataHelpar;
        $this->authSession = $authSession;
    }

    public function getDataHelper()
    {
        return $this->dataHelpar;
    }

    public function getLinks()
    {
        $links = $this->customMenuFactory->create()->getCollection()
            ->setOrder('sortOrder', 'asc');

        if ($this->dataHelpar->getDifferentMenuAdmin()) {
            $links->addFilter('admin_id', $this->authSession->getUser()->getId());
        }

        return $links->getItems();
    }

    public function getTitle()
    {
        return $this->pageTitle->getShort();
    }

    public function getUrlAdmin()
    {
        $routeName = $this->request->getRouteName();
        $controllerName = $this->request->getControllerName();
        $actionName = $this->request->getActionName();

        $params = $this->request->getParams();

        if (isset($params['key'])) {
            unset($params['key']);
        }

        return json_encode([
            'url' => $routeName . '/' . $controllerName . '/' . $actionName,
            'params' => $params
        ]);
    }

    public function get_Url($url)
    {
        $_url = json_decode($url,true);

        if (is_array($_url))
        {
            return $this->getUrl(
                isset($_url['url']) ? $_url['url'] : '',
                isset($_url['params']) ? $_url['params'] : ''
            );
        }

        return $url;
    }
}
