<?php

namespace Rezzza\MailExtraBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 *
 * @uses ConfigurationInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('rezzza_mail_extra');

        $rootNode

            ->children()
                ->scalarNode('mailer_class')
                    // @todo add validation here (MailerInterface)
                    ->defaultValue('Rezzza\MailExtraBundle\Mailer\Mailer')
                ->end()
                ->arrayNode('transformers')
                    ->example(array(
                        'html2text' => array(
                            'id' => 'rezzza.transformer.html2text',
                            'default' => false,
                            'enabled' => true,
                            'options' => array(
                                'binary' => '/usr/local/bin/html2text',
                            )
                        )
                    ))
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('id')->isRequired()->end()
                            ->booleanNode('default')->defaultFalse()->end()
                            ->booleanNode('enabled')->defaultTrue()->end()
                            ->arrayNode('options')
                                ->performNoDeepMerging()
                                ->useAttributeAsKey('id')
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

}
