<?php

/*
 * This file is part of the PaymentSuite package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */

namespace PaymentSuite\RedsysBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class RedsysExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('redsys.merchant.code', $config['merchant_code']);
        $container->setParameter('redsys.secret.key', $config['secret_key']);
        $container->setParameter('redsys.url', $config['url']);

        $container->setParameter('redsys.controller.execute.route', $config['controller_execute_route']);
        $container->setParameter('redsys.controller.result.route', $config['controller_result_route']);

        $container->setParameter('redsys.success.route.name', $config['payment_success']['route']);
        $container->setParameter('redsys.success.route', $config['payment_success']['path']);
        $container->setParameter('redsys.success.order.append', $config['payment_success']['order_append']);
        $container->setParameter('redsys.success.order.field', $config['payment_success']['order_append_field']);

        $container->setParameter('redsys.fail.route.name', $config['payment_fail']['route']);
        $container->setParameter('redsys.fail.route', $config['payment_fail']['path']);
        $container->setParameter('redsys.fail.order.append', $config['payment_fail']['order_append']);
        $container->setParameter('redsys.fail.order.field', $config['payment_fail']['order_append_field']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('parameters.yml');
        $loader->load('services.yml');
    }
}
