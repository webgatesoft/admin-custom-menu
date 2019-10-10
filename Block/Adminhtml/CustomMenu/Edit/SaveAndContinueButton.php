<?php
    
    namespace WebGate\CustomMenu\Block\Adminhtml\CustomMenu\Edit;
    
    use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
    
    /**
     * Class SaveAndContinueButton
     */
    class SaveAndContinueButton implements ButtonProviderInterface
    {
    
        /**
         * @return array
         */
        public function getButtonData()
        {
            $data = [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => ['event' => 'saveAndContinueEdit'],
                    ],
                ],
                'sort_order' => 80,
            ];
            return $data;
        }
    }
