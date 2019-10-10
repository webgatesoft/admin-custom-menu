<?php

namespace WebGate\CustomMenu\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class Target implements ArrayInterface
{

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {

        return [
            [
                'label' => 'parent',
                'value' => '_parent',
            ], [
                'label' => 'blank',
                'value' => '_blank',
            ], [
                'label' => 'self',
                'value' => '_self',
            ], [
                'label' => 'top',
                'value' => '_top',
            ]
        ];
    }
}
