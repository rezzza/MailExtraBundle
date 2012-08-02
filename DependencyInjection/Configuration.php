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
                ->scalarNode('mailer_class')->defaultValue('Rezzza\MailExtraBundle\Mailer\Mailer')->end()
                ->arrayNode('assets')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('pictures')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->booleanNode('embed')->defaultTrue()->end()
                            ->end()
                        ->end()
                        
                    ->end()
                ->end()
                // content types
                ->arrayNode('content_types')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('auto_generate')->defaultTrue()->end()
                        ->arrayNode('generators')
                            ->useAttributeAsKey('name')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('type')->isRequired()->end()
                                    ->scalarNode('transformer')->isRequired()->end()
                                    ->scalarNode('from')->isRequired()->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('transformers')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('html2text')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('binary')->defaultValue('/usr/local/bin/html2text')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

}
