<?php

namespace Erichard\CloudfrontProxiesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('erichard_cloudfront_proxies');
        // BC layer for symfony/config < 4.2
        $rootNode = method_exists($treeBuilder, 'getRootNode') ? $treeBuilder->getRootNode() : $treeBuilder->root('erichard_cloudfront_proxies');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('cache')->defaultNull()->end()
                ->integerNode('expire')->defaultValue(3600)->end()
                ->scalarNode('ip_range_url')->defaultValue('https://ip-ranges.amazonaws.com/ip-ranges.json')->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
