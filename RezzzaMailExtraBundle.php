<?php

namespace Rezzza\MailExtraBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Rezzza\MailExtraBundle\DependencyInjection\Compiler\AddTransformersCompilerPass;
use Rezzza\MailExtraBundle\DependencyInjection\Compiler\AddTransformerProcessorCompilerPass;

/**
 * RezzzaMailExtraBundle
 *
 * @uses Bundle
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class RezzzaMailExtraBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AddTransformerProcessorCompilerPass());
    }
}
