<?php

namespace UMA\ApiProblemBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\HttpFoundation\Response;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root('uma_problem')
            ->children()
                ->scalarNode('default_status')->defaultValue(Response::HTTP_BAD_REQUEST)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
