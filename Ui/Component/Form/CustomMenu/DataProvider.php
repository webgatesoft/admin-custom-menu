<?php
    
    namespace WebGate\CustomMenu\Ui\Component\Form\CustomMenu;
    
    use Magento\Framework\View\Element\UiComponent\DataProvider\FilterPool;
    use Magento\Ui\DataProvider\AbstractDataProvider;
    use WebGate\CustomMenu\Model\ResourceModel\CustomMenu\Collection;
    
    class DataProvider extends AbstractDataProvider
    {
        /**
         * @var Collection
         */
        protected $collection;
        
        /**
         * @var FilterPool
         */
        protected $filterPool;
    
        /**
         * @var array
         */
        protected $loadedData;
    
        /**
         * Construct
         *
         * @param string $name
         * @param string $primaryFieldName
         * @param string $requestFieldName
         * @param Collection $collection
         * @param FilterPool $filterPool
         * @param array $meta
         * @param array $data
         */
        public function __construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            Collection $collection,
            FilterPool $filterPool,
            array $meta = [],
            array $data = []
        ) {
            parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
            $this->collection = $collection;
            $this->filterPool = $filterPool;
        }
    
        /**
         * Get data
         *
         * @return array
         */
        public function getData()
        {
            if (!$this->loadedData) {
                $items = $this->collection->getItems();
                foreach ($items as $item) {
                    $this->loadedData[$item->getId()] = $item->getData();
                    break;
                }
            }
            return $this->loadedData;
        }
    }
