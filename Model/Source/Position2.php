<?php

namespace WebGate\CustomMenu\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class Position2 implements ArrayInterface
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
                'label' => 'Left',
                'value' => 'left',
            ], [
                'label' => 'Right',
                'value' => 'right',
            ]
        ];
    }
}
