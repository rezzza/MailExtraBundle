<?php
namespace Rezzza\MailExtraBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

use Rezzza\MailExtraBundle\Transformer\TransformerInterface;

/**
 * AddTransformersCompilerPass
 *
 * @uses CompilerPassInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class AddTransformersCompilerPass implements CompilerPassInterface
{
	/**
     * {@inheritdoc}
	 *
	 * We have to hydrate the TransfomerProcessor with transformer
	 * setted on configuration.
     */
    public function process(ContainerBuilder $container)
    {
        $config = $container->getExtensionConfig('rezzza_mail_extra');

        if (!isset($config[0]) || !isset($config[0]['transformers'])) {
            return;
        }

		$processor = $container->getDefinition('rezzza.transformer.processor');

		$transformers = $config[0]['transformers'];

		foreach ($transformers as $name => $parameters) {
			$providerDefinition = $container->getDefinition($parameters['id']);

			if (isset($parameters['options'])) {
				$providerDefinition->addMethodCall('setOptions', array($parameters['options']));
			}

			$processor->addMethodCall('add', array($name, $providerDefinition));

			if ($parameters['default']) {
				$processor->addMethodCall('activate', array($name));
			}
		}
    }
}
