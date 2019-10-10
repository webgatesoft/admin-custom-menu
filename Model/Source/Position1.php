<?php

namespace WebGate\CustomMenu\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class Position1 implements ArrayInterface
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
                'label' => 'Top',
                'value' => 'top',
            ], [
                'label' => 'Bottom',
                'value' => 'bottom',
            ]
        ];
    }
}
