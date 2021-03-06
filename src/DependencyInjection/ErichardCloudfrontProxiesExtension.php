<?php

namespace Erichard\CloudfrontProxiesBundle\DependencyInjection;

use Erichard\CloudfrontProxiesBundle\EventSubscriber\TrustCloudFrontProxiesSubscriber;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class ErichardCloudfrontProxiesExtension extends Extension
{
    /**
     * Handles the knp_markdown configuration.
     *
     * @param array            $configs   The configurations being loaded
     * @param ContainerBuilder $container
     *
     * @throws InvalidConfigurationException When Sundown parser was selected, but extension is not available
     */
    public function load(array $configs , ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $definition = $container->getDefinition(TrustCloudFrontProxiesSubscriber::class);

        $definition
            ->replaceArgument(2, $config['ip_range_url'])
            ->replaceArgument(3, $config['expire'])
        ;

        if (null !== $config['cache']) {
            $container
                ->getDefinition(TrustCloudFrontProxiesSubscriber::class)
                ->replaceArgument(0, new Reference($config['cache']))
            ;
        }
    }
}
