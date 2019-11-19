<?php

namespace Ls\Replication\Setup;

use \Ls\Replication\Setup\UpgradeSchema\AbstractUpgradeSchema;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Symfony\Component\Filesystem\Filesystem;
use Zend\Code\Reflection\ClassReflection;

/**
 * Class UpgradeSchema
 * @package Ls\Replication\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        // @codingStandardsIgnoreStart
        $fs             = new Filesystem();
        $anchor         = new ClassReflection(AbstractUpgradeSchema::class);
        $base_namespace = $anchor->getNamespaceName();
        $filename       = $anchor->getFileName();
        $folder         = dirname($filename);
        $upgrades       = glob($folder . DIRECTORY_SEPARATOR . '*');
        foreach ($upgrades as $upgrade_file) {
            if (strpos($upgrade_file, 'AbstractUpgradeSchema') === false) {
                if ($fs->exists($upgrade_file)) {
                    $upgrade_class     = str_replace('.php', '', $fs->makePathRelative($upgrade_file, $folder));
                    $upgrade_class_fqn = $base_namespace . '\\' . substr($upgrade_class, 0, -1);
                    /** @var AbstractUpgradeSchema $upgrade */
                    $upgrade = new $upgrade_class_fqn();
                    $upgrade->upgrade($setup, $context);
                }
            }
        }
        // @codingStandardsIgnoreEnd
        $setup->endSetup();
    }
}
