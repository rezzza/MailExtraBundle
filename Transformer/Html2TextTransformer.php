<?php

namespace Rezzza\MailExtraBundle\Transformer;

use Symfony\Component\Process\Process;

/**
 * Html2TextTransformer
 *
 * @uses AbstractTransformer
 * @uses TransformerInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Html2TextTransformer extends AbstractTransformer implements TransformerInterface
{
    /**
     * Initialize default options
     */
    public function __construct()
    {
        $this->options = array(
            'binary' => '/usr/local/bin/html2text',
            'utf8' => true,
            'style' => true,
            'pretty' => true,
        );
    }

    /**
     * {@inheritdoc)
     */
    public function transform(\Swift_Mime_Message $message)
    {
        $processor = new Process($this->getCommand());
        $processor->setStdin($message->getBody());
        $processor->run();

        if ($processor->isSuccessful()) {
            $message->addPart($processor->getOutput(), 'text/plain');
        }
    }

    /**
     * @return string
     */
    protected function getCommand()
    {
        $command = $this->options['binary'];

        if ($this->options['utf8']) {
            $command .= ' -utf8';
        }

        if ($this->options['style']) {
            $command .= ' -style';
        }

        if ($this->options['pretty']) {
            $command .= ' pretty';
        }

        //@todo continue, integrate other options

        return $command;
    }

    /**
     * {@inheritdoc)
     */
    public function supports(\Swift_Mime_Message $message)
    {
        // why multipart/mixed, because if you attach a file, it'll be the contentType
        // So be careful to not use this transformer if you don't use text/html and attach a file
        return in_array($message->getContentType(), array('multipart/mixed', 'text/html'));
    }
}
