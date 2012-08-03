<?php
namespace Rezzza\MailExtraBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * AddTransformerProcessorCompilerPass
 *
 * @uses CompilerPassInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class AddTransformerProcessorCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     *
     * We have to set the TransfomerProcessor on mailer
     */
    public function process(ContainerBuilder $container)
    {
        $container->getDefinition('swiftmailer.mailer')
            ->addMethodCall('setTransformerProcessor', array(
                $container->getDefinition('rezzza.transformer.processor')
            )
        );
    }
}
