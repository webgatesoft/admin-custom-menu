<?php

    namespace WebGate\CustomMenu\Ui\Component\Listing\Column;

    use Magento\Framework\UrlInterface;
    use Magento\Framework\View\Element\UiComponent\ContextInterface;
    use Magento\Framework\View\Element\UiComponentFactory;
    use Magento\Ui\Component\Listing\Columns\Column;

    class CustomMenuActions extends Column
    {
        /**
         * Url path
         */
        const URL_PATH_EDIT = 'webgate_custommenu/custommenu/edit';
        const URL_PATH_DELETE = 'webgate_custommenu/custommenu/delete';

        /**
         * @var UrlInterface
         */
        protected $urlBuilder;

        /**
         * Constructor
         *
         * @param ContextInterface $context
         * @param UiComponentFactory $uiComponentFactory
         * @param UrlInterface $urlBuilder
         * @param array $components
         * @param array $data
         */
        public function __construct(
            ContextInterface $context,
            UiComponentFactory $uiComponentFactory,
            UrlInterface $urlBuilder,
            array $components = [],
            array $data = []
        ) {
            $this->urlBuilder = $urlBuilder;
            parent::__construct($context, $uiComponentFactory, $components, $data);
        }

        /**
         * Prepare Data Source
         *
         * @param array $dataSource
         * @return array
         */
        public function prepareDataSource(array $dataSource)
        {
            if (isset($dataSource['data']['items'])) {
                $storeId = $this->context->getFilterParam('store_id');

                foreach ($dataSource['data']['items'] as &$item) {

                    if (isset($item['entity_id'])) {

                        $item[$this->getData('name')]['edit'] = [
                            'href' => $this->urlBuilder->getUrl(
                                self::URL_PATH_EDIT,
                                ['entity_id' => $item['entity_id'], 'store' => $storeId]
                            ),
                            'label' => __('Edit'),
                            'hidden' => false,
                        ];

                        $item[$this->getData('name')]['delete'] = [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE ,
                                [
                                    'entity_id' => $item['entity_id'],
                                ]
                            ) ,
                            'label' => __('Delete') ,
                            'confirm' => [
                                'title' => __('Delete "${ $.$data.entity_id }"') ,
                                'message' => __('Are you sure you wan\'t to delete a "${ $.$data.entity_id }" record?'),
                            ],
                        ];

                    }

                }
            }

            return $dataSource;
        }
    }
