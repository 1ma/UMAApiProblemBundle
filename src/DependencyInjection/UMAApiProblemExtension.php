<?php

namespace UMA\ApiProblemBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class UMAApiProblemExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $umaProblemConfig = $this->processConfiguration(new Configuration(), $configs);

        $container->getDefinition('uma.api_problem.listener')
            ->replaceArgument(0, $umaProblemConfig['default_status']);

    }
}
