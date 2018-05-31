<?php
namespace Inatics\CustomAttribute\Plugin\Customer;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;

class AddressEditPlugin
{
    /**
     * @var LayoutInterface
     */
    private $layout;

    /**
    * AddressEditPlugin constructor.
    * @param LayoutInterface $layout
    */
    private function __construct(
        LayoutInterface $layout
    ) {
        $this->layout = $layout;
    }

    /**
    * @param \Magento\Customer\Block\Address\Edit $edit
    * @param string $result
    * @return string
    */
    public function afterGetNameBlockHtml(
        \Magento\Customer\Block\Address\Edit $edit,
        $result
    )  {
        $customBlock = $this->layout->createBlock(
            'Inatics\CustomAttribute\Block\Customer\Address\Form\Edit\Custom',
            'inatics_custom_attribute'
        );
        return $result . $customBlock->toHtml();
    }
}

