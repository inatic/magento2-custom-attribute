<?php

namespace Inatics\CustomAttribute\Setup;

use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;

/**
 * Class InstallData
 * @package     Inatics\CustomAttribute\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var EavSetup
     */
    private $eavSetup;

    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * InstallData constructor.
     * @param EavSetup $eavSetup
     * @param Config $config
     */
    public function __construct(
        EavSetup $eavSetup,
        Config $config
    ) {
        $this->eavSetup = $eavSetup;
        $this->eavConfig = $config;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
	$this->eavSetup->addAttribute(
           AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            'mobile',
            [
                'label' => 'Mobile Phone Number',
                'input' => 'text',
                'visible' => true,
                'required' => false,
                'position' => 121,
                'sort_order' => 121,
                'system' => false
            ]
        );

        $customAttribute = $this->eavConfig->getAttribute(
            AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            'mobile'
        );

        $customAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address']
        );

        $customAttribute->save();

        $setup->endSetup();
    }
}

