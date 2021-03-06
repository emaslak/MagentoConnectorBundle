<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\MagentoConnectorBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ONGRMagentoConnectorExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('ongr_magento.store_id', $config['store_id']);
        $container->setParameter('ongr_magento.shop_id', $config['shop_id']);
        $container->setParameter('ongr_magento.store_url', $config['url']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('modifiers/category.yml');
        $loader->load('modifiers/content.yml');
        $loader->load('modifiers/product.yml');

        if ($container->hasDefinition('ongr_magento.sync.cart')) {
            $cartDefinition = $container->getDefinition('ongr_magento.sync.cart');

            $cartDefinition->addMethodCall('setManager', [new Reference('es.manager.' . $config['es_manager'])]);
            $cartDefinition->addMethodCall('setRepositoryName', [$config['product_repository']]);
        }
    }

    /**
     * Returns correct dependency injection alias.
     *
     * @return string
     */
    public function getAlias()
    {
        return 'ongr_magento';
    }
}
