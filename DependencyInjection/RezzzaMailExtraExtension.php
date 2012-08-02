<?php

namespace Rezzza\MailExtraBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * RezzzaMailExtraExtension
 *
 * @uses Extension
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class RezzzaMailExtraExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
		$processor = new Processor();
		$config    = $processor->processConfiguration(new Configuration(), $configs);

        $container->setParameter('swiftmailer.class', $config['mailer_class']);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));
        $loader->load('transformer.xml');
    }
}
