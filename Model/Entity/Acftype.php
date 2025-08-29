<?php 
namespace Pagespeedfr\CmsAcf\Model\Entity;

use Magento\Framework\Option\ArrayInterface;

class Acftype implements ArrayInterface
{
 
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            0 => [
                'label' => 'Text',
                'value' => 0,
            ],
            2 => [
                'label' => 'Link',
                'value' => 1,
            ],
            3 => [
                'label' => 'Image',
                'value' => 2,
            ],
            4 => [
                'label' => 'File',
                'value' => 3,
            ],
        ];

        return $options;
    } 


}